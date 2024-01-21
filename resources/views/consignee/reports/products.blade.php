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
    <h1 style="text-align: center">Products Report</h1>

    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Category</th>
                <th>Unit Price</th>
                <th>Stock</th>
                <th>Total Price</th>
                <th>Consginor</th>
                <th>Received On</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->info->name }}</td>
                    <td style="text-align: center">{{ $product->info->category->name }}</td>
                    <td style="text-align: center">{{ $product->info->price }}</td>
                    <td style="text-align: center">{{ $product->stock }}</td>
                    <td style="text-align: center">{{ number_format($product->total, 2) }}</td>
                    <td style="text-align: center">{{ $product->info->consignor->user->username }}</td>
                    <td style="text-align: center">{{ $product->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No available data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
