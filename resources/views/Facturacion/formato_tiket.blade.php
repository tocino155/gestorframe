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
        background-image: url(./formatos/FACTURA.png);
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
    <?php $suma=0; $total=0; $total2=0; $porcentaje=0;?>
    @foreach($pacientes as $paciente)
    @endforeach

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

    <p style="font-weight: bold; padding-top: 674px;  padding-left: 875px; position: absolute; font-size: 20px;">$ {{$total2}}</p>
    <header>
        <p style="font-weight: bold; padding-top: 120px;  padding-left: 790px; position: absolute;">{{$paciente->nombre}} {{$paciente->apellido_pat}} {{$paciente->apellido_mat}}</p>
        <p style="font-weight: bold; padding-top: 158px;  padding-left: 762px; position: absolute;">{{$paciente->fecha_ingreso}}</p>
        <p style="font-weight: bold; padding-top: 196px;  padding-left: 735px; position: absolute;">{{$paciente->fecha_salida}}</p>
        <p style="font-weight: bold; padding-top: 235px;  padding-left: 710px; position: absolute;">
        <?php echo substr($paciente->nombre,0,1).substr($paciente->apellido_pat,0,1).substr($paciente->apellido_mat,0,1)."-";  ?>
        {{$paciente->id}}</p>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <table style="text-align: center; margin-left: 45px; " >
            <tr>
                <th style="width: 745px; " ></th>
                <th style="width: 280px; " ></th>
            </tr>
            @foreach($pacientes_asignaciones as $paciente_asi)
            <tr>
                <td style="font-size: 13px;">
                    @foreach($procedimientos as $procedimiento)
                    @if($procedimiento->id==$paciente_asi->id_procedimiento)
                    {{$procedimiento->Procedimiento}}
                    @endif
                    @endforeach
                </td>
                <td style="font-size: 14px;">
                    @foreach($procedimientos as $procedimiento)
                    @if($procedimiento->id==$paciente_asi->id_procedimiento)
                    $ {{$procedimiento->Costo}}
                    @endif
                    @endforeach
                </td>
            </tr>
            @endforeach
            <br>
            <tr>
                <th style="width: 745px; " >ASEGURADORA</th>
                <th style="width: 280px; " >% DE DESCUENTO</th>
            </tr>
            @foreach($aseguradoras as $aseguradora)
            @if($aseguradora->id==$paciente->id_aseguradora)
            <tr>
                <td style="font-size: 13px;">{{$aseguradora->Aseguradora}}</td>
                <td style="font-size: 13px;">{{$aseguradora->Porcentaje}}% ----- $ {{$total}}</td>
            </tr>
            @endif
            @endforeach
        </table>
    </header>
    
</body>
</html>