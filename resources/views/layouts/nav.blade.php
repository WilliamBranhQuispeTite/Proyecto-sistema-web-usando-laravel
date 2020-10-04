@extends('layouts.app')
@section('content')
<div id="nav" class="shadow-sm">
    <div onclick="openNav()" class="p-2" id="open">
        <b-icon icon="list" font-scale="2"></b-icon>
    </div>
    <div onclick="closeNav()" class="p-2" id="close">
        <b-icon icon="x" font-scale="2"></b-icon>
    </div>
    <div>
        <b-icon class="mt-2 p-1" icon="building" font-scale="1.8"></b-icon>

        <b-icon class="p-1" id="popove" icon="person" font-scale="2"></b-icon>

        <b-popover target="popove" placement="bottomleft" title="Perfil" triggers="hover focus">
            <p>{{ $adm->adm_nombre  ?? ''}}</p>


            <b-button variant="danger" size="sm" block class="mb-1" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <b-icon icon="power" aria-hidden="true"></b-icon> Salir
            </b-button>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf

            </form>


        </b-popover>
    </div>
</div>


<div id="mySidenav" class="sidenav">
    <div class="emp_data">

        <div class="emp_logo">
            <b-img-lazy class="rounded-lg" center src="{{asset('imagenes/logo_prueba.png')}}" alt="Center image"></b-img-lazy>
        </div>
        <h5 class="pl-3 mt-1">{{$emp->emp_nombre}}</h5>
        <small class="pl-3">RUC: {{$emp->emp_ruc}} </small>
        <hr class="my-2" />
    </div>
    <div class="menu">
        <li class="{{(request () -> is ('home'))? 'activo': ''}}">
            <a href="/home" >
                <b-icon class="mr-2" icon="house"> </b-icon> Inicio
            </a>
        </li>
        <li class="{{(request () -> is ('home/articulos'))? 'activo': ''}}">
            <a href="/home/articulos">
                <b-icon class="mr-2" icon="egg-fried"> </b-icon> Artilulos
            </a></li>

        <li class="{{(request () -> is ('home/usuarios'))? 'activo': ''}}">
            <a href="/home/usuarios">
                <b-icon class="mr-2" icon="people"></b-icon> Usuarios
            </a></li>
        <li class="delivery {{(request () -> is ('home/delivery'))? 'activo_d': ''}}">
            <a href="/home/delivery">
                <b-icon class="mr-2" icon="truck"></b-icon> Delivey
            </a>
        </li>
    </div>

</div>

<div id="main">
    @yield('main')
</div>
@endsection

<style lang="sass">
    #nav {
        display: flex;
        flex-wrap: wrap;
        height: 50px;
        padding: 0px 5px;
        align-items: center;
        justify-content: space-between;
        padding: auto 15px;
        overflow: hidden;
        position: fixed;
        width: 100%;
        top: 0px;
        color: #777777;
        z-index: 3;
        background: #fff;
    }


    .sidenav {
        margin-top: 20px;
        height: 100%;
        width: 200px;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 40px;
        background: #fff;
    }

    .sidenav .emp_data .emp_logo {
        display: flex;
        flex-wrap: wrap;
        overflow: hidden;
        min-height: 130;
    }

    .sidenav .emp_data .emp_logo img {
        width: 80%;
        height: 100%;
    }

    .sidenav li {
        width: 100%;
        list-style: none;
    }

    .sidenav .delivery {
        background: #536DFE;
    }

    .sidenav .delivery a {
        color: #EEE;
    }

    .sidenav li a {
        padding: 8px 8px 8px 8px;
        text-decoration: none;
        font-size: 18px;
        display: block;
        transition: 0.3s;
        color: #333;
    }

    .sidenav li:hover a{
        color: #22f;
        background: rgba(80,80, 200, 0.2);
    }

    .sidenav .delivery a:hover {
        color: #CCC;
    }


    li.activo >a {
        color: #3333ff;
        background: rgba(80,80, 200, 0.1);
        border-right: 4px solid #536DFE;
    }

    .activo_d {
        border-right: 4px solid #3333F3;
    }

    #open {
        display: none;
    }

    #close {
        display: block;
    }


    #main {
        transition: margin-left .5s;
        padding: 16px;
        margin-left: 200px;
        margin-top: 50px;
    }

    @media screen and (max-width: 720px) {
        .sidenav {
            padding-top: 15px;
            width: 0;
        }
        .sidenav a {
            font-size: 18px;
        }
        #main {
            padding: 10px;
            margin-left: 0;
        }
        #open {
            display: block;
        }

        #close {
            display: none;
        }
    }
</style>

<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "200px";
        document.getElementById("main").style.marginLeft = "200px";
        document.getElementById("open").style.display = "none";
        document.getElementById("close").style.display = "block";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
        document.getElementById("open").style.display = "block";
        document.getElementById("close").style.display = "none";
    }
</script>