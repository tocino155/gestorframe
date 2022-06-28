<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                    data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif
                @if(!config('adminlte.sidebar_nav_accordion'))
                    data-accordion="false"
                @endif>
                {{-- Configured sidebar links --}}
                @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')
            </ul>
            <div><center>
                    <div class="table-responsive" data-toggle="modal" data-target="#turnos" style="height: 500px; overflow: auto;">
                        <table style="font-weight:bold; color:white;">
                            <thead>
                              <tr>
                                <th style="text-align:center;">TURNO</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($pacientes as $paciente)
                            @if($paciente->id_estatus==2)
                            <tr><td style="text-align: center;">
                            @foreach($pacientes_asignaciones as $paciente_asi)
                            @if($paciente_asi->id_paciente==$paciente->id)
                            @foreach($areas as $area)
                            @if($area->Especialidad==$paciente_asi->id_especialidad)
                            @break
                            @endif
                            @endforeach
                            @endif
                            @endforeach
                            <?php echo strtoupper(substr($area->Area,0,2))."-";  ?>
                            @foreach($pacientes_asignaciones as $paciente_asi)
                            @if($paciente_asi->id_paciente==$paciente->id)
                            @foreach($especialidades as $especialidad)
                            @if($especialidad->id==$paciente_asi->id_especialidad)
                            @break
                            @endif
                            @endforeach
                            @endif
                            @endforeach
                            <?php echo substr($especialidad->Especialidad,0,3)."-"; ?>
                            <?php echo substr($paciente->nombre,0,1).substr($paciente->apellido_pat,0,1).substr($paciente->apellido_mat,0,1)."-";  ?>
                            {{$paciente->id}}
                            </td></tr>
                            @endif
                            @endforeach
                            </tbody>  
                        </table>    
                    </div>
            </div></center>

        </nav>
    </div>





</aside>


<!--ver turnos -->
<div class="modal fade" id="turnos" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">TURNOS</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th style="text-align: center;">TURNO</th>
                        <th style="text-align: center;">NOMBRE PACIENTE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pacientes as $paciente)
                    @if($paciente->id_estatus==2)
                    <tr><td style="text-align: center;">
                    @foreach($pacientes_asignaciones as $paciente_asi)
                    @if($paciente_asi->id_paciente==$paciente->id)
                    @foreach($areas as $area)
                    @if($area->Especialidad==$paciente_asi->id_especialidad)
                    @break
                    @endif
                    @endforeach
                    @endif
                    @endforeach
                    <?php echo strtoupper(substr($area->Area,0,2))."-";  ?>
                    @foreach($pacientes_asignaciones as $paciente_asi)
                    @if($paciente_asi->id_paciente==$paciente->id)
                    @foreach($especialidades as $especialidad)
                    @if($especialidad->id==$paciente_asi->id_especialidad)
                    @break
                    @endif
                    @endforeach
                    @endif
                    @endforeach
                    <?php echo substr($especialidad->Especialidad,0,3)."-"; ?>
                    <?php echo substr($paciente->nombre,0,1).substr($paciente->apellido_pat,0,1).substr($paciente->apellido_mat,0,1)."-";  ?>
                    {{$paciente->id}}
                    </td>
                    <td style="text-align: center;">{{$paciente->nombre}} {{$paciente->apellido_pat}} {{$paciente->apellido_mat}}</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
      </div>
    </div>
  </div>
</div>    



