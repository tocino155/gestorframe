@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div><h1><center>FACTURACION</center></h1></div>
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
<div class="table-responsive">
   

<table class="table" style="font-weight: bold;">
            <thead class="thead-dark">
              <tr>
                <th style="text-align: center;">TURNO</th>
                <th style="text-align: center;">NOMBRE</th>
                <th style="text-align: center;">ASEGURADORA</th>
                <th style="text-align: center;">DESCUENTO</th>
                <th style="text-align: center;">IMPORTE</th>
                <th style="text-align: center;">TOTAL</th>
                <th style="text-align: center;">OPCIONES</th>
              </tr>
            </thead>
            <tbody>  
          <tr>
            <td style="text-align: center;"></td> 
            <td style="text-align: center;"></td>  
            <td style="text-align: center;"></td> 
            <td style="text-align: center;"></td> 
            <td style="text-align: center;"></td> 
            <td style="text-align: center;"></td> 
            <td style="text-align: center;">
        <button class="btn btn-primary">TICKET</button>
        <button class="btn btn-info">ASIGNAR ESTATUS DE PAGADO</button>
        <button class="btn" style="background:pink; color:white;">ASEGURADORA</button>
            </td> 

                </tr>
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