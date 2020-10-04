@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <h4>REGISTRATE TU EMPREZA</h4>
            <small><i>*Todos los campos son obligatorios*</i></small>
            <hr class="mt-3">
        </div>
        <div class="col-md-6">


            <form method="POST" action="{{ route('registraremp') }}">
                @csrf

                <h6>Datos de la Empresa</h6>

                <b-row>
                    <b-col class="mb-3" md="12">
                        <b-form-input  value ="Empresa 01" name="emp_razonSocial" placeholder="Razon social" class="form-control @error('emp_razonSocial') is-invalid @enderror" required></b-form-input>
                        @error('emp_razonSocial')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </b-col>
                    <b-col class="mb-3" md="12">
                        <b-form-input value ="william@g.com" type="email" name="emp_correo" required placeholder="Correo"></b-form-input>
                    </b-col>
                    <b-col class="mb-3" md="6">
                        <b-form-input value ="12345678901" name="emp_ruc" required placeholder="RUC"></b-form-input>
                    </b-col>
                    <b-col class="mb-3" md="6">
                        <b-form-input value ="910098882" name="emp_numero" required placeholder="Numero de celular"></b-form-input>
                    </b-col>
                </b-row>
                <h6>Datos Personales</h6>
                <b-row>
                    <b-col class="mb-3" md="12">
                        <b-form-input value ="William Branh" name="adm_nombre" required placeholder="Nombre completo"></b-form-input>
                    </b-col>
                    <b-col class="mb-3" md="6">
                        <b-form-input value ="73810784" name="adm_dni" required placeholder="Ingrese su numero de DNI"></b-form-input>
                    </b-col>
                    <b-col class="mb-3" md="6">
                        <b-form-input value ="910098882" name="adm_numero" required placeholder="Numero de celular"></b-form-input>

                    </b-col>
                </b-row>
                <h6>Datos de Usuario</h6>
                <b-row>
                    <b-col class="mb-3" md="12">

                        <b-form-input value ="william@g.com" type="email" name="email" required placeholder="Correo"></b-form-input>
                    </b-col>
                    <b-col class="mb-3" md="12">
                        <b-form-input value ="12345678" type="password" name="password" required placeholder="Contraseña"></b-form-input>
                    </b-col>
                </b-row>
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Registrar
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <img width="100%" src="{{asset('imagenes/img-registro.png')}}" alt="">
        </div>
    </div>
</div>
@endsection