<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class ImageOptimizer
{
    /**
     * Default quality for image compression (0-100).
     */
    protected int $quality;

    /**
     * Maximum width for resized images.
     */
    protected int $maxWidth;

    /**
     * Maximum height for resized images.
     */
    protected int $maxHeight;

    public function __construct(int $quality = 30, int $maxWidth = 1200, int $maxHeight = 1600)
    {
        $this->quality = $quality;
        $this->maxWidth = $maxWidth;
        $this->maxHeight = $maxHeight;
    }

    /**
     * Optimize an uploaded image file.
     *
     * @param UploadedFile $file The uploaded image file
     * @param string $destinationPath The destination directory path
     * @param string|null $filename Optional custom filename (without extension)
     * @return string|null The relative path to the saved file, or null on failure
     */
    public function optimize(UploadedFile $file, string $destinationPath, ?string $filename = null): ?string
    {
        try {
            $mimeType = $file->getMimeType();
            $originalName = $file->getClientOriginalName();
            
            // Generate filename if not provided
            if ($filename === null) {
                $filename = time() . '_' . pathinfo($originalName, PATHINFO_FILENAME);
            }

            // Create image resource based on mime type
            $sourceImage = $this->createImageFromFile($file->getPathname(), $mimeType);
            
            if ($sourceImage === null) {
                Log::warning('ImageOptimizer: Failed to create image resource', [
                    'mime_type' => $mimeType,
                    'original_name' => $originalName,
                ]);
                return null;
            }

            // Get original dimensions
            $originalWidth = imagesx($sourceImage);
            $originalHeight = imagesy($sourceImage);

            // Calculate new dimensions while maintaining aspect ratio
            [$newWidth, $newHeight] = $this->calculateDimensions(
                $originalWidth,
                $originalHeight,
                $this->maxWidth,
                $this->maxHeight
            );

            // Create optimized image
            $optimizedImage = imagecreatetruecolor($newWidth, $newHeight);

            // Preserve transparency for PNG and GIF
            if (in_array($mimeType, ['image/png', 'image/gif'])) {
                imagealphablending($optimizedImage, false);
                imagesavealpha($optimizedImage, true);
                $transparent = imagecolorallocatealpha($optimizedImage, 255, 255, 255, 127);
                imagefilledrectangle($optimizedImage, 0, 0, $newWidth, $newHeight, $transparent);
            }

            // Resize image
            imagecopyresampled(
                $optimizedImage,
                $sourceImage,
                0, 0, 0, 0,
                $newWidth, $newHeight,
                $originalWidth, $originalHeight
            );

            // Ensure destination directory exists
            $fullDestinationPath = public_path($destinationPath);
            if (!is_dir($fullDestinationPath)) {
                mkdir($fullDestinationPath, 0755, true);
            }

            // Save optimized image (always as JPEG for better compression, except for transparency)
            $savedPath = $this->saveOptimizedImage(
                $optimizedImage,
                $fullDestinationPath,
                $filename,
                $mimeType
            );

            // Free memory
            imagedestroy($sourceImage);
            imagedestroy($optimizedImage);

            if ($savedPath) {
                Log::info('ImageOptimizer: Image optimized successfully', [
                    'original_size' => $file->getSize(),
                    'original_dimensions' => "{$originalWidth}x{$originalHeight}",
                    'new_dimensions' => "{$newWidth}x{$newHeight}",
                    'quality' => $this->quality,
                    'saved_path' => $savedPath,
                ]);
            }

            return $savedPath;

        } catch (\Exception $e) {
            Log::error('ImageOptimizer: Exception during optimization', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return null;
        }
    }

    /**
     * Create an image resource from a file based on its mime type.
     */
    protected function createImageFromFile(string $path, string $mimeType): ?\GdImage
    {
        return match ($mimeType) {
            'image/jpeg', 'image/jpg' => imagecreatefromjpeg($path),
            'image/png' => imagecreatefrompng($path),
            'image/gif' => imagecreatefromgif($path),
            'image/webp' => function_exists('imagecreatefromwebp') ? imagecreatefromwebp($path) : null,
            default => null,
        };
    }

    /**
     * Calculate new dimensions while maintaining aspect ratio.
     *
     * @return array{0: int, 1: int} [width, height]
     */
    protected function calculateDimensions(
        int $originalWidth,
        int $originalHeight,
        int $maxWidth,
        int $maxHeight
    ): array {
        // If image is already smaller than max dimensions, keep original size
        if ($originalWidth <= $maxWidth && $originalHeight <= $maxHeight) {
            return [$originalWidth, $originalHeight];
        }

        $aspectRatio = $originalWidth / $originalHeight;

        if ($originalWidth > $originalHeight) {
            // Landscape orientation
            $newWidth = min($originalWidth, $maxWidth);
            $newHeight = (int) round($newWidth / $aspectRatio);

            if ($newHeight > $maxHeight) {
                $newHeight = $maxHeight;
                $newWidth = (int) round($newHeight * $aspectRatio);
            }
        } else {
            // Portrait orientation
            $newHeight = min($originalHeight, $maxHeight);
            $newWidth = (int) round($newHeight * $aspectRatio);

            if ($newWidth > $maxWidth) {
                $newWidth = $maxWidth;
                $newHeight = (int) round($newWidth / $aspectRatio);
            }
        }

        return [$newWidth, $newHeight];
    }

    /**
     * Save the optimized image to disk.
     */
    protected function saveOptimizedImage(
        \GdImage $image,
        string $destinationPath,
        string $filename,
        string $originalMimeType
    ): ?string {
        // For images with potential transparency, keep PNG format
        // Otherwise, convert to JPEG for better compression
        if (in_array($originalMimeType, ['image/png', 'image/gif'])) {
            $extension = 'png';
            $fullPath = $destinationPath . '/' . $filename . '.' . $extension;
            
            // For PNG, quality is compression level (0-9), we convert our 0-100 scale
            $pngQuality = (int) round((100 - $this->quality) / 11.111);
            $pngQuality = max(0, min(9, $pngQuality));
            
            $success = imagepng($image, $fullPath, $pngQuality);
        } else {
            $extension = 'jpg';
            $fullPath = $destinationPath . '/' . $filename . '.' . $extension;
            $success = imagejpeg($image, $fullPath, $this->quality);
        }

        if ($success) {
            return basename($destinationPath) . '/' . $filename . '.' . $extension;
        }

        return null;
    }

    /**
     * Set the quality for image compression.
     */
    public function setQuality(int $quality): self
    {
        $this->quality = max(1, min(100, $quality));
        return $this;
    }

    /**
     * Set maximum dimensions for image resizing.
     */
    public function setMaxDimensions(int $width, int $height): self
    {
        $this->maxWidth = $width;
        $this->maxHeight = $height;
        return $this;
    }
}
