<!DOCTYPE html>
<style type="text/css">
    *{
        margin: 0;
        padding: 0;
            
        }

    body{   

    font-family: Arial, Helvetica, sans-serif;
    font-size: 12px;
    }
    header{
        width: 1117px;
        height: 792px;
        padding: 0;
        margin: 0x;
        background-color: rgb(255, 255, 255);
        background-image: url(./formatos/HISTORIA CLINICA.png);
        background-repeat: no-repeat;
    }
</style>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HISTORIA CLINICA</title>
</head>
<body>
    @foreach($pacientes as $paciente)
    @endforeach
    <header>
        <img src="{{url('/archivos_pacientes_ingreso'.'/'.$paciente->foto)}}" width="130px" height="139px" style="padding-top: 99px; padding-left: 43px; position: absolute;">
        <p style="font-weight: bold; padding-top: 105px;  padding-left: 350px; position: absolute;">{{$paciente->nombre}} {{$paciente->apellido_pat}} {{$paciente->apellido_mat}}</p>
        <p style="font-weight: bold; padding-top: 143px;  padding-left: 330px; position: absolute;">{{$paciente->fecha_ingreso}}</p>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <table style="text-align: center; padding-left: 45px; " >
            <tr>
                <th style="width: 250px; " ></th>
                <th style="width: 252px; " ></th>
                <th style="width: 255px; " ></th>
                <th style="width: 254px; " ></th>
            </tr>
            @foreach($pacientes_asignaciones as $paciente_asi)
            <tr>
                <td>
                    @foreach($areas as $area)
                    @if($area->Especialidad==$paciente_asi->id_especialidad)
                    {{$area->Area}}
                    @endif
                    @endforeach
                </td>
                <td>
                    @foreach($especialidades as $especialidad)
                    @if($especialidad->id==$paciente_asi->id_especialidad)
                    {{$especialidad->Especialidad}}
                    @endif
                    @endforeach
                </td>
                <td>
                    @foreach($medicos as $medico)
                    @if($medico->id==$paciente_asi->id_medico)
                    {{$medico->nombre}} {{$medico->apellido_pat}} {{$medico->apellido_mat}}
                    @endif
                    @endforeach
                </td>
                <td>
                    @foreach($procedimientos as $procedimiento)
                    @if($procedimiento->id==$paciente_asi->id_procedimiento)
                    {{$procedimiento->Procedimiento}}
                    @endif
                    @endforeach
                </td>
            </tr>
            @endforeach
        </table>
    </header>
    
</body>
</html>