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

    <h3>Data Customer - Toko Online</h3>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>No HP</th>
            <th>Email</th>
        </tr>

        @php
            $no = 1;
        @endphp

        @foreach ($customers as $customer)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->phone_number }}</td>
                <td>{{ $customer->email }}</td>
            </tr>
        @endforeach
    </table>

    <script>
        window.print();
    </script>

</body>

</html>
