<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- class --}}
    <h1>Gofit</h1>
    <span>{{$user->username}}</span>
    <table>
        <tr>
            <th>Title</th>
            <th>Price</th>
        </tr>
        <tr>
            <td>{{$schedule->name}}</td>
            <td>{{$schedule->price}}</td>
        </tr>
    </table>
</body>
</html>