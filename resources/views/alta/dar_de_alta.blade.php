@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div><h1><center>REGISTROS</center></h1></div>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
<link href="https://cdn.bootcss.com/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">


@stop

@section('content')



<style type="text/css">
  .marca:hover{
      background: #DBDBDB;
   }

  input[type=number]::-webkit-inner-spin-button, 
  input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none; 
    margin: 0;
  }
  input[type="file"]{
        background: white;
        outline: none;
     }
  ::-webkit-file-upload-button{
    margin-top: -20px;
    margin-left: -10px;
    background: #B60000;
    color: white;
    height: 35px;
    border: none;
    outline: none;
    font-weight: bolder;
    cursor: pointer;
    border-radius: 5px;
  }
  ::-webkit-file-upload-button:hover{
   background: #111111;

  }
  
  .boton_interno{
      font-weight: bold;
      padding: 8px;
  }
  .select2-selection__choice__display{
    color: black;
    font-weight: bold;
  }
</style>



@if(Session::has('message'))
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
        <a class="nav-link active btn" id="profile-tabAC" data-toggle="tab" href="#profileAC" role="tab" aria-controls="profileAC" aria-selected="false" style="font-weight: bold; " >PACIENTES</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link btn" id="profile-tabaAB" data-toggle="tab" href="#profileAB" role="tab" aria-controls="profileAB" aria-selected="false" style="font-weight: bold; " >MEDICOS</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">


      <div class="tab-pane fade show active" id="profileAC" role="tabpanel" aria-labelledby="profile-tabAC">

        <br><br>
        <button class="btn btn btn-outline-primary" data-toggle="modal" data-target="#agregar_pasiente" id="p_c">NUEVO PACIENTE</button>
        <br><br><br>
        <div class="table-responsive">
          <table class="table" style="font-weight: bold;">
            <thead class="thead-dark">
              <tr>
                <th style="text-align: center;">FOLIO</th>
                <th style="text-align: center;">NOMBRE</th>
                <th style="text-align: center;">FECHA DE NACIMIENTO</th>
                <th style="text-align: center;">DOMICILIO</th>
                <th style="text-align: center;">PAIS</th>
                <th style="text-align: center;">TELEFONO</th>
                <th style="text-align: center;">CORREO</th>
                <th style="text-align: center;">AREA</th>
                <th style="text-align: center;">OPCIONES</th>
              </tr>
            </thead>
            <tbody>
              @foreach($pacientes as $pasiente)
              <?php $area=null;$especialidad=null; ?>
              <tr class="marca">
                <td style="text-align: center;">
                  <?php echo substr($pasiente->nombre,0,1).substr($pasiente->apellido_pat,0,1).substr($pasiente->apellido_mat,0,1)."-";  ?>
                  {{$pasiente->id}}
                </td>
                <td style="text-align: center;">{{$pasiente->nombre}} {{$pasiente->apellido_pat}} {{$pasiente->apellido_mat}}</td>
                <td style="text-align: center;">{{$pasiente->fecha_nacimiento}}</td>
                <td style="text-align: center; white-space: pre-wrap;">{{$pasiente->domicilio}}</td>
                <td style="text-align: center;">
                  @foreach($paises as $pais)
                  @if($pais->id==$pasiente->id_pais)
                  {{$pais->nombre}}
                  @endif()
                  @endforeach
                </td>
                <td style="text-align: center;">{{$pasiente->telefono}}</td>
                <td style="text-align: center;">{{$pasiente->correo}}</td>
                <td style="text-align: center;">
                @foreach($pacientes_asignaciones as $paciente_asi)
                @if($paciente_asi->id_paciente==$pasiente->id)
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
                Sin Asignar
                @endif
                </td>
                <td style="text-align: center;">
                  <button class="btn btn-warning boton_interno" style="margin-right: 10px;"  data-toggle="modal" data-target="#editar_pasiente{{$pasiente->id}}">EDITAR</button>
                  <button class="btn btn-danger boton_interno"  data-toggle="modal" data-target="#eliminar_pasiente{{$pasiente->id}}">ELIMINAR</button>
                </td>
              </tr>


