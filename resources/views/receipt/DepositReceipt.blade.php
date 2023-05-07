<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- deposit --}}
    <h1>Gofit</h1>
    <span>{{$user->username}}</span>
    <table>
        <tr>
            <th>Title</th>
            <th>Total</th>
        </tr>
        <tr>
            <td>{{$transaction->title}}</td>
            <td>{{$transaction->deposit}}</td>
        </tr>
    </table>
</body>
</html>