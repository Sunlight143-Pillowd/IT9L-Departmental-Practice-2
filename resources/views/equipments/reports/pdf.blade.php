<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Equipment Report</title>
    <style>body{font-family:sans-serif;font-size:12px}table{width:100%;border-collapse:collapse}th,td{border:1px solid #ccc;padding:6px;text-align:left}</style>
</head>
<body>
    <h1>Equipment Report</h1>
    @if ($start_date || $end_date)
        <p>Period: {{ $start_date ?: 'Beginning' }} to {{ $end_date ?: 'Present' }}</p>
    @endif
    <p>Total: {{ $equipment_count }}</p>
    <table>
        <thead><tr><th>Name</th><th>Category</th><th>Price</th><th>Status</th></tr></thead>
        <tbody>
            @foreach ($equipment as $item)
                <tr><td>{{ $item->equipment_name }}</td><td>{{ $item->category }}</td><td>{{ number_format($item->unit_price, 2) }}</td><td>{{ $item->availability_status }}</td></tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>