<!-- editar paciente-->
<div class="modal fade" id="editar_pasiente{{$pasiente->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">EDITAR PACIENTE</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
<form method="POST" action="{{url('/actualizar_pasiente')}}" enctype="multipart/form-data">
  @csrf
        <div class="row">
          <div class="col-md-3">
            <label>NOMBRE</label>
            <input type="text" name="nombre" class="form-control" onkeyup="this.value = this.value.toUpperCase();" required value="{{$pasiente->nombre}}">
          </div>
          <div class="col-md-3">
            <label>APELLIDO PATERNO</label>
            <input type="text" name="ape_pat" class="form-control" onkeyup="this.value = this.value.toUpperCase();" required value="{{$pasiente->apellido_pat}}">
          </div>
          <div class="col-md-3">
            <label>APELLIDO MATERNO</label>
            <input type="text" name="ape_mat" class="form-control" onkeyup="this.value = this.value.toUpperCase();" required value="{{$pasiente->apellido_mat}}">
          </div>
          <div class="col-md-3">
            <label>FECHA DE NACIMIENTO</label>
            <input type="date" name="fecha" class="form-control" required value="{{$pasiente->fecha_nacimiento}}">
          </div>
        </div>
        <br><br>
        <div class="row">
          <div class="col-md-3">
            <label>CODIGO POSTAL</label>
            <input type="number" name="cp" id="cp_e{{$pasiente->id}}" class="form-control" value="{{$pasiente->cp}}" onkeyup="soltar{{$pasiente->id}}()" >
          </div>
          <div class="col-md-3">
            <label>ALCALDIA / MUNICIPIO</label>
            <input type="text" name="delegacion" id="delegacion_e{{$pasiente->id}}" class="form-control" readonly value="{{$pasiente->delegacion}}">
          </div>
          <div class="col-md-3">
            <label>ESTADO</label>
            <input type="text" name="estado" id="estado_e{{$pasiente->id}}" class="form-control" readonly value="{{$pasiente->estado}}">
          </div>
          <div class="col-md-3">
            <label>COLONIA</label>
            <select name="colonia" id="colonia_e{{$pasiente->id}}" class="form-control">
              <option>{{$pasiente->colonia}}</option>
            </select>
          </div>
        </div>
        <br><br>
        <div class="row">
          <div class="col-md-3">
            <label>PAIS</label>
            <select name="pais" class="form-control">
              <option value="" selected disabled>.:SELECCONA:.</option>
              @foreach($paises as $pais)
              @if($pasiente->id_pais==$pais->id)
              <option value="{{$pais->id}}" selected>{{$pais->nombre}}</option>
              @else
              <option value="{{$pais->id}}">{{$pais->nombre}}</option>
              @endif
              @endforeach
            </select>
          </div>
          <div class="col-md-3">
            <label>TELEFONO</label>
            <input type="text" name="tel" class="form-control" required minlength="10" maxlength="10" onkeypress="return event.charCode>=48 && event.charCode<=57" value="{{$pasiente->telefono}}">
          </div>
          <div class="col-md-6">
            <label>FOTOGRAFIA</label>
            <input type="file" name="foto" class="form-control">
            @if($pasiente->foto!=null)
            <a class="btn btn-link" data-toggle="modal" data-target="#foto_pasiente{{$pasiente->id}}">ver foto</a>
            <input type="hidden" name="foto_old" value="{{$pasiente->foto}}">
            @else
            <p>sin foto</p>
            @endif
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-6">
              <label>DOMICILIO</label>
              <input type="text" class="form-control" name="domicilio" required value="{{$pasiente->domicilio}}">
          </div>
          <div class="col-md-6">
            <label>CORREO</label>
            <input type="text" name="correo" class="form-control" required value="{{$pasiente->correo}}">
          </div>
        </div>
        <br><br>
        <div class="row">
          <div class="col-md-7">
            <label>OBSERVACIONES</label>
            <textarea class="form-control" name="observaciones" onkeyup="this.value = this.value.toUpperCase();" required>{{$pasiente->observaciones}}</textarea>   
          </div>

          <div class="col-md-5">
            <label>ANTECEDENTES CLINICOS</label>
            <input type="file" name="antecedentes" class="form-control" >
            @if($pasiente->ATE_clinicos!=null)
            <a href="{{url('/archivos_pacientes_ingreso'.'/'.$pasiente->ATE_clinicos)}}" target="_blank">ver archivo</a>
            <input type="hidden" name="antecedentes_old" value="{{$pasiente->ATE_clinicos}}">
            @else
            <p>sin archivo</p>
            @endif
            
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <input type="hidden" name="id_pasiente" value="{{$pasiente->id}}">
        <button class="btn btn-warning" id="folio">ACTUALIZAR</button>
</form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
      </div>
    </div>
  </div>
</div>












<!--eliminar pasiente -->

