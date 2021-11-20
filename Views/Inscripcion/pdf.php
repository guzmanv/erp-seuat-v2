<?php
setlocale(LC_ALL,"es_ES");
date_default_timezone_set('UTC');
/* $userAtencion = $data['data'][0]['nombre_usuario'];
$userAlumno = $data['data'][0]['nombre_alumno'];
$fechaEntrega = $data['data'][0]['fecha_estimada_devolucion'];
$formatFechaEntrega = iconv('ISO-8859-2', 'UTF-8', strftime("%A, %d de %B de %Y", strtotime($fechaEntrega)));
$formatFechaActual = iconv('ISO-8859-2', 'UTF-8', strftime("%A, %d de %B de %Y", strtotime(date('Y-m-d'))));
$nombreCarrera = $data['data'][0]['nombre_carrera']; */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hitorial documentacion</title>
    <style type="text/css">
        body {
            background-size:100%;
            background-repeat: no-repeat;
            font-family: "Source Sans Pro",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
        }
        .col-8 {
            float: left;
            width: 66.67%;
            padding: 0px;
        }
        .col-6 {
            float: left;
            width: 50%;
            padding: 0px;
        }
        .col-4 {
            float: left;
            width: 33.33%;
            padding: 0px;
        }
        .col-3 {
            float: left;
            width: 25%;
            padding: 0px;
        }
        .col-2 {
            float: left;
            width: 16.667%;
            padding: 0px;
        }
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>
<body>
    <div class="cabecera">
        <div>
            <div class="row">
                <div class="col-2">
                    <img src="<?php //echo(media().'/images/Logo_seuat_color.jpeg') ?>" height="80" width="80">
                    <img src="<?php echo(media().'/images/logo_iessic.jpg') ?>" height="80" width="80">
                </div>
                <div class="col-8" style="text-align:center">
                    <p><b>SISTEMA EDUCATIVO UNIVERSITARIO AZTECA</b><br>
                        <small style="font-size: 13px"><b>INSTITUTO DE ESTUDIOS SUPERIORES "SOR JUANA INES DE LA CRUZ"</b></small><br>
                        <small>Incorporado a la Secretaria de Educacion Publica</small><br>
                        <small>CLAVE: 07PSU0018E</small><br>
                        <small>2a Norte Oriente N° 741, Tuxtla Gutierrez Chiapas</small>
                    </p>
                </div>
                <div class="col-2" style="text-align:center">
                    <img src="<?php //echo(media().'/images/logo_iessic.jpg') ?>" height="80" width="80">
                    <p>Folio<br><b><?php echo($data['datos']['folio_impreso']) ?></b></p>
                </div>
            </div>
        </div>
        <div></div>   
    </div>
    <div style="text-align:center">
        <h4>SOLICITUD DE INSCRIPCION<br><hr style="width:10%">
        </h4>
    </div>
    <div class="cabecera">
        <div>
            <div class="row">
                <div style="text-align:left">
                    <p>El (la) suscrito ingresa como alumno(a) de esta institución Educativa, para cursar los
                        estudios en:
                    </p>
                </div>
                <div>
                    <p style="text-align:center;border-bottom:1px solid black;width:100%;display:block;"><span><?php echo(strtoupper($data['datos']['nombre_carrera'])) ?></span></p>
                </div>
                <div class="row">
                    <p><span class="col-6">Plan: <?php echo(strtoupper($data['datos']['nombre_plan'])) ?></span><span class="col-6">Horario: de 08:00:00 a 16:00:00</span></p>
                </div>
                <div class="row">
                    <p><span class="col-6">Fecha Inicio: 07-9-2021</span><span class="col-6" style="text-align:center">Duracion: <?php echo($data['datos']['duracion_carrera'])?></span></p>
                </div>
                <div class="row">
                    <p>Por presentar equivalentes se integra al:</p>
                </div>
            </div>
        </div>  
    </div>
    <div>
        <div>
            <div style="width:100%">
                <div style="text-align:center">
                    <p>DATOS DEL SOLICITANTE</p>
                </div>
                <p style="border-bottom:1px solid;width:100%;display:block">
                    <span class="col-4" style="text-align:center;display:block"><?php echo($data['datos']['nombre_persona']) ?></span>
                    <span class="col-4" style="text-align:center;display:block"><?php echo($data['datos']['ap_paterno']) ?></span>
                    <span class="col-3" style="text-align:center;display:block"><?php echo($data['datos']['ap_materno']) ?></span>
                </p>
            </div>
        </div>  
    </div>
    <div>
    <div>
        <p style="text-align:center"><?php echo($data['datos']['direccion']); ?></p>
    </div>
    <div>
        <div class="col-4" style="text-align:center"><p><?php echo($data['datos']['localidad']) ?></p></div>
        <div class="col-4" style="text-align:center"><p><?php echo($data['datos']['municipio']) ?></p></div>
        <div class="col-4" style="text-align:center"><p><?php echo($data['datos']['estado']) ?></p></div>
    </div>
    <div class="cabecera">
        <div>
            <div style="width:100%">
                <div class="col-12" style="text-align:center">
                    <p>DATOS DEL PADRE O TUTOR</p>
                </div>
            </div>
        </div>  
    </div>
    <div>
        <div class="col-4" style="text-align:center"><p><?php echo($data['datos']['nombre_tutor']) ?></p></div>
        <div class="col-4" style="text-align:center"><p><?php echo($data['datos']['appat_tutor']) ?></p></div>
        <div class="col-4" style="text-align:center"><p><?php echo($data['datos']['apmat_tutor']) ?></p></div>
    </div><br>
    <div class="footer">
        <p>* El tiempo máximo de la entrega del documento lo define la institución de acuerdo a lo que marque
        la instancia educativa a la que estemos incorporados.</p>
    </div>
</html>