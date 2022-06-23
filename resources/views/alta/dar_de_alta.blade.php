@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
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

input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
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
        <a class="nav-link active btn" id="profile-tabAC" data-toggle="tab" href="#profileAC" role="tab" aria-controls="profileAB" aria-selected="false" style="font-weight: bold; " >PACIENTES</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link btn" id="profile-tabaAB" data-toggle="tab" href="#profileAB" role="tab" aria-controls="profileAB" aria-selected="false" style="font-weight: bold; " >MEDICOS</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">


      <div class="tab-pane fade show active" id="profileAC" role="tabpanel" aria-labelledby="profile-tabAC">

        <br><br>
        <button class="btn btn btn-outline-primary" data-toggle="modal" data-target="#agregar_pasiente">NUEVO PACIENTE</button>
        <br><br><br>
        <div class="table-responsive">
          <table class="table" style="font-weight: bold;">
            <thead class="thead-dark">
              <tr>
                <th style="text-align: center;">FOLIO</th>
                <th style="text-align: center;">NOMBRE</th>
                <th style="text-align: center;">TELEFONO</th>
                <th style="text-align: center;">CORREO</th>
                <th style="text-align: center;">OPCIONES</th>
              </tr>
            </thead>
            <tbody>
              @foreach($pasientes as $pasiente)
              <tr class="marca">
                <td style="text-align: center;">
                  <?php echo substr($pasiente->nombre,0,1).substr($pasiente->apellido_pat,0,1).substr($pasiente->apellido_mat,0,1)."-";  ?>
                  {{$pasiente->id}}
                </td>
                <td style="text-align: center;">{{$pasiente->nombre}} {{$pasiente->apellido_pat}} {{$pasiente->apellido_mat}}</td>
                <td style="text-align: center;">{{$pasiente->telefono}}</td>
                <td style="text-align: center;">{{$pasiente->correo}}</td>
                <td style="text-align: center;">

                  <button class="btn btn-warning" style="margin-right: 10px;">EDITAR</button>
                  <button class="btn btn-danger"  data-toggle="modal" data-target="#eliminar_pasiente{{$pasiente->id}}">ELIMINAR</button>
                </td>
              </tr>

<!--eliminar pasiente -->

<div class="modal fade" id="eliminar_pasiente{{$pasiente->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


              @endforeach
            </tbody>
          </table>
        </div>



      </div>


      <div class="tab-pane fade" id="profileAB" role="tabpanel" aria-labelledby="profile-tabAB">
        <br><br>
        <button class="btn btn btn-outline-primary" data-toggle="modal" data-target="#agregar_doctor">NUEVO DOCTOR</button>
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
              @foreach($pasientes as $pasiente)
              <tr class="marca">
                <td style="text-align: center;">
                  <?php echo substr($pasiente->nombre,0,1).substr($pasiente->apellido_pat,0,1).substr($pasiente->apellido_mat,0,1)."-";  ?>
                  {{$pasiente->id}}
                </td>
                <td style="text-align: center;">{{$pasiente->nombre}} {{$pasiente->apellido_pat}} {{$pasiente->apellido_mat}}</td>
                <td style="text-align: center;">{{$pasiente->telefono}}</td>
                <td style="text-align: center;">{{$pasiente->correo}}</td>
                <td style="text-align: center;">

                  <button class="btn btn-warning" style="margin-right: 10px;">EDITAR</button>
                  <button class="btn btn-danger"  data-toggle="modal" data-target="#eliminar_pasiente{{$pasiente->id}}">ELIMINAR</button>
                </td>
              </tr>

<!--eliminar doctor -->

<div class="modal fade" id="eliminar_pasiente{{$pasiente->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
        <h3 class="modal-title" id="exampleModalLongTitle">NUEVO PASIENTE</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
<form method="POST" action="{{url('/guardar_pasiente')}}">
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
            <select name="pais" class="form-control"></select>
          </div>
          <div class="col-md-3">
            <label>TELEFONO</label>
            <input type="text" name="tel" class="form-control" required minlength="10" maxlength="10" onkeypress="return event.charCode>=48 && event.charCode<=57">
          </div>
          <div class="col-md-6">
            <label>CORREO</label>
            <input type="text" name="correo" class="form-control" required>
          </div>
        </div>
        <br><br>
        <div class="col-md-12">
            <label>DOMICILIO</label>
            <input type="text" class="form-control" name="domicilio" required>
        </div>
        <br><br>
<div class="row">
          <div class="col-md-7">
            <label>OBSERVACIONES</label>
            <textarea class="form-control" name="observaciones" onkeyup="this.value = this.value.toUpperCase();" required></textarea>   
          </div>

          <div class="col-md-5">
            <label>ANTECEDENTES CLINICOS</label>
            <input type="FILE" name="Antecedentes" class="form-control" >
          </div>
</div>


      </div>
      <div class="modal-footer">
        <input type="hidden" name="id_recibo_A" value="">
        <button class="btn btn-success" id="folio">AGREGAR</button>
</form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
<form method="POST" action="{{url('')}}">
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
            <label></label>
            <select name="" id="" class="form-control">
            <option value="value1">Value 1</option>
            </select>
          </div>
          
      <div class="modal-footer">
        <input type="hidden" name="id_recibo_A" value="">
        <button class="btn btn-success" id="folio">GUARDAR</button>
</form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
      </center></div>
    </div>
  </div>
</div>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
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


</script>
@stop