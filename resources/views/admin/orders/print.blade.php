<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        h3 {
            text-align: center;
        }

        table {
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

    <h3>Data Order - Toko Online</h3>

    <table>
        <tr>
            <th>No</th>
            <th>Nomor Order</th>
            <th>Nama</th>
            <th>No HP</th>
            <th>Kurir</th>
            <th>Service</th>
            <th>Total Bayar</th>
            <th>Status</th>
        </tr>

        @php
            $no = 1;
        @endphp
        @foreach ($orders as $key => $order)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $order->order_number }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->phone_number }}</td>
                <td>{{ $order->courier }}</td>
                <td>{{ $order->service }}</td>
                <td>{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                <td>
                    @if ($order->status == 'Unpaid')
                        Belum Bayar
                    @else
                        Sudah Bayar
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

    <script>
        window.print();
    </script>

</body>

</html>
