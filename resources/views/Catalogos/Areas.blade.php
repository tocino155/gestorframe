@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div><h1><center>CATALOGOS</center></h1></div>
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
<!---msj registrado correctamente -->
@if(Session::has('message'))
  <div class="col-lg-12" id="msj">
    <div class="alert alert-success alert-success-style1 alert-success-stylenone">
        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">&times;</span>
        </button>
        <span class="adminpro-icon adminpro-checked-pro admin-check-sucess admin-check-pro-none"></span>
        <p class="message-alert-none">
        
            <strong> {{ Session::get('message') }} </strong>
        </p>
    </div>
</div>
@endif

<!--msj eliminado correctamente --->
@if(Session::has('msjdelete'))
 <div class="alert alert-danger" role="alert" id="msj">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <p> 
        <strong> {{ Session::get('msjdelete') }} </strong> 
    </p>
</div>
@endif

<!---msjs de actualizar -->
@if(Session::has('msjupdate'))
    <div class="alert alert-primary" role="alert" id="msj">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      <strong> {{ Session::get('msjupdate') }} </strong> 
    </div>
@endif

<br>
<div class="card">
  <div class="card-body">
  <div><h3><center>AREAS</center></h3></div>  
  <button class="btn btn-outline-primary" data-toggle="modal" data-target="#agrega_area" id="p_c">AGREGAR AREAS</button>
<div class="table-responsive">
<br>


<table class="table" style="font-weight: bold;">
            <thead class="thead-dark">
              <tr>
                <th style="text-align: center;">ID</th>
                <th style="text-align: center;">NOMBRE DEL AREA</th>
                <th style="text-align: center;">ESPECIALIDAD</th>
                <th style="text-align: center;">OPCIONES</th>
              </tr>
            </thead>
            <tbody>  
@foreach($areas as $area)
                <tr>
                          <td style="text-align: center;">{{$area->id}}</td>
                          <td style="text-align: center;">{{$area->Area}}</td>
                          <td style="text-align: center;">
                              
    @foreach ($especialidades as $espe)
        @if($area->Especialidad == $espe->id)
            {{ $espe->Especialidad }}
        @endif
    @endforeach

                          </td>
                          <td style="text-align: center;">
                    <div>
<button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal-delete-{{$area->id}}">ELIMINAR
</button>
<button class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#modal-editar-{{$area->id}}">EDITAR
</button>
                    </div>
                     </td>
                 </tr>

<!--MODAL CONFIRMAR ELIMINACION-->
<div class="modal fade" id="modal-delete-{{$area->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
<form method="POST" action="{{url('/Eliminar_area',$area->id)}}">
@csrf
@method('DELETE')                    
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminacion de Area</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    Deseas Eliminar al Registro <br> {{$area->id." ".$area->Area}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
         <button type="submit" class="btn btn-outline-danger">ELIMINAR</button>
      </div>
    </div>
    </form>
  </div>
</div>

<!--MODAL EDITAR AREA -->
<div class="modal fade" id="modal-editar-{{$area->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">EDITAR AREA</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
<form method="POST" action="{{url('/Editar_area',$area->id)}}">
  @csrf
  @method('PUT')   
<div class="row">
          <div class="col-md-12">
            <label>NOMBRE DEL AREA</label>
            <input type="text" value="{{$area->Area}}" name="nombre-area" class="form-control">
            
</div>
</div>
<div class="row">
          <div class="col-md-12">
            <label>ESPECIALIDAD</label>

            <select name="especialidad" class="form-control">
            <option value="11">SELECCIONA...</option>
             @foreach($especialidades as $espe)
            <option value="{{$espe->id}}">{{$espe->Especialidad}}</option>
            @endforeach
            </select>
            
</div>
</div>
      <div class="modal-footer">

        <button class="btn btn-primary">ACTUALIZAR</button>
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

<!--MODAL AGREGAR AREA -->
<div class="modal fade" id="agrega_area" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">AGREGAR AREA</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
<form method="POST" action="{{url('/Guardar_area')}}">
  @csrf
<div class="row">
          <div class="col-md-12">
            <label>NOMBRE DEL AREA</label>
            <input type="text" name="nombre-area" class="form-control">
            
</div>
</div>
<div class="row">
          <div class="col-md-12">
            <label>ESPECIALIDAD</label>

            <select name="especialidad" class="form-control">
            <option value="11">SELECCIONA...</option>
             @foreach($especialidades as $espe)
            <option value="{{$espe->id}}">{{$espe->Especialidad}}</option>
            @endforeach
            </select>
            
</div>
</div>
      <div class="modal-footer">

        <button class="btn btn-primary">GUARDAR</button>
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

  }
});
</script>
@stop