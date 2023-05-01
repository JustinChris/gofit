<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous" defer></script>
    <title>GoFit</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        #form-content {
            background-color: rgb(65, 65, 65);
            width: 50vw;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            height: 100vh;
        }

        section {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #157347;
        }
        #inputEmail, #inputPass, #inputName, #inputPhone, #inputAddress {
            border: none;
            border-radius: 5px;
            padding: 5px;
        }

        label, p {
            color: white;
        }

        .hoverBrand {
            color: white;
            text-decoration: none;
            font-size: 2rem;
        }

        .hoverBrand:hover {
            color: rgb(183, 183, 183);
        }

    </style>
</head>
<body>
    <section>
        <div id="form-content">
            <div style="display: flex; align-items: center; justify-content: space-evenly;">
                <img src="assets/logo.png" alt="dumbbel logo" style="width: 5vw; margin: 5px; filter: invert(100%);">
                <a href="/" class="hoverBrand">GoFit</a>
            </div>
            <h2 style="color: white;">Login</h2>
            <form action="/login" method="post">
                @csrf

                <label for="inputEmail">Email<span style="color: red;">*</span></label><br>
                <input type="text" id="inputEmail" name="email" class="w-100" placeholder="(ends with .com or .co.id)"><br>
                @if ($errors->has('inputEmail'))
                    <span class="error">{{ $errors->first('inputEmail') }}</span>
                @endif

                <label for="inputPass">Password<span style="color: red;">*</span></label><br>
                <input type="password" id="inputPass" name="password" class="w-100" placeholder="(5-20 letters)"><br>
                @if ($errors->has('passInput'))
                    <span class="error">{{ $errors->first('passInput') }}</span>
                @endif

                <br>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="checkbox mb-3" style="text-align: center;">
                    <label>
                      <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <button class="w-100 btn btn-success" type="submit">Submit</button>
            </form>
        </div>
    </section>
</body>
</html>