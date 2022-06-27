@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div><h1><center>Panel</center></h1></div>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div style="height: 300px; border: solid; margin-bottom: 10px; border-radius: 10px; border-color: #A2A2A2; padding: 20px; overflow: auto;" id="mensajes">
                    <div style="border: solid; border-color: #A2A2A2; padding: 10px; border-radius: 10px; margin-left: 80px;"><p style="font-weight: bold; font-size: 22px;"> ¡Hola soy Tesori!<br>Estoy Para ayudarte en lo que necesites ¡papi! o ¡mami!<br> soy no binario</p></div>
                    <img src="{{url('/imagenes/tesoni.png')}}" width="110" height="190" style="margin-top: -140px; margin-left: -20px;">
                    <!--
                    <div style="background-color: red; margin-left: 80px;"><p style="font-weight: bold;"> hola!</p></div>
                    <img src="{{url('/imagenes/tesoni_c.png')}}" width="45" height="45" style="margin-top: -20px; margin-left: 25px;">
                    <div style="text-align: right;">
                        <br>
                        <div style="background-color: red; margin-right: 65px;"><p style="font-weight: bold; "> hola!</p></div>
                        <img src="{{url('/imagenes/usuario.jpg')}}" width="45" height="45" style="margin-top: -20px; margin-left: 25px; border-radius: 5px;">
                    </div>
                    -->
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text">PREGUNTA</span>
                  <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="texto" onkeyup="if(event.which === 13){agregar()}">
                  <button class="btn btn-outline-dark" type="button" id="button-addon2" onclick="agregar()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16"><path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/></svg></button>
                </div>
            </div>
        </div>
        
    </div>
</div>









@stop

@section('css')
    
@stop

@section('js')
<script type="text/javascript">
    let sonido2=new Audio("{{url('/sonidos/inicio.m4a')}}");
    $(document).ready(function(){
        sonido2.play();
    });

    function agregar(){
        document.getElementById("mensajes").insertAdjacentHTML('beforeend','<div style="text-align: right;"><br><div style="border: solid; border-color: #A2A2A2; padding: 10px; border-radius: 10px; margin-right: 65px;  margin-left: 100px;"><p style="font-weight: bold; ">'+document.getElementById("texto").value+'</p></div><img src="{{url('/imagenes/usuario.jpg')}}" width="45" height="45" style="margin-top: -20px; margin-left: 25px; border-radius: 5px;"></div>');

        //Este método nos devuelve -1 cuando el valor no se encontró en la cadena, pero recuerda que en JavaScript -1 es igual a “-1”, así que la forma correcta de validarlo es usando el operador !==.

        var pregunta=document.getElementById("texto").value;
        if(pregunta.toLowerCase().indexOf("hola")!==-1){
            document.getElementById("texto").value=null;
            document.getElementById("mensajes").insertAdjacentHTML('beforeend','<div style="border: solid; border-color: #A2A2A2; padding: 10px; border-radius: 10px; margin-left: 80px; margin-right: 100px;"><p style="font-weight: bold;"> hola!</p></div><img src="{{url('/imagenes/tesoni_c.png')}}" width="45" height="45" style="margin-top: -20px; margin-left: 25px;">');
        }else if(pregunta.toLowerCase().indexOf("registrar")!==-1 && pregunta.toLowerCase().indexOf("paciente")!==-1){

            document.getElementById("texto").value=null;
            document.getElementById("mensajes").insertAdjacentHTML('beforeend','<div style="border: solid; border-color: #A2A2A2; padding: 10px; border-radius: 10px; margin-left: 80px; margin-right: 100px;"><p style="font-weight: bold;">Ve al apartado de "Registros" y preciona el boton de "NUEVO PACIENTE", ahi podras agregar un paciente.</p><br><a href="{{url('/alta/?bot_result=active_modal')}}">Registros</a></div><img src="{{url('/imagenes/tesoni_c.png')}}" width="45" height="45" style="margin-top: -20px; margin-left: 25px;">');

        }else if(pregunta.toLowerCase().indexOf("registrar")!==-1 && pregunta.toLowerCase().indexOf("medico")!==-1 || pregunta.toLowerCase().indexOf("doctor")!==-1){

            document.getElementById("texto").value=null;
            document.getElementById("mensajes").insertAdjacentHTML('beforeend','<div style="border: solid; border-color: #A2A2A2; padding: 10px; border-radius: 10px; margin-left: 80px; margin-right: 100px;"><p style="font-weight: bold;">Ve al apartado de "Registros" y preciona el boton de "NUEVO MEDICO", ahi podras agregar un medico.</p><br><a href="{{url('/alta/?bot_result=active_modal_medi')}}">Registros</a></div><img src="{{url('/imagenes/tesoni_c.png')}}" width="45" height="45" style="margin-top: -20px; margin-left: 25px;">');
        }
        
        
    }
</script>
@stop