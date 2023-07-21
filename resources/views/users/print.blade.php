<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        h3 {
            text-align: center;
        }

        .mb-0 {
            margin: 5px 5px;
        }

        .text-right {
            text-align: right;
        }

        table {
            margin-top: 20px !important;
            margin-bottom: 10px !important;
            margin: auto;
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
        }

        @media print {

            /* menghilangkan header dan footer cetakan */
            @page {
                margin: 0;
                size: auto;
                -webkit-print-color-adjust: exact;
            }

            body {
                margin: 0.5cm;
            }

            /* menghilangkan teks file:///C:/Users/MSI PC1/Desktop/index.htm */
            @page :left {
                content: "";
            }

            @page :right {
                content: "";
            }

            @page :first {
                content: "";
            }
        }
    </style>
</head>

<body>
    <h3>Toko Online</h3>

    <p class="mb-0">Detail Order: <strong>{{ $order->order_number }}</strong></p>
    <p class="mb-0">Nama: <strong>{{ $order->name }}</strong></p>
    <p class="mb-0">No HP: <strong>{{ $order->phone_number }}</strong></p>
    <p class="mb-0">Alamat: <strong>{{ $order->address }}</strong></p>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th class="text-center">Harga</th>
            <th class="text-center">QTY</th>
            <th class="text-center">Total</th>
        </tr>

        @foreach ($details as $key => $detail)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $detail->product->name }}</td>
                <td align="right">Rp{{ number_format($detail->product->price, 0, ',', '.') }}</td>
                <td align="center">{{ $detail->qty }}</td>
                <td align="right">
                    Rp{{ number_format($detail->product->price * $detail->qty, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </table>

    <p class="mb-0 text-right">Total Harga:
        <strong>Rp{{ number_format($order->total_price, 0, ',', '.') }}</strong>
    </p>
    <p class="mb-0 text-right">Biaya Ongkir:
        <strong>Rp{{ number_format($order->shipping_cost, 0, ',', '.') }}</strong>
    </p>
    <p class="mb-0 text-right">Total Bayar:
        <strong>Rp{{ number_format($order->total_amount, 0, ',', '.') }}</strong>
    </p>

    <script>
        window.print();
    </script>

</body>

</html>
