
@extends('layouts.nav')
@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <b-card>
                    {{$user}}
                    <hr>
                    {{$adm}}
                        <hr>
                    {{$emp}}
                    <hr>
             
                    </b-card>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection