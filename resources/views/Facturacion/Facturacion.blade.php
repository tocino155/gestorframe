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
    <br><br>
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
          @foreach($pacientes as $paciente)
          <?php $descuento=0; ?>
          <?php $suma=0; $total=0; $total2=0; $porcentaje=0;?>  
          <tr class="marca">
            <td style="text-align: center;">turno</td> 
            <td style="text-align: center;">{{$paciente->nombre}} {{$paciente->apellido_pat}} {{$paciente->apellido_mat}}</td>  
            <td style="text-align: center;">
              @if($paciente->id_aseguradora!=null)
              @foreach($aseguradoras as $aseguradora)
              @if($aseguradora->id==$paciente->id_aseguradora)
              {{$aseguradora->Aseguradora}}
              <?php $descuento=$aseguradora->Porcentaje; ?>
              @endif
              @endforeach
              @else
              <p>sin aseguradora</p>
              @endif
            </td> 
            <td style="text-align: center;">{{$descuento}}%</td> 
            @foreach($pacientes_asignaciones as $paciente_asi)
            @foreach($procedimientos as $procedimiento)
            @if($procedimiento->id==$paciente_asi->id_procedimiento && $paciente_asi->id_paciente==$paciente->id)
            <?php $suma+=$procedimiento->Costo; ?>
            @endif
            @endforeach
            @endforeach
            @foreach($aseguradoras as $aseguradora)
            @if($aseguradora->id==$paciente->id_aseguradora)
            <?php $porcentaje=$aseguradora->Porcentaje;?>
            @endif
            @endforeach
            <?php $total=($suma*$porcentaje)/100; $total2=$suma-$total;?>
            <td style="text-align: center;">$ {{$suma}}</td> 
            <td style="text-align: center;">$ {{$total2}}</td> 
            <td style="text-align: center;">
              <div id="menu_opciones{{$paciente->id}}" class="visible_off " style=" padding: 10px; background: #DBDBDB;">
                <button class="close" type="button" onclick='menu_opciones{{$paciente->id}}.classList.remove("visible_on"); menu_opciones{{$paciente->id}}.classList.add("visible_off");'>
                  <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                  </svg>
                </button>
                  <br>
                  <button class="btn btn-primary igual"  style="margin-bottom: 10px;margin-top: 10px;" data-toggle="modal" data-target="#factura_pasiente{{$paciente->id}}">TICKET</button><br>
                  <button class="btn btn-info igual"  style="margin-bottom: 10px;" data-toggle="modal" data-target="#pagado_paciente{{$paciente->id}}">ASIGNAR ESTATUS DE PAGADO</button><br>
                  <button class="btn igual" style="background:pink; color:white;" data-toggle="modal" data-target="#aseguradora{{$paciente->id}}" onclick="pasar_id_aseguradora{{$paciente->id}}({{$paciente->id_aseguradora}})">ASEGURADORA</button><br><br>
              </div>
              @if($paciente->id_estatus!=5)
              <button class="btn btn-success boton_interno" id="menu_M{{$paciente->id}}" style="font-weight: bold; font-size: 20px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-justify" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                </svg>
              </button>
              @else
              <button id="menu_M{{$paciente->id}}" style="display: none;">+</button>
              <p>sin acciones por ser eliminado</p>
              @endif
              
            </td> 
          </tr>

<!--ver factura -->
<div class="modal fade" id="factura_pasiente{{$paciente->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">FACTURA DEL PACIENTE</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <embed type="application/pdf" src="{{url('/generar_factura'.'/'.$paciente->id)}}" style="width:100%; height: 600px;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
      </div>
    </div>
  </div>
</div>          


<!--pagado paciente -->
<div class="modal fade" id="pagado_paciente{{$paciente->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">ASIGNAR PAGO</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<form method="POST" action="{{url('/estatus_pago'.'/'.$paciente->id)}}">
  @csrf
        <p style="font-size: 25px; text-align: center; font-weight: bold;">¿ESTAS SEGURO QUE EL PACIENTE YA PAGO?</p>
        <div style="text-align: center;">
          <label style="font-size: 20px; text-align: center; font-weight: bold;">PACIENTE:</label>
          <label style="font-size: 20px; text-align: center; font-weight: bold; color: red;">{{$paciente->nombre}} {{$paciente->apellido_pat}} {{$paciente->apellido_mat}}</label>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-warning">PAGADO</button>
</form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
      </div>
    </div>
  </div>
</div>



<!--MODAL ASIGNAR Y REASGINAR -->
<div class="modal fade" id="aseguradora{{$paciente->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">ASEGURADORA</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
        <div style="text-align: center;">
          <label style="font-size: 20px; text-align: center; font-weight: bold;">PACIENTE:</label>
          <label style="font-size: 20px; text-align: center; font-weight: bold; color: red;">{{$paciente->nombre}} {{$paciente->apellido_pat}} {{$paciente->apellido_mat}}</label>
        </div>
<form method="POST" action="{{url('/asignar_aseguradora')}}">
  @csrf
        <div class="row">
          <div class="col-md-12">
            <label>ASEGURADORA</label>
            <select id="buscadorAS" name="aseguradora" class="form-control" onchange="cambio_valor{{$paciente->id}}(this.value);">
              <option value="" selected disabled>.:SELECCONA:.</option>
              @foreach($aseguradoras as $aseguradora)
              @if($aseguradora->id==$paciente->id_aseguradora)
              <option selected value="{{$aseguradora->id}}">{{$aseguradora->Aseguradora}}</option>
              @else
              <option value="{{$aseguradora->id}}">{{$aseguradora->Aseguradora}}</option>
              @endif
              @endforeach
            </select>
          </div>
      </div>
      <br>
        <div class="row">
          <div class="col-md-7">
            <label>DESCUENTO ESTABLECIDO POR LA ASEGURADORA</label>
            <input type="text" name="descuento" class="form-control" id="descuento{{$paciente->id}}" readonly>
            
          </div>
          <div class="col-md-5">
            <label>FECHA DE PAGO POR ASEGURADORA</label>
            @if($paciente->fecha_pago==null)
            <input type="date" name="fecha_pago" class="form-control" required value="<?php echo date('Y-m-d') ?>">
            @else
            <input type="date" name="fecha_pago" class="form-control" required value="{{$paciente->fecha_pago}}">
            @endif
          </div>
        </div>

        <br>
        <div class="row">
          <div class="col-md-12">
            <label>OBSERVACIONES</label>
            <textarea class="form-control" name="observaciones" required>{{$paciente->observaciones_aseguradora}}</textarea>
          </div>
        </div>
      <div class="modal-footer">
        <input type="hidden" name="id_paciente" value="{{$paciente->id}}">
        <button class="btn btn-primary" id="folio">GUARDAR</button>
</form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
      </div>
    </div>
  </div>
</div>







<script type="text/javascript">

  menu_M{{$paciente->id}}.addEventListener("click",function(){
        var top_y=this.getBoundingClientRect() //odtenemos el valor de la posicion del boton
        menu_opciones{{$paciente->id}}.style.top=top_y.top-40+"px";
        menu_opciones{{$paciente->id}}.style.left=top_y.left-150+"px";
        menu_opciones{{$paciente->id}}.classList.add("visible_on");
        menu_opciones{{$paciente->id}}.classList.remove("visible_off");
    });
  menu_opciones{{$paciente->id}}.addEventListener("mouseleave",function(){
        menu_opciones{{$paciente->id}}.classList.remove("visible_on");
        menu_opciones{{$paciente->id}}.classList.add("visible_off");
    });

  function pasar_id_aseguradora{{$paciente->id}}($dato){
    $.ajax({
        url: "{{url('/buscar_aseguradora')}}"+'/'+$dato,
        dataType: "json",
        //context: document.body
      }).done(function(result) {
        //$( this ).addClass( "done" );
        console.log(result);

      if(result[0]==null){

        document.getElementById("descuento{{$paciente->id}}").value=null;

      }else{
        document.getElementById("descuento{{$paciente->id}}").value=result[0].Porcentaje;
         
      }
        
      });
  }
  function cambio_valor{{$paciente->id}}($dato){
    $.ajax({
        url: "{{url('/buscar_aseguradora')}}"+'/'+$dato,
        dataType: "json",
        //context: document.body
      }).done(function(result) {
        //$( this ).addClass( "done" );
        console.log(result);

      if(result.length==null){

        document.getElementById("descuento{{$paciente->id}}").value=null;

      }else{
        document.getElementById("descuento{{$paciente->id}}").value=result[0].Porcentaje+"%";
         
      }
        
      });
  }

</script>



          @endforeach
        </tbody>      
      </table>

    </div>
</div>
</div>



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
</script>
@stop