<div class="modal fade" id="eliminar_pasiente{{$pasiente->id}}"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">ELIMINAR PACIENTE</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
<form method="POST" action="{{url('/eliminar_pasiente')}}">
  @csrf
  @method('DELETE')
        <p style="font-size: 30px; text-align: center; font-weight: bold;">¿ESTAS SEGURO DE ELIMINAR?</p>
        <div style="text-align: center;">
          <label style="font-size: 20px; text-align: center; font-weight: bold;">PACIENTE:</label>
          <label style="font-size: 20px; text-align: center; font-weight: bold; color: red;">{{$pasiente->nombre}} {{$pasiente->apellido_pat}} {{$pasiente->apellido_mat}}</label>
        </div>
        
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" id="id_pasiente_eliminar" value="{{$pasiente->id}}" name="id_pasiente_eliminar">ELIMINAR</button>
</form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
      </div>
    </div>
  </div>
</div>


<!--foto -->

<div class="modal fade" id="foto_pasiente{{$pasiente->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="background-color: #111111bd;">
  <div class="modal-dialog modal-dialog-centered" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">FOTO ACTUAL</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align: center;">
        <img src="{{url('/archivos_pacientes_ingreso'.'/'.$pasiente->foto)}}" width="50%" height="50%">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
      </div>
    </div>
  </div>
</div>




<script type="text/javascript">
  function soltar{{$pasiente->id}}() {

   $('#estado_e{{$pasiente->id}}').val('');
   $('#delegacion_e{{$pasiente->id}}').val('');
    $('#colonia_e{{$pasiente->id}}').empty();
   var value = $('#cp_e{{$pasiente->id}}').val();

   if(value.length==5){

      $.ajax({
        url: "{{url('/buscar_cp')}}"+'/'+value,
        dataType: "json",
        //context: document.body
      }).done(function(result) {
        //$( this ).addClass( "done" );
        console.log(result);

      if(result.length==0){

         $('#estado_e{{$pasiente->id}}').val('');
         $('#delegacion_e{{$pasiente->id}}').val('');
         $('#colonia_e{{$pasiente->id}}').empty();

      }else{

         $('#estado_e{{$pasiente->id}}').val(result[0].estado);
         $('#delegacion_e{{$pasiente->id}}').val(result[0].municipio);

         for(var i=0;i<result.length;i++){
               $('#colonia_e{{$pasiente->id}}').append('<option value="'+result[i].colonia+'">'+result[i].colonia+'</option>');
         }

      }
        
      
      });



   }else{

      $('#estado_e{{$pasiente->id}}').val('');
      $('#delegacion_e{{$pasiente->id}}').val('');
      $('#colonia_e{{$pasiente->id}}').empty();

   }
  }
</script>


              @endforeach
            </tbody>
          </table>
        </div>



      </div>


      <div class="tab-pane fade" id="profileAB" role="tabpanel" aria-labelledby="profile-tabAB">
        <br><br>
        <button class="btn btn btn-outline-primary" data-toggle="modal" data-target="#agregar_doctor" id="m_c">NUEVO MEDICO</button>
        <br><br><br>
        <div class="table-responsive">
          <table class="table" style="font-weight: bold;">
            <thead class="thead-dark">
              <tr>
                <th style="text-align: center;">FOLIO</th>
                <th style="text-align: center;">NOMBRE</th>
                <th style="text-align: center;">ESPECIALIDAD</th>
                <th style="text-align: center;">AREA</th>
                <th style="text-align: center;">OPCIONES</th>
              </tr>
            </thead>
            <tbody>
              @foreach($medicos as $medico)
              <tr class="marca">
                <td style="text-align: center;">{{$medico->id}}</td>
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
                <td style="text-align: center;">
                  <button class="btn btn-warning boton_interno" style="margin-right: 10px;" data-toggle="modal" data-target="#editar_doctor{{$medico->id}}">EDITAR</button>
                  <button class="btn btn-danger boton_interno"  data-toggle="modal" data-target="#eliminar_doctor{{$medico->id}}">ELIMINAR</button>
                </td>
              </tr>


<!--editar doctor -->
<div class="modal fade" id="editar_doctor{{$medico->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">REGISTRO DE NUEVOS MEDICOS</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
<form method="POST" action="{{url('/actualizar_medico')}}">
  @csrf
        <div><center>
          <div>
            <label>NOMBRE</label>
            <input type="text" name="nombre" class="form-control" onkeyup="this.value = this.value.toUpperCase();" required value="{{$medico->nombre}}">
          </div>
          <div>
            <label>APELLIDO PATERNO</label>
            <input type="text" name="ape_pat" class="form-control" onkeyup="this.value = this.value.toUpperCase();" required value="{{$medico->apellido_pat}}">
          </div>
          <div>
            <label>APELLIDO MATERNO</label>
            <input type="text" name="ape_mat" class="form-control" onkeyup="this.value = this.value.toUpperCase();" required value="{{$medico->apellido_mat}}">
          </div>

          <div>
            <label>ESPECIALIDAD</label>
            <select name="especialidad" id="especialidad" class="form-control ">
              <option value="" selected disabled>.:SELECCONA:.</option>
              @foreach($especialidades as $especialidad)
              @if($especialidad->id==$medico->id_especialidad)
              <option value="{{$especialidad->id}}" selected>{{$especialidad->Especialidad}}</option>
              @else
              <option value="{{$especialidad->id}}">{{$especialidad->Especialidad}}</option>
              @endif
              @endforeach
            </select>
          </div>
        </center>
      </div>
    </div>
          
      <div class="modal-footer">
        <input type="hidden" name="id_medico" value="{{$medico->id}}">
        <button class="btn btn-warning" id="folio">ACTUALIZAR</button>
</form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
      </center></div>
    </div>
  </div>
</div>










<!--eliminar pasiente -->

<div class="modal fade" id="eliminar_doctor{{$medico->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">ELIMINAR MEDICO</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
<form method="POST" action="{{url('/eliminar_medico')}}">
  @csrf
  @method('DELETE')
        <p style="font-size: 30px; text-align: center; font-weight: bold;">¿ESTAS SEGURO DE ELIMINAR?</p>
        <div style="text-align: center;">
          <label style="font-size: 20px; text-align: center; font-weight: bold;">MEDICO:</label>
          <label style="font-size: 20px; text-align: center; font-weight: bold; color: red;">{{$medico->nombre}} {{$medico->apellido_pat}} {{$medico->apellido_mat}}</label>
        </div>
        
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" id="id_medico_eliminar" value="{{$medico->id}}" name="id_medico_eliminar">ELIMINAR</button>
</form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
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
  </div>
</div>


<!--agregar pasiente -->
<div class="modal fade" id="agregar_pasiente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">NUEVO PACIENTE</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
<form method="POST" action="{{url('/guardar_pasiente')}}" enctype="multipart/form-data">
  @csrf
        <div class="row">
          <div class="col-md-3">
            <label>NOMBRE</label>
            <input type="text" name="nombre" class="form-control" onkeyup="this.value = this.value.toUpperCase();" required>
          </div>
          <div class="col-md-3">
            <label>APELLIDO PATERNO</label>
            <input type="text" name="ape_pat" class="form-control" onkeyup="this.value = this.value.toUpperCase();" required>
          </div>
          <div class="col-md-3">
            <label>APELLIDO MATERNO</label>
            <input type="text" name="ape_mat" class="form-control" onkeyup="this.value = this.value.toUpperCase();" required>
          </div>
          <div class="col-md-3">
            <label>FECHA DE NACIMIENTO</label>
            <input type="date" name="fecha" class="form-control" required>
          </div>
        </div>
        <br><br>
        <div class="row">
          <div class="col-md-3">
            <label>CODIGO POSTAL</label>
            <input type="number" name="cp" id="cp" class="form-control">
          </div>
          <div class="col-md-3">
            <label>ALCALDIA / MUNICIPIO</label>
            <input type="text" name="delegacion" id="delegacion" class="form-control" readonly>
          </div>
          <div class="col-md-3">
            <label>ESTADO</label>
            <input type="text" name="estado" id="estado" class="form-control" readonly>
          </div>
          <div class="col-md-3">
            <label>COLONIA</label>
            <select name="colonia" id="colonia" class="form-control"></select>
          </div>
        </div>
        <br><br>
        <div class="row">
          <div class="col-md-3">
            <label>PAIS</label>
            <select name="pais" class=" form-control js-example-basic-multiple" style="width: 100%;" multiple id="pais">
              @foreach($paises as $pais)
              @if($pais->id==146)
              <option value="{{$pais->id}}" selected >{{$pais->nombre}}</option>
              @else
              <option value="{{$pais->id}}">{{$pais->nombre}}</option>
              @endif
              @endforeach
            </select>
          </div>
          <div class="col-md-3">
            <label>TELEFONO</label>
            <input type="text" name="tel" class="form-control" required minlength="10" maxlength="10" onkeypress="return event.charCode>=48 && event.charCode<=57">
          </div>
          <div class="col-md-6">
            <label>FOTOGRAFIA</label>
            <input type="file" name="foto" class="form-control">
          </div>
        </div>
        <br><br>
        <div class="row">
          <div class="col-md-6">
              <label>DOMICILIO</label>
              <input type="text" class="form-control" name="domicilio" required>
          </div>
          <div class="col-md-6">
            <label>CORREO</label>
            <input type="text" name="correo" class="form-control" required>
          </div>
        </div>
        <br><br>
        <div class="row">
          <div class="col-md-7">
            <label>OBSERVACIONES</label>
            <textarea class="form-control" name="observaciones" onkeyup="this.value = this.value.toUpperCase();" required></textarea>   
          </div>

          <div class="col-md-5">
            <label>ANTECEDENTES CLINICOS</label>
            <input type="file" name="antecedentes" class="form-control" >
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button class="btn btn-success" id="folio">AGREGAR</button>
</form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
      </div>
    </div>
  </div>
</div>


<!--agregar doctor -->
<div class="modal fade" id="agregar_doctor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">REGISTRO DE NUEVOS MEDICOS</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
<form method="POST" action="{{url('/guardar_medico')}}">
  @csrf
        <div><center>
          <div>
            <label>NOMBRE</label>
            <input type="text" name="nombre" class="form-control" onkeyup="this.value = this.value.toUpperCase();" required>
          </div>
          <div>
            <label>APELLIDO PATERNO</label>
            <input type="text" name="ape_pat" class="form-control" onkeyup="this.value = this.value.toUpperCase();" required>
          </div>
          <div>
            <label>APELLIDO MATERNO</label>
            <input type="text" name="ape_mat" class="form-control" onkeyup="this.value = this.value.toUpperCase();" required>
          </div>

          <div>
            <label>ESPECIALIDAD</label>
            <select name="especialidad" id="especialidad" class="form-control ">
              <option value="" selected disabled>.:SELECCONA:.</option>
              @foreach($especialidades as $especialidad)
              <option value="{{$especialidad->id}}">{{$especialidad->Especialidad}}</option>
              @endforeach
            </select>
          </div>
        </center>
      </div>
    </div>
          
      <div class="modal-footer">
        <button class="btn btn-success" id="folio">GUARDAR</button>
</form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
      </center></div>
    </div>
  </div>
</div>



@if(Session::get('message')=="Medico Guardado con éxito" || Session::get('message')=="Medico Actualizado con éxito" || Session::get('message')=="Medico Eliminado con éxito")
<script type="text/javascript">
  document.getElementById("profile-tabAC").classList.remove("active");
  document.getElementById("profileAC").classList.remove("active");
  document.getElementById("profileAC").classList.remove("show");
  document.getElementById("profile-tabaAB").classList.add("active");
  document.getElementById("profileAB").classList.add("active");
  document.getElementById("profileAB").classList.add("show");
</script>
@endif






@stop




@section('js')
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">

  var ultimoValorValido = 146;
  $("#pais").on("change", function() {
  if ($("#pais option:checked").length > 1) {
    $("#pais").val(ultimoValorValido);
  } else {
    ultimoValorValido = $("#pais").val();
  }
  });

  $(document).ready(function() {
    $('.table').DataTable({
       "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
       }
    });
  });

  $( '#cp' ).keyup(function( event ) {

   $('#estado').val('');
   $('#delegacion').val('');
    $('#colonia').empty();
   var value = $(this).val();

   if(this.value.length==5){

      $.ajax({
        url: "{{url('/buscar_cp')}}"+'/'+value,
        dataType: "json",
        //context: document.body
      }).done(function(result) {
        //$( this ).addClass( "done" );
        console.log(result);

      if(result.length==0){

         $('#estado').val('');
         $('#delegacion').val('');
         $('#colonia').empty();

      }else{

         $('#estado').val(result[0].estado);
         $('#delegacion').val(result[0].municipio);

         for(var i=0;i<result.length;i++){
               $('#colonia').append('<option value="'+result[i].colonia+'">'+result[i].colonia+'</option>');
         }

      }
        
      
      });



   }else{

      $('#estado').val('');
      $('#delegacion').val('');
      $('#colonia').empty();

   }
  });

$(document).ready(function() {
    $('.js-example-basic-single').select2();
    $('.js-example-basic-multiple').select2();
});

$(document).ready(function(){
  const valores = window.location.search;

  //Mostramos los valores en consola:
  console.log(valores);

  //Creamos la instancia
  const urlParams = new URLSearchParams(valores);

  //Accedemos a los valores
  var bot = urlParams.get('bot_result');
  if(bot!=null && bot=="active_modal"){

    document.getElementById("p_c").click();

  }else if(bot!=null && bot=="active_modal_medi"){
    document.getElementById("profile-tabaAB").click();
    document.getElementById("m_c").click();

  }else if(bot!=null && bot=="modal_medi"){
    document.getElementById("profile-tabaAB").click();
  }
});

</script>
@stop