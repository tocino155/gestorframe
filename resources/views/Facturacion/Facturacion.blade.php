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

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


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
        <button class="btn" style="background:pink; color:white;" data-toggle="modal" data-target="#aseguradora">ASEGURADORA</button>
            </td> 

                </tr>
            </tbody>      
          </table>

</div>
</div>
</div>

<!--MODAL ASIGNAR Y REASGINAR -->
<div class="modal fade" id="aseguradora" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">ASEGURADORA</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
<form method="POST" action="{{url('')}}">
  @csrf

        <div class="row">
          <div class="col-md-12">
            <label>ASEGURADORA</label>
            <select id="buscadorAS" class="form-control">
              <option>valorX</option>
            </select>
          </div>
      </div>
<br>
<div class="row">
          <div class="col-md-7">
            <label>DESCUENTO ESTABLECIDO POR LA ASEGURADORA</label>
            <input type="text" name="" class="form-control">
            
          </div>
          <div class="col-md-5">
            <label>FECHA DE PAGO POR ASEGURADORA</label>
            <input type="date" name="fecha" class="form-control" required>
          </div>
</div>

        <br>
        <div class="row">
          <div class="col-md-12">
            <label>OBSERVACIONES</label>
            <textarea class="form-control" onkeyup="this.value = this.value.toUpperCase();" required></textarea>
          </div>
      </div>
          

          
          
      <div class="modal-footer">
        <input type="hidden" name="id_recibo_A" value="">
        <button class="btn btn-primary" id="folio">GUARDAR</button>
</form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
      </div>
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