<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Report</title>

    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
        }

        tr,
        td,
        th {
            border: 1px solid black;
        }

        td {
            padding: 4px;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center">Transactions Report</h1>
    @if ($range[0] !== 'custom')
        <h3 style="text-align: center">{{ ucfirst($range[0]) }} Transaction Report</h3>
    @else
        <h3 style="text-align: center">{{ $range[1]['from'] }} - {{ $range[1]['to'] }} Transaction Report</h3>
    @endif

    <table>
        <thead>
            <tr>
                <th>Reference Number</th>
                <th>Order Reference Number</th>
                <th>Items Count</th>
                <th>Total</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @if ($transactions->isNotEmpty())
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ strtoupper($transaction->reference_number) }}</td>
                        <td>{{ strtoupper($transaction->order->reference_number) }}</td>
                        <td style="text-align: center">{{ $transaction->order->items->sum('quantity') }}</td>
                        <td style="text-align: center">{{ number_format($transaction->total, 2) }}</td>
                        <td style="text-align: center">{{ $transaction->created_at }}</td>
                    </tr>
                @endforeach

                <tr>
                    <td style="font-size: 24px; font-weight: 600;" colspan="4">TOTAL</td>
                    <td style="font-size: 24px; font-weight: 600;">{{ number_format($total, 2) }}</td>
                </tr>
            @else
                <tr>
                    <td colspan="7">No available data.</td>
                </tr>
            @endif
        </tbody>
    </table>
</body>

</html>
