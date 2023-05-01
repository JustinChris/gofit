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

        #leftimage {
            height: 89%;
            position: absolute;
            bottom: 0;
            left: -100px;
            filter: grayscale(100%);
            animation: leftHeroImage 1s;
        }

        @keyframes leftHeroImage {
            0% {left: -10000px;}
            100% {left: -100px;}
        }

        @keyframes rightHeroImage {
            0% {right: -10000px;}
            100% {right: -100px;}
        }

        #rightimage {
            height: 90%;
            position: absolute;
            bottom: 0;
            right: -10vw;
            filter: grayscale(100%);
            animation: rightHeroImage 1s;
        }

        #background {
            background: linear-gradient( rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.9) ), url('assets/backgroundgym.jpg');
            background-position:center;
            background-size: cover;
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
<body style="overflow-x: hidden;">
    <div>
        <section>
            
            <div style="width: 100%; height: 100vh; position: relative; background-color: black;" id="background">
                
                <div>
                    <div style="display: flex; align-items: center; justify-content: center;">
                        <img src="assets/logo.png" alt="dumbbel logo" style="width: 5vw; margin: 5px; filter: invert(100%);">
                        <a href="/" class="hoverBrand">GoFit</a>
                    </div>
                </div>

                <div style="text-align: center; padding-top: 20vh;">
                    <h1 class="text-white" >Live Healthy Lifestyle Start From Now</h1>
                    <a href="/login" class="text-white btn btn-success" style="padding: 1vw 3vw; margin: 2vh;">Login</a>
                </div>
                <div style="z-index: -5;">
                    <img src="/assets/asset1.png" alt="fitness model" id="leftimage">
                    <img src="/assets/asset2.png" alt="fitness double model" id="rightimage">
                </div>
            </div>
        </section>
    </div>

</body>
</html>