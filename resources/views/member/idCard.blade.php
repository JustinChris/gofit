<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ID Card</title>

    <style>

        #profileIcon {
            padding-left: 20px;
            width: 100px;
            height: 150px;
        }
    </style>
</head>
<body>
    <section style="width: 700px; height: 400px;
    background-image: url( {{ public_path('/assets/cardbackground.jpg') }} );
    background-position:center;
    background-size: cover;
    background-repeat: no-repeat;
    position: relative;">
        <h1 style="text-align: center; padding: 20px; color: white;"><img src="{{ public_path('/assets/logo.png') }}" alt="logo" style="filter: invert(100%); width: 60px;"> GOFIT MEMBERCARD</h1>
        <div style="display: flex; flex-direction: column;">
            <img src="{{ public_path('/assets/profile.png') }}" alt="profile" id="profileIcon">
        </div>
        <div style="position: absolute; bottom: 10px; left: 183px;">
            <h1 style="color: white; text-align: center;">{{$member->username}}</h1>
            <h1 style="text-align: center;"><img src="{{ public_path('/assets/barcode.png') }}" alt="barcode"></h1>
        </div>
    </section>
</body>
</html>