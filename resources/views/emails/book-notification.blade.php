<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book Notification</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #334155; margin: 0; padding: 0; background-color: #f1f5f9; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .card { background: white; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); overflow: hidden; }
        .header { background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); color: white; padding: 30px; text-align: center; }
        .header h1 { margin: 0; font-size: 24px; }
        .content { padding: 30px; }
        .badge { display: inline-block; padding: 6px 16px; border-radius: 20px; font-size: 14px; font-weight: 600; margin-bottom: 20px; }
        .badge-added { background: #dcfce7; color: #166534; }
        .badge-updated { background: #dbeafe; color: #1e40af; }
        .badge-deleted { background: #fee2e2; color: #991b1b; }
        .book-info { background: #f8fafc; border-radius: 12px; padding: 20px; margin: 20px 0; }
        .book-title { font-size: 20px; font-weight: 700; color: #1e293b; margin: 0 0 8px 0; }
        .book-author { color: #64748b; margin: 0; }
        .detail-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #e2e8f0; }
        .detail-label { color: #64748b; }
        .detail-value { color: #1e293b; font-weight: 500; }
        .footer { text-align: center; padding: 20px; color: #94a3b8; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <h1>📚 অক্ষর</h1>
                <p style="margin: 8px 0 0 0; opacity: 0.9;">Family Library</p>
            </div>
            <div class="content">
                @php
                    $badgeClass = match($action) {
                        'added' => 'badge-added',
                        'updated' => 'badge-updated',
                        'deleted' => 'badge-deleted',
                        default => 'badge-updated',
                    };
                    $actionText = match($action) {
                        'added' => '✨ New Book Added',
                        'updated' => '✏️ Book Updated',
                        'deleted' => '🗑️ Book Deleted',
                        default => 'Book Activity',
                    };
                @endphp

                <span class="badge {{ $badgeClass }}">{{ $actionText }}</span>

                <div class="book-info">
                    <h2 class="book-title">{{ $book->title }}</h2>
                    <p class="book-author">by {{ $book->author }}</p>
                </div>

                <div style="margin: 20px 0;">
                    <div class="detail-row">
                        <span class="detail-label">Action by</span>
                        <span class="detail-value">{{ $userName }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Language</span>
                        <span class="detail-value">{{ $book->language }}</span>
                    </div>
                    @if($book->category)
                    <div class="detail-row">
                        <span class="detail-label">Category</span>
                        <span class="detail-value">{{ $book->category }}</span>
                    </div>
                    @endif
                    @if($book->publication_year)
                    <div class="detail-row">
                        <span class="detail-label">Published</span>
                        <span class="detail-value">{{ $book->publication_year }}</span>
                    </div>
                    @endif
                    <div class="detail-row" style="border-bottom: none;">
                        <span class="detail-label">Status</span>
                        <span class="detail-value">{{ ucfirst($book->status) }}</span>
                    </div>
                </div>

                <p style="color: #64748b; font-size: 14px; margin-top: 20px;">
                    This action was performed on {{ now()->format('F j, Y \a\t g:i A') }}
                </p>
            </div>
            <div class="footer">
                <p>&copy; {{ date('Y') }} অক্ষর · Family Library</p>
            </div>
        </div>
    </div>
</body>
</html>
