<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Testing</title>

</head>

<body>

    <table>
        <thead>
            <tr>
                <th>NAMA</th>
                <th>NO RM</th>
                <th>RUANGAN</th>
                <th>UMUR</th>
                <th>JENIS KELAMIN</th>
                <th>PENJAMIN</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pasien as $item)
            <tr>
                <td>{{ $item['nama'] }}</td>
                <td>{{ $item['noRM'] }}</td>
                <td>{{ $item['ruangan'] }}</td>
                <td>{{ $item['umur'] }}</td>
                <td>{{ $item['jenis_kelamin'] }}</td>
                <td>{{ $item['penjamin'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
