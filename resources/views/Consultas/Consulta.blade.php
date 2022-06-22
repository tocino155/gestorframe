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

#btnGroupDrop1::after{
content: none;
} 


input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
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

            </tbody>      
          </table>


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
            </tbody>      
          </table>

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
</script>
@stop