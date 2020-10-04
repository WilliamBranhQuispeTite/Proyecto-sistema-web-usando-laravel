<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Delivery</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        .pag_inicio {
            color: #eee;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            position: fixed;
            top: 0px;
            left: 0px;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background: rgba(23, 23, 23, 0.9);
            z-index: 3;
        }

        .banner {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            bottom: 0;
            background-image: url("{{asset('imagenes/banner-1.jpg')}}");
            background-size: cover;
            z-index: -1;
        }

        .cover {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            bottom: 0;
            background: rgba(23, 23, 23, 0.5);
            z-index: 0;
        }

        .links {
            z-index: 3;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }



        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
            z-index: 4;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #fff;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        .registro{
            text-decoration: none;
            padding: 5px 10px;
            border: 2px solid #fff;
            color: #fff;
            font-size: 30px;
        }
        .registro:hover{
            border: 2px solid #fff;
            color:#000;
            background: #fff;
        }
    </style>
</head>

<body>
    <div class="flex-center  pag_inicio">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}">Home</a>
            @else
            <a href="{{ route('login') }}">Ingresar</a>
            @endauth
        </div>
        @endif

        <div class="content">
            <div class="title">
                Delivery
            </div>
            <h3>
                EL SISTEMA DE DELIVERY <small>Y</small> PUNTO DE VENTA
                PARA TU RESTAURANTE
            </h3>
            <h4>Sácale el jugo a tu negocio</h4>
            
            <a  class ="registro" href="{{ route('registro') }}"> Empezar Ahora</a>

        </div>
        <div class="banner">
        </div>
        <div class="cover">
        </div>
    </div>
</body>

</html>