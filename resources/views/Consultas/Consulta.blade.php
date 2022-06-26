@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div><h1><center>CONSULTAS</center></h1></div>
@stop

@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
<link href="https://cdn.bootcss.com/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">

<style type="text/css">
  .marca:hover{
      background: #DBDBDB;
   }


#text-wrap{
  white-space: normal !important;
}

input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
  .visible_on{
    display: block;
    position: fixed;
    background: white;
    border-radius: 15px;
    width: auto;
   }
  .visible_off{
    display: none;
  }
  .igual{
     width: 230px;
   }

</style>


@if(Session::has('message'))
<br>
<div class="alert alert-{{ Session::get('color') }}" role="alert">
   {{ Session::get('message') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
<br>
<div class="card">
  <div class="card-body">
    <ul class="nav nav-pills" id="myTab" role="tablist">

      <li class="nav-item" role="presentation">
        <a class="nav-link active btn" id="profile-CPA" data-toggle="tab" href="#profileCPA" role="tab" aria-controls="profileCPA" aria-selected="true" style="font-weight: bold; " >PACIENTES</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link btn" id="profile-CME" data-toggle="tab" href="#profileCME" role="tab" aria-controls="profileCME" aria-selected="false" style="font-weight: bold; " >MEDICOS</a>
      </li>
    </ul>
    <br><br>

    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="profileCPA" role="tabpanel" aria-labelledby="profile-CPA">
        <div class="table-responsive">
          <table class="table" style="font-weight: bold;">
                      <thead class="thead-dark">
                        <tr>
                          <th style="text-align: center;">TURNO</th>
                          <th style="text-align: center;">NOMBRE</th>
                          <th style="text-align: center;">AREA</th>
                          <th style="text-align: center;">ESPECIALIDAD</th>
                          <th style="text-align: center;">FECHA DE INGRESO</th>
                          <th style="text-align: center;">FECHA DE SALIDA</th>
                          <th style="text-align: center;">ESTATUS</th>
                          <th style="text-align: center;">OPCIONES</th>
                        </tr>
                      </thead>
                      <tbody> 
                        @foreach($pacientes as $paciente)
                        <?php $area=null;$especialidad=null; ?>
                        <tr class="marca">
                          <td style="text-align: center;">{{$paciente->id}}</td> 
                          <td style="text-align: center;">{{$paciente->nombre}} {{$paciente->apellido_pat}} {{$paciente->apellido_mat}}</td> 
                          <td style="text-align: center;">
                            @foreach($pacientes_asignaciones as $paciente_asi)
                            @if($paciente_asi->id_paciente==$paciente->id)
                            @foreach($areas as $area)
                            @if($area->Especialidad==$paciente_asi->id_especialidad)
                            @break
                            @endif
                            @endforeach
                            @endif
                            @endforeach
                            @if($area!=null)
                            {{$area->Area}}
                            @else
                            ---
                            @endif
                        </td> 
                          <td style="text-align: center;">
                            @foreach($pacientes_asignaciones as $paciente_asi)
                            @if($paciente_asi->id_paciente==$paciente->id)
                            @foreach($especialidades as $especialidad)
                            @if($especialidad->id==$paciente_asi->id_especialidad)
                            @break
                            @endif
                            @endforeach
                            @endif
                            @endforeach
                            @if($especialidad!=null)
                            {{$especialidad->Especialidad}}
                            @else
                            ---
                            @endif
                          </td> 
                          <td style="text-align: center;">{{$paciente->fecha_ingreso}}</td> 
                          <td style="text-align: center;">{{$paciente->fecha_salida}}</td> 
                          <td style="text-align: center;">
                            @foreach($estatus as $estatu)
                            @if($estatu->id==$paciente->id_estatus)
                            {{$estatu->Estatus}}
                            @endif
                            @endforeach
                          </td> 
                          <td style="text-align: center;">
                            <div id="menu_opciones{{$paciente->id}}" class="visible_off " style=" padding: 10px; background: #DBDBDB;">
                                  <br>
                                  @if($paciente->ATE_clinicos!=null)
                                  <a href="{{url('/archivos_pacientes_ingreso'.'/'.$paciente->ATE_clinicos)}}" target="_blank" class="btn btn-primary igual" style="margin-bottom: 10px;">ANTECEDENTES CLINICOS</a><br>
                                  @else
                                  <p>sin archivo</p>
                                  @endif
                                  <button class="btn btn-primary igual" style="margin-bottom: 10px;"  data-toggle="modal" data-target="#historial_pasiente{{$paciente->id}}">GENERAR HISTORIA CLINICA</button><br>
                                  @if($paciente->id_estatus!=4)
                                  <button class="btn btn-info igual" style=" margin-bottom: 10px;" data-toggle="modal" data-target="#asignar_reasignar" onclick="pasar_id({{$paciente->id}});">ASIGNAR/REASIGNAR</button><br>
                                  @else
                                  <p>ya no es posible asignar</p>
                                  @endif
                                  <button class="btn igual" style="background:#E655F4; color:white; margin-bottom: 10px;" data-toggle="modal" data-target="#alta_pasiente{{$paciente->id}}">DAR DE ALTA</button><br>
                                  <button class="btn btn-danger igual" data-toggle="modal" data-target="#eliminar_pasiente_s{{$paciente->id}}">ELIMINAR</button><br><br>
                              </div>
                              @if($paciente->id_estatus!=5)
                              <button class="btn btn-success boton_interno" id="menu{{$paciente->id}}" style="font-weight: bold; font-size: 20px;">+</button>
                              @else
                              <button id="menu{{$paciente->id}}" style="display: none;">+</button>
                              <p>sin acciones por ser eliminado</p>
                              @endif
                          </td> 
                        </tr>


<!--dar de alta -->
<div class="modal fade" id="alta_pasiente{{$paciente->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">DAR DE ALTA</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<form method="POST" action="{{url('/dar_de_alta_paciente')}}">
  @csrf
        <p style="font-size: 30px; text-align: center; font-weight: bold;">¿ESTAS SEGURO DE DAR DE ALTA?</p>
        <div style="text-align: center;">
          <label style="font-size: 20px; text-align: center; font-weight: bold;">PACIENTE:</label>
          <label style="font-size: 20px; text-align: center; font-weight: bold; color: red;">{{$paciente->nombre}} {{$paciente->apellido_pat}} {{$paciente->apellido_mat}}</label>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" id="id_paciente_alta" value="{{$paciente->id}}" name="id_paciente_alta">DAR DE ALTA</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
</form>
      </div>
    </div>
  </div>
</div>


<!--eliminar pasiente -->

<div class="modal fade" id="eliminar_pasiente_s{{$paciente->id}}"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">ELIMINAR PACIENTE</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
<form method="POST" action="{{url('/eliminar_paciente_s')}}">
  @csrf
        <p style="font-size: 30px; text-align: center; font-weight: bold;">¿ESTAS SEGURO DE ELIMINAR?</p>
        <div style="text-align: center;">
          <label style="font-size: 20px; text-align: center; font-weight: bold;">PACIENTE:</label>
          <label style="font-size: 20px; text-align: center; font-weight: bold; color: red;">{{$paciente->nombre}} {{$paciente->apellido_pat}} {{$paciente->apellido_mat}}</label>
        </div>
        
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" id="id_pasiente_eliminar_s" value="{{$paciente->id}}" name="id_pasiente_eliminar_s">ELIMINAR</button>
</form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
      </div>
    </div>
  </div>
</div>



<!--ver historial -->
<div class="modal fade" id="historial_pasiente{{$paciente->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">HISTORIAL DEL PACIENTE</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <embed type="application/pdf" src="{{url('/generar_historial'.'/'.$paciente->id)}}" style="width:100%; height: 600px;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
      </div>
    </div>
  </div>
</div>




<script type="text/javascript">

  menu{{$paciente->id}}.addEventListener("click",function(){
        var top_y=this.getBoundingClientRect() //odtenemos el valor de la posicion del boton
        menu_opciones{{$paciente->id}}.style.top=top_y.top-40+"px";
        menu_opciones{{$paciente->id}}.style.left=top_y.left-150+"px";
        menu_opciones{{$paciente->id}}.classList.toggle("visible_on");
        menu_opciones{{$paciente->id}}.classList.toggle("visible_off");
    });
  menu_opciones{{$paciente->id}}.addEventListener("mouseleave",function(){
        menu_opciones{{$paciente->id}}.classList.toggle("visible_on");
        menu_opciones{{$paciente->id}}.classList.toggle("visible_off");
    });


</script>





                        @endforeach
                      </tbody>      
                    </table>
          </div>
      </div>

<!--MODAL ASIGNAR Y REASGINAR -->
<div class="modal fade" id="asignar_reasignar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">ASIGNAR/REASIGNAR</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
        <div style="text-align: center;">
          <label style="font-size: 20px; text-align: center; font-weight: bold;">PACIENTE:</label>
          <label style="font-size: 20px; text-align: center; font-weight: bold; color: red;" id="text_nombre"></label>
        </div>
        
<form method="POST" action="{{url('/guardar_asignacion')}}">
  @csrf
        <div class="row">
          <div class="col-md-6">
            <label>ESPECIALIDAD</label>
            <select class="form-control"  required id="especialidad" name="especialidad">
              <option value="" selected disabled>.:SELECCONA:.</option>
              @foreach($especialidades as $especialidad)
              <option value="{{$especialidad->id}}">{{$especialidad->Especialidad}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label>MEDICO</label>
            <select class="form-control" required id="medico" name="medico">
            </select>
          </div>
        </div>

        <br><br>
        <div class="row">
          <div class="col-md-6">
            <label>AREA</label>
            <input type="text" name="" id="area" class="form-control" readonly>
          </div>
          <div class="col-md-6">
            <label>OBSERVACIONES</label>
            <textarea class="form-control" name="observaciones" required></textarea>
          </div>
          <div class="col-md-6">
            <label>PROCEDIMIENTO</label>
            <select class="form-control"  required id="procedimiento" name="procedimiento">
              <option value="" selected disabled>.:SELECCONA:.</option>
              @foreach($procedimientos as $procedimiento)
              <option value="{{$procedimiento->id}}">{{$procedimiento->Procedimiento}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label>COSTO</label>
            <input type="number" name="costo" class="form-control" readonly id="costo">
          </div>
        </div> 
      </div>
      <div class="modal-footer">
        <input type="hidden" name="id_paciente" id="id_trapaso">
        <button class="btn btn-primary" id="folio">GUARDAR</button>
</form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
      </div>
    </div>
  </div>
</div>

<!-- Pestaña de Medico  -->

      <div class="tab-pane fade " id="profileCME" role="tabpanel" aria-labelledby="profile-CME">
        <div class="table-responsive"> 
          <table class="table" style="font-weight: bold;">
            <thead class="thead-dark">
              <tr>
                <th style="text-align: center;">NOMBRE</th>
                <th style="text-align: center;">ESPECIALIDAD</th>
                <th style="text-align: center;">AREA</th>
                <th style="text-align: center;">HORARIO DE TRABAJO</th>
                <th style="text-align: center;">OPCIONES</th>
              </tr>
            </thead>
            <tbody>
            @foreach($medicos as $medico) 

              <tr class="marca">
                <td style="text-align: center;">{{$medico->nombre}} {{$medico->apellido_pat}} {{$medico->apellido_mat}}</td>
                <td style="text-align: center;">
                  @foreach($especialidades as $especialidad)
                  @if($especialidad->id==$medico->id_especialidad)
                  {{$especialidad->Especialidad}}
                  @endif
                  @endforeach
                </td>
                <td style="text-align: center;">
                  @foreach($areas as $area)
                  @if($area->Especialidad==$medico->id_especialidad)
                  {{$area->Area}}
                  @endif
                  @endforeach
                </td>
                <td style="text-align: center; ">
                  <div style="text-align: center;">
                    <label style="font-size: 20px; text-align: center; font-weight: bold; font-size: 15px;">DIAS:</label>
                    <label style="font-size: 20px; text-align: center; font-weight: bold; color: red; font-size: 15px;">{{$medico->dia_inicio}} -- {{$medico->dia_final}}</label><br>
                    <label style="font-size: 20px; text-align: center; font-weight: bold; font-size: 15px;">HORAS:</label>
                    <label style="font-size: 20px; text-align: center; font-weight: bold; color: red; font-size: 15px;">{{$medico->hora_inicio}} -- {{$medico->hora_final}}</label>
                  </div>
                </td>
                <td style="text-align: center;">
                  <button class="btn btn-primary" data-toggle="modal" data-target="#horario_medico{{$medico->id}}">ASIGNAR HORARIO</button>
                </td>
              </tr>

<!--horario medico -->
<div class="modal fade" id="horario_medico{{$medico->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">HORARIO</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<form method="POST" action="{{url('/guardar_horario_medico')}}">
  @csrf
        <div style="text-align: center;">
          <label style="font-size: 20px; text-align: center; font-weight: bold;">MEDICO:</label>
          <label style="font-size: 20px; text-align: center; font-weight: bold; color: red;">{{$medico->nombre}} {{$medico->apellido_pat}} {{$medico->apellido_mat}}</label>
        </div>
        <div class="row">
          <label style="width: 100%; text-align: center; font-weight: bold; font-size: 25px;">DIAS</label>
          <div class="col-md-6">
            <label>DIA INICIAL</label>
            <select class="form-control" name="dia_i">
              @if($medico->dia_inicio=="Lunes")
              <option selected>Lunes</option>
              @else
              <option>Lunes</option>
              @endif
              @if($medico->dia_inicio=="Martes")
              <option selected>Martes</option>
              @else
              <option>Martes</option>
              @endif
              @if($medico->dia_inicio=="Miercoles")
              <option selected>Miercoles</option>
              @else
              <option>Miercoles</option>
              @endif
              @if($medico->dia_inicio=="Jueves")
              <option selected>Jueves</option>
              @else
              <option>Jueves</option>
              @endif
              @if($medico->dia_inicio=="Viernes")
              <option selected>Viernes</option>
              @else
              <option>Viernes</option>
              @endif
              @if($medico->dia_inicio=="Sabado")
              <option selected>Sabado</option>
              @else
              <option>Sabado</option>
              @endif
              @if($medico->dia_inicio=="Domingo")
              <option selected>Domingo</option>
              @else
              <option>Domingo</option>
              @endif
            </select>
          </div>
          <div class="col-md-6">
            <label>DIA TERMINO</label>
            <select class="form-control" name="dia_f">
              @if($medico->dia_final=="Lunes")
              <option selected>Lunes</option>
              @else
              <option>Lunes</option>
              @endif
              @if($medico->dia_final=="Martes")
              <option selected>Martes</option>
              @else
              <option>Martes</option>
              @endif
              @if($medico->dia_final=="Miercoles")
              <option selected>Miercoles</option>
              @else
              <option>Miercoles</option>
              @endif
              @if($medico->dia_final=="Jueves")
              <option selected>Jueves</option>
              @else
              <option>Jueves</option>
              @endif
              @if($medico->dia_final=="Viernes")
              <option selected>Viernes</option>
              @else
              <option>Viernes</option>
              @endif
              @if($medico->dia_final=="Sabado")
              <option selected>Sabado</option>
              @else
              <option>Sabado</option>
              @endif
              @if($medico->dia_final=="Domingo")
              <option selected>Domingo</option>
              @else
              <option>Domingo</option>
              @endif
            </select>
          </div>
        </div>
        <div class="row">
          <label style="width: 100%; text-align: center; font-weight: bold; font-size: 25px;">HORAS</label>
          <div class="col-md-6">
            <label>HORA INICIAL</label>
            <input type="time" class="form-control" name="hora_i" value="{{$medico->hora_inicio}}">
          </div>
          <div class="col-md-6">
            <label>HORA TERMINO</label>
            <input type="time" class="form-control" name="hora_f" value="{{$medico->hora_final}}">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="id_medico" value="{{$medico->id}}">
        <button class="btn btn-success">GUARDAR</button>
</form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
      </div>
    </div>
  </div>
</div>





            @endforeach
            </tbody>      
          </table>

          </div>
      </div> 
</div>

@if(Session::get('message')=="Horario Agregado con éxito")
<script type="text/javascript">
  document.getElementById("profile-CPA").classList.remove("active");
  document.getElementById("profileCPA").classList.remove("active");
  document.getElementById("profileCPA").classList.remove("show");
  document.getElementById("profile-CME").classList.add("active");
  document.getElementById("profileCME").classList.add("active");
  document.getElementById("profileCME").classList.add("show");
</script>
@endif


@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('js')
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.table').DataTable({
       "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
       }
    });
  });
  function pasar_id($dato){
    document.getElementById("id_trapaso").value=$dato;
    document.getElementById("text_nombre").innerHTML=null;
    $.ajax({
        url: "{{url('/buscar_paciente')}}"+'/'+$dato,
        dataType: "json",
        //context: document.body
      }).done(function(result) {
        //$( this ).addClass( "done" );
        console.log(result);

      if(result.length==null){

        document.getElementById("text_nombre").innerHTML=null;

      }else{
        document.getElementById("text_nombre").innerHTML=result[0].nombre+' '+result[0].apellido_pat+' '+result[0].apellido_mat;
         
      }
        
      });
    
  }

  $( '#especialidad' ).change(function( event ) {

     $('#area').val('');
     $('#medico').empty();
     var value = $(this).val();
      $.ajax({
        url: "{{url('/buscar_especialidad')}}"+'/'+value,
        dataType: "json",
        //context: document.body
      }).done(function(result) {
        //$( this ).addClass( "done" );
        console.log(result);

      if(result.length==null){

        $('#area').val('');
        $('#medico').empty();

      }else{
        $('#area').val(result[0].Area);

        $.ajax({
        url: "{{url('/buscar_medico')}}"+'/'+value,
        dataType: "json",
        //context: document.body
        }).done(function(result2) {
        //$( this ).addClass( "done" );
        console.log(result2);
        for(var i=0;i<result2.length;i++){
               $('#medico').append('<option value="'+result2[i].id+'">'+result2[i].nombre+' '+result2[i].apellido_pat+' '+result2[i].apellido_mat+'</option>');
         }
        });
         
      }
        
      });

  });

  $( '#procedimiento' ).change(function( event ) {

     $('#costo').val('');
     var value = $(this).val();
      $.ajax({
        url: "{{url('/buscar_procedimiento')}}"+'/'+value,
        dataType: "json",
        //context: document.body
      }).done(function(result) {
        //$( this ).addClass( "done" );
        console.log(result);

      if(result.length==null){

        $('#costo').val('');

      }else{
        $('#costo').val(result[0].Costo);
         
      }
        
      });

  });

</script>
@stop