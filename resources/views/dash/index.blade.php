@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Vista</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script type="text/javascript">
        let sonido2=new Audio("{{url('/sonidos/inicio.m4a')}}");
        $(document).ready(function(){
            sonido2.play();
        });
    </script>
@stop