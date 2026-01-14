<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Library Books - {{ now()->format('Y-m-d') }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #2563eb;
            margin-bottom: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 10px;
        }
        .summary {
            background-color: #f3f4f6;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #2563eb;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }
        td {
            padding: 8px;
            border-bottom: 1px solid #e5e7eb;
        }
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }
        .badge-available {
            background-color: #d1fae5;
            color: #065f46;
        }
        .badge-borrowed {
            background-color: #fed7aa;
            color: #92400e;
        }
        .badge-reading {
            background-color: #ddd6fe;
            color: #5b21b6;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>অক্ষর - Complete Collection</h1>
        <p>Generated on {{ now()->format('F d, Y') }}</p>
    </div>

    <div class="summary">
        <strong>Library Summary:</strong> Total of {{ $books->count() }} books in collection
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 30%;">Title</th>
                <th style="width: 20%;">Author</th>
                <th style="width: 12%;">Language</th>
                <th style="width: 15%;">Category</th>
                <th style="width: 10%;">Status</th>
                <th style="width: 8%;">Year</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $index => $book)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $book->title }}</strong></td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->language }}</td>
                    <td>{{ $book->category ?? '-' }}</td>
                    <td>
                        <span class="badge badge-{{ $book->status }}">
                            {{ ucfirst($book->status) }}
                        </span>
                    </td>
                    <td>{{ $book->publication_year ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>অক্ষর · Family Library | Page <span class="pagenum"></span></p>
    </div>
</body>
</html>
