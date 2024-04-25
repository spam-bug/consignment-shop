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
    <h1 style="text-align: center">Product Sale Report</h1>
    @if ($range[0] !== 'custom')
        <h3 style="text-align: center">{{ ucfirst($range[0]) }} Product Sale Report</h3>
    @else
        <h3 style="text-align: center">{{ $range[1]['from'] }} - {{ $range[1]['to'] }} Product Report</h3>
    @endif

    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Category</th>
                <th>Original Price</th>
                <th>Selling Price</th>
                <th>Available Stock</th>
                <th>Sold</th>
                <th>Revenue</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp

            @if ($products->isNotEmpty())
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->selling_price ?? 'not set' }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->orders->sum('quantity') }}</td>
                        <td>
                            @php
                                $revenue = ($product->orders->sum('quantity') * $product->selling_price) - ($product->orders->sum('quantity') * $product->price);
                            @endphp
                            @if($product->selling_price)
                                {{ number_format($revenue, 2) }}
                            @else
                                unable to compute
                            @endif
                        </td>
                    </tr>

                    @php
                        $total += $revenue;
                    @endphp
                @endforeach

                <tr>
                    <td style="font-size: 24px; font-weight: 600;" colspan="6">TOTAL</td>
                    <td style="font-size: 24px; font-weight: 600;">{{ number_format($total, 2) }}</td>
                </tr>
            @else
                <tr>
                    <td colspan="6">No available data.</td>
                </tr>
            @endif
        </tbody>
    </table>
</body>

</html>
