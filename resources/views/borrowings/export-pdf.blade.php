<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Borrowings Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background-color: #f0f0f0; }
        h2 { margin-bottom: 0.5rem; }
    </style>
</head>
<body>
    <h2>Borrowings Report</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Borrower</th>
                <th>Borrow Date</th>
                <th>Return Date</th>
                <th>Status</th>
                <th>Total Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach($borrowings as $index => $borrowing)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $borrowing->user->name }}</td>
                    <td>{{ $borrowing->borrow_date->format('d M Y') }}</td>
                    <td>{{ $borrowing->return_date?->format('d M Y') ?? '-' }}</td>
                    <td>{{ $borrowing->status }}</td>
                    <td>{{ $borrowing->total_quantity ?? $borrowing->details->sum('quantity') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
