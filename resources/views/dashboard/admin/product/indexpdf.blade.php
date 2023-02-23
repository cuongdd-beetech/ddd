<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <h1>Product List</h1>
        <p>Current Time: {{ date('Y-m-d H:i:s') }}</p>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Sku</th>
                <th>Name</th>
                <th>Stock</th>
                <th>Expired at</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $pro)
            <tr id = "pid{{ $pro->id }}">
                <td>{{ $pro -> id }}</td>
                <td>{{ $pro -> sku }}</td>
                <td>{{ $pro -> name }}</td>
                <td>{{ $pro -> stock }}</td>
                <td>{{ $pro -> expired_at -> format('Y-m-d') }}</td>
            </tr>
        @endforeach
        </tbody>
     </table>   
</body>
</html>