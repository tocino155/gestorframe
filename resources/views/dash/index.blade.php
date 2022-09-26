@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div><h1><center>Panel</center></h1></div>
@stop

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
<link href="https://cdn.bootcss.com/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">


<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div style="height: 300px; border: solid; margin-bottom: 10px; border-radius: 10px; border-color: #A2A2A2; padding: 20px; overflow: auto;" id="mensajes">
                    <div style="border: solid; border-color: #A2A2A2; padding: 10px; border-radius: 10px; margin-left: 80px;"><p style="font-weight: bold; font-size: 22px;"> ¡Hola soy Tesori!<br>Estoy Para ayudarte en lo que necesites ¡papi! o ¡mami!<br> soy no binario</p>
                        <div style="text-align: right;"><button class="btn btn-outline-primary" onclick="hola()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-volume-up-fill" viewBox="0 0 16 16">
                          <path d="M11.536 14.01A8.473 8.473 0 0 0 14.026 8a8.473 8.473 0 0 0-2.49-6.01l-.708.707A7.476 7.476 0 0 1 13.025 8c0 2.071-.84 3.946-2.197 5.303l.708.707z"/>
                          <path d="M10.121 12.596A6.48 6.48 0 0 0 12.025 8a6.48 6.48 0 0 0-1.904-4.596l-.707.707A5.483 5.483 0 0 1 11.025 8a5.483 5.483 0 0 1-1.61 3.89l.706.706z"/>
                          <path d="M8.707 11.182A4.486 4.486 0 0 0 10.025 8a4.486 4.486 0 0 0-1.318-3.182L8 5.525A3.489 3.489 0 0 1 9.025 8 3.49 3.49 0 0 1 8 10.475l.707.707zM6.717 3.55A.5.5 0 0 1 7 4v8a.5.5 0 0 1-.812.39L3.825 10.5H1.5A.5.5 0 0 1 1 10V6a.5.5 0 0 1 .5-.5h2.325l2.363-1.89a.5.5 0 0 1 .529-.06z"/></svg></button></div>
                    </div>
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
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.table').DataTable({
           "language": {
              "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
           }
        });
      });
    let sonido2=new Audio("{{url('/sonidos/inicio.m4a')}}");
    let sonido4=new Audio("{{url('/sonidos/hola.mp3')}}");
    $(document).ready(function(){
      const valores = window.location.search;

      //Mostramos los valores en consola:
      console.log(valores);

      //Creamos la instancia
      const urlParams = new URLSearchParams(valores);

      //Accedemos a los valores
      var bot = urlParams.get('joeftps');
      if(bot!=null && bot=="play"){

        sonido2.play();

      }
    });
        

    function hola(){
        sonido4.play();
    }

    function agregar(){
        if(document.getElementById("texto").value!=""){
            document.getElementById("mensajes").insertAdjacentHTML('beforeend','<div style="text-align: right;"><br><div style="border: solid; border-color: #A2A2A2; padding: 10px; border-radius: 10px; margin-right: 65px;  margin-left: 100px;"><p style="font-weight: bold; ">'+document.getElementById("texto").value+'</p></div><img src="{{url('/imagenes/usuario.jpg')}}" width="45" height="45" style="margin-top: -20px; margin-left: 25px; border-radius: 5px;"></div>');
        }
        //Este método nos devuelve -1 cuando el valor no se encontró en la cadena, pero recuerda que en JavaScript -1 es igual a “-1”, así que la forma correcta de validarlo es usando el operador !==.

        var pregunta=document.getElementById("texto").value;
        if(pregunta.toLowerCase().indexOf("hola")!==-1){
            document.getElementById("texto").value=null;
            document.getElementById("mensajes").insertAdjacentHTML('beforeend','<div style="border: solid; border-color: #A2A2A2; padding: 10px; border-radius: 10px; margin-left: 80px; margin-right: 100px;"><p style="font-weight: bold;"> hola!</p></div><img src="{{url('/imagenes/tesoni_c.png')}}" width="45" height="45" style="margin-top: -20px; margin-left: 25px;">');
        }else if(pregunta.toLowerCase().indexOf("registrar")!==-1 && pregunta.toLowerCase().indexOf("paciente")!==-1 || pregunta.toLowerCase().indexOf("agregar")!==-1 && pregunta.toLowerCase().indexOf("paciente")!==-1){

            document.getElementById("texto").value=null;
            document.getElementById("mensajes").insertAdjacentHTML('beforeend','<div style="border: solid; border-color: #A2A2A2; padding: 10px; border-radius: 10px; margin-left: 80px; margin-right: 100px;"><p style="font-weight: bold;">Ve al apartado de "Registros" y preciona el boton de "NUEVO PACIENTE", ahi podras agregar un paciente.</p><br><a class="btn btn-outline-info" href="{{url('/alta/?bot_result=active_modal')}}"></i>Registros</a></div><img src="{{url('/imagenes/tesoni_c.png')}}" width="45" height="45" style="margin-top: -20px; margin-left: 25px;">');

        }else if(pregunta.toLowerCase().indexOf("registrar")!==-1 && pregunta.toLowerCase().indexOf("medico")!==-1 || pregunta.toLowerCase().indexOf("registrar")!==-1 && pregunta.toLowerCase().indexOf("doctor")!==-1 || pregunta.toLowerCase().indexOf("agregar")!==-1 && pregunta.toLowerCase().indexOf("medico")!==-1 || pregunta.toLowerCase().indexOf("agregar")!==-1 && pregunta.toLowerCase().indexOf("doctor")!==-1){

            document.getElementById("texto").value=null;
            document.getElementById("mensajes").insertAdjacentHTML('beforeend','<div style="border: solid; border-color: #A2A2A2; padding: 10px; border-radius: 10px; margin-left: 80px; margin-right: 100px;"><p style="font-weight: bold;">Ve al apartado de "Registros" y preciona el boton de "NUEVO MEDICO", ahi podras agregar un medico.</p><br><a class="btn btn-outline-info" href="{{url('/alta/?bot_result=active_modal_medi')}}">Registros</a></div><img src="{{url('/imagenes/tesoni_c.png')}}" width="45" height="45" style="margin-top: -20px; margin-left: 25px;">');

        }else if(pregunta.toLowerCase().indexOf("editar")!==-1 && pregunta.toLowerCase().indexOf("paciente")!==-1 || pregunta.toLowerCase().indexOf("eliminar")!==-1 && pregunta.toLowerCase().indexOf("paciente")!==-1){

            document.getElementById("texto").value=null;
            document.getElementById("mensajes").insertAdjacentHTML('beforeend','<div style="border: solid; border-color: #A2A2A2; padding: 10px; border-radius: 10px; margin-left: 80px; margin-right: 100px;"><p style="font-weight: bold;">Ve al apartado de "Registros" y cada una de las filas tiene botones tanto "EDITAR" como "ELIMINAR" cada fila corresponde a un paciente y los botones tambien.</p><br><a class="btn btn-outline-info" href="{{url('/alta')}}">Registros</a></div><img src="{{url('/imagenes/tesoni_c.png')}}" width="45" height="45" style="margin-top: -20px; margin-left: 25px;">');

        }else if(pregunta.toLowerCase().indexOf("editar")!==-1 && pregunta.toLowerCase().indexOf("medico")!==-1 || pregunta.toLowerCase().indexOf("eliminar")!==-1 && pregunta.toLowerCase().indexOf("doctor")!==-1){

            document.getElementById("texto").value=null;
            document.getElementById("mensajes").insertAdjacentHTML('beforeend','<div style="border: solid; border-color: #A2A2A2; padding: 10px; border-radius: 10px; margin-left: 80px; margin-right: 100px;"><p style="font-weight: bold;">Ve al apartado de "Registros" y cada una de las filas tiene botones tanto "EDITAR" como "ELIMINAR" cada fila corresponde a un medico y los botones tambien.</p><br><a class="btn btn-outline-info" href="{{url('/alta/?bot_result=modal_medi')}}">Registros</a></div><img src="{{url('/imagenes/tesoni_c.png')}}" width="45" height="45" style="margin-top: -20px; margin-left: 25px;">');

        }else if(pregunta.toLowerCase().indexOf("historia")!==-1 && pregunta.toLowerCase().indexOf("clínina")!==-1){

            document.getElementById("texto").value=null;
            document.getElementById("mensajes").insertAdjacentHTML('beforeend','<div style="border: solid; border-color: #A2A2A2; padding: 10px; border-radius: 10px; margin-left: 80px; margin-right: 100px;"><p style="font-weight: bold;">En el apartado de "Consultas" cada fila corresponde a un paciente y hay un boton que despliega un menu donde esta la opcion de "GENERAR HISTORIA CLINICA".<br>Para esto ya debe existir el paciente.</p><br><a class="btn btn-outline-info" href="{{url('/consultas')}}">Consultas</a></div><img src="{{url('/imagenes/tesoni_c.png')}}" width="45" height="45" style="margin-top: -20px; margin-left: 25px;">');

        }else if(pregunta.toLowerCase().indexOf("asignar")!==-1 && pregunta.toLowerCase().indexOf("horario")!==-1 || pregunta.toLowerCase().indexOf("cambiar")!==-1 && pregunta.toLowerCase().indexOf("horario")!==-1){

            document.getElementById("texto").value=null;
            document.getElementById("mensajes").insertAdjacentHTML('beforeend','<div style="border: solid; border-color: #A2A2A2; padding: 10px; border-radius: 10px; margin-left: 80px; margin-right: 100px;"><p style="font-weight: bold;">En el apartado de "Consultas" cada fila corresponde a un medico y hay un boton "ASINGNAR HORARIO".<br>Para esto ya debe existir el medico.</p><br><a class="btn btn-outline-info" href="{{url('/consultas/?bot_result=modal_medi')}}">Consultas</a></div><img src="{{url('/imagenes/tesoni_c.png')}}" width="45" height="45" style="margin-top: -20px; margin-left: 25px;">');

        }else if(pregunta.toLowerCase().indexOf("dar")!==-1 || pregunta.toLowerCase().indexOf("alta")!==-1){

            document.getElementById("texto").value=null;
            document.getElementById("mensajes").insertAdjacentHTML('beforeend','<div style="border: solid; border-color: #A2A2A2; padding: 10px; border-radius: 10px; margin-left: 80px; margin-right: 100px;"><p style="font-weight: bold;">En el apartado de "Consultas" cada fila corresponde a un paciente y hay un boton que despliega un menu donde esta la opcion de "DAR DE ALTA".<br>Para esto ya debe existir el paciente.</p><br><a class="btn btn-outline-info" href="{{url('/consultas')}}">Consultas</a></div><img src="{{url('/imagenes/tesoni_c.png')}}" width="45" height="45" style="margin-top: -20px; margin-left: 25px;">');

        }else if(pregunta.toLowerCase().indexOf("asignar")!==-1 && pregunta.toLowerCase().indexOf("pago")!==-1 || pregunta.toLowerCase().indexOf("ver")!==-1 && pregunta.toLowerCase().indexOf("pago")!==-1){

            document.getElementById("texto").value=null;
            document.getElementById("mensajes").insertAdjacentHTML('beforeend','<div style="border: solid; border-color: #A2A2A2; padding: 10px; border-radius: 10px; margin-left: 80px; margin-right: 100px;"><p style="font-weight: bold;">En el apartado de "Facturación" cada fila corresponde a un paciente y hay un boton que despliega un menu donde esta la opcion de "ASINGAR ESTATUS DE PAGO".<br>Para esto ya debe existir el paciente.</p><br><a class="btn btn-outline-info" href="{{url('/Facturaciones')}}">Facturación</a></div><img src="{{url('/imagenes/tesoni_c.png')}}" width="45" height="45" style="margin-top: -20px; margin-left: 25px;">');

        }else if(pregunta.toLowerCase().indexOf("asignar")!==-1 && pregunta.toLowerCase().indexOf("aseguradora")!==-1){

            document.getElementById("texto").value=null;
            document.getElementById("mensajes").insertAdjacentHTML('beforeend','<div style="border: solid; border-color: #A2A2A2; padding: 10px; border-radius: 10px; margin-left: 80px; margin-right: 100px;"><p style="font-weight: bold;">En el apartado de "Facturación" cada fila corresponde a un paciente y hay un boton que despliega un menu donde esta la opcion de "ASEGURADORA".<br>Para esto ya debe existir el paciente.</p><br><a class="btn btn-outline-info" href="{{url('/Facturaciones')}}">Facturación</a></div><img src="{{url('/imagenes/tesoni_c.png')}}" width="45" height="45" style="margin-top: -20px; margin-left: 25px;">');

        }else if(pregunta.toLowerCase().indexOf("registrar")!==-1 && pregunta.toLowerCase().indexOf("área")!==-1 || pregunta.toLowerCase().indexOf("registrar")!==-1 && pregunta.toLowerCase().indexOf("area")!==-1 || pregunta.toLowerCase().indexOf("agregar")!==-1 && pregunta.toLowerCase().indexOf("área")!==-1 || pregunta.toLowerCase().indexOf("agregar")!==-1 && pregunta.toLowerCase().indexOf("area")!==-1){

            document.getElementById("texto").value=null;
             document.getElementById("mensajes").insertAdjacentHTML('beforeend','<div style="border: solid; border-color: #A2A2A2; padding: 10px; border-radius: 10px; margin-left: 80px; margin-right: 100px;"><p style="font-weight: bold;">En el apartado de "Catalogos" puedes ir a "Areas" dentro de este modulo puedes agregar una area, tambien editar y eliminar la misma</p><br><a class="btn btn-outline-info" href="{{url('/Areas/?bot_result=active_modal')}}">Areas</a></div><img src="{{url('/imagenes/tesoni_c.png')}}" width="45" height="45" style="margin-top: -20px; margin-left: 25px;">');

        }else if(pregunta.toLowerCase().indexOf("registrar")!==-1 && pregunta.toLowerCase().indexOf("aseguradora")!==-1 || pregunta.toLowerCase().indexOf("agregar")!==-1 && pregunta.toLowerCase().indexOf("aseguradora")!==-1){

            document.getElementById("texto").value=null;
             document.getElementById("mensajes").insertAdjacentHTML('beforeend','<div style="border: solid; border-color: #A2A2A2; padding: 10px; border-radius: 10px; margin-left: 80px; margin-right: 100px;"><p style="font-weight: bold;">En el apartado de "Catalogos" puedes ir a "Aseguradoras" dentro de este modulo puedes agregar una aseguradora, tambien editar y eliminar la misma</p><br><a class="btn btn-outline-info" href="{{url('/Aseguradoras/?bot_result=active_modal')}}">Aseguradoras</a></div><img src="{{url('/imagenes/tesoni_c.png')}}" width="45" height="45" style="margin-top: -20px; margin-left: 25px;">');

        }else if(pregunta.toLowerCase().indexOf("registrar")!==-1 && pregunta.toLowerCase().indexOf("especialidad")!==-1 || pregunta.toLowerCase().indexOf("agregar")!==-1 && pregunta.toLowerCase().indexOf("especialidad")!==-1){

            document.getElementById("texto").value=null;
             document.getElementById("mensajes").insertAdjacentHTML('beforeend','<div style="border: solid; border-color: #A2A2A2; padding: 10px; border-radius: 10px; margin-left: 80px; margin-right: 100px;"><p style="font-weight: bold;">En el apartado de "Catalogos" puedes ir a "Especialidad" dentro de este modulo puedes agregar una especialidad, tambien editar y eliminar la misma</p><br><a class="btn btn-outline-info" href="{{url('/Especialidad/?bot_result=active_modal')}}">Especialidad</a></div><img src="{{url('/imagenes/tesoni_c.png')}}" width="45" height="45" style="margin-top: -20px; margin-left: 25px;">');

        }else if(pregunta.toLowerCase().indexOf("registrar")!==-1 && pregunta.toLowerCase().indexOf("procedimiento")!==-1 || pregunta.toLowerCase().indexOf("agregar")!==-1 && pregunta.toLowerCase().indexOf("procedimiento")!==-1){

            document.getElementById("texto").value=null;
             document.getElementById("mensajes").insertAdjacentHTML('beforeend','<div style="border: solid; border-color: #A2A2A2; padding: 10px; border-radius: 10px; margin-left: 80px; margin-right: 100px;"><p style="font-weight: bold;">En el apartado de "Catalogos" puedes ir a "Procedimiento" dentro de este modulo puedes agregar una procedimiento, tambien editar y eliminar la misma</p><br><a class="btn btn-outline-info" href="{{url('/Procedimientos/?bot_result=active_modal')}}">Procedimiento</a></div><img src="{{url('/imagenes/tesoni_c.png')}}" width="45" height="45" style="margin-top: -20px; margin-left: 25px;">');

        }else if(pregunta.toLowerCase().indexOf("asignar")!==-1 || pregunta.toLowerCase().indexOf("reasignar")!==-1){

            document.getElementById("texto").value=null;
            document.getElementById("mensajes").insertAdjacentHTML('beforeend','<div style="border: solid; border-color: #A2A2A2; padding: 10px; border-radius: 10px; margin-left: 80px; margin-right: 100px;"><p style="font-weight: bold;">En el apartado de "Consultas" cada fila corresponde a un paciente y hay un boton que despliega un menu donde esta la opcion de "ASIGNAR/REASINGNAR".<br>Para esto ya debe existir el paciente.</p><br><a class="btn btn-outline-info" href="{{url('/consultas')}}">Consultas</a></div><img src="{{url('/imagenes/tesoni_c.png')}}" width="45" height="45" style="margin-top: -20px; margin-left: 25px;">');

        }else if(pregunta.toLowerCase().indexOf("ticket")!==-1 || pregunta.toLowerCase().indexOf("recibo")!==-1){

            document.getElementById("texto").value=null;
            document.getElementById("mensajes").insertAdjacentHTML('beforeend','<div style="border: solid; border-color: #A2A2A2; padding: 10px; border-radius: 10px; margin-left: 80px; margin-right: 100px;"><p style="font-weight: bold;">En el apartado de "Facturación" cada fila corresponde a un paciente y hay un boton que despliega un menu donde esta la opcion de "TICKET".<br>Para esto ya debe existir el paciente.</p><br><a class="btn btn-outline-info" href="{{url('/Facturaciones')}}">Facturación</a></div><img src="{{url('/imagenes/tesoni_c.png')}}" width="45" height="45" style="margin-top: -20px; margin-left: 25px;">');

        }else if(pregunta.toLowerCase().indexOf("catalogo")!==-1 || pregunta.toLowerCase().indexOf("catálogo")!==-1){

            document.getElementById("texto").value=null;
            document.getElementById("mensajes").insertAdjacentHTML('beforeend','<div style="border: solid; border-color: #A2A2A2; padding: 10px; border-radius: 10px; margin-left: 80px; margin-right: 100px;"><p style="font-weight: bold;">En el apartado de "Catalogos" puedes agregar, eliminar y editar los catalogos de "Areas", "Aseguradoras", "Especialidades" y "Procedimientos".<br>Puedes ir a estos apartados.</p><br><a class="btn btn-outline-info" href="{{url('/Areas')}}" style="margin-right: 20px;">Areas</a><a class="btn btn-outline-info" href="{{url('/Aseguradoras')}}" style="margin-right: 20px;">Aseguradoras</a><a class="btn btn-outline-info" href="{{url('/Especialidad')}}" style="margin-right: 20px;">Especialidad</a><a class="btn btn-outline-info" href="{{url('/Procedimientos')}}" style="margin-right: 20px;">Procedimientos</a></div><img src="{{url('/imagenes/tesoni_c.png')}}" width="45" height="45" style="margin-top: -20px; margin-left: 25px;">');

        }else{
            var text_pregunta=document.getElementById("texto").value;
            document.getElementById("texto").value=null;
            document.getElementById("mensajes").insertAdjacentHTML('beforeend','<div style="border: solid; border-color: #A2A2A2; padding: 10px; border-radius: 10px; margin-left: 80px; margin-right: 100px;"><p style="font-weight: bold;">Creo que lo que buscas no esta dentro de este sistema, ¡Pregúntale a San Google!</p><br><a class="btn btn-outline-info" href="https://www.google.com/search?q='+text_pregunta+'&rlz=1C1ASUM_enMX1004MX1004&oq=preguntacelo+a+san+google&aqs=chrome..69i57.783j0j7&sourceid=chrome&ie=UTF-8" target="_back">Pregúntale</a></div><img src="{{url('/imagenes/tesoni_c.png')}}" width="45" height="45" style="margin-top: -20px; margin-left: 25px;">');
        }
        //animacion para que baje
        $('#mensajes').animate({ scrollTop: $('#mensajes').prop("scrollHeight")}, 1000);
        
        
    }
</script>
@stop