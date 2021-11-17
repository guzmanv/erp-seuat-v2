<?php
$valores = $_GET['data'];
$strValores = base64_decode($valores);
$arrValores = json_decode($strValores,true);
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
        h3{
            color:white;
            margin: 0px;
        }
        .invoice-box {
        max-width: 800px;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr td:nth-child(2) {
        text-align: left;
    }

    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }

    .invoice-box table tr.information table td {
        padding-bottom: 10px;
        font-size: 12px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 1px;
        font-size: 12px;
    }

    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
        font-size: 12px;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }


        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }

    /** RTL **/
    .rtl {
        direction: rtl;
    }

    .rtl table {
        text-align: right;
    }

    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    .footer {
   position: fixed;
   left: 0;
   bottom: 0;
   color: black;
   font-size: 10px;
   width: 100%;
    white-space: nowrap;
    text-overflow: ellipsis;
 overflow: hidden;;

}

    </style>
</head>
<body>

    <div class="cabecera">
        <div>
            <div class="row">
                <div class="logo col-2">
                    </div>
                <div class="col-10" style="text-align:center">
                    <p><b>SISTEMA EDUCATIVO UNIVERSITARIO AZTECA</b><br>
                        <small><b>INSTITUTO DE ESTUDIOS SUPERIORES "SOR JUANA INES DE LA CRUZ"</b></small><br>
                        <small>Incorporado a la Secretaria de Educacion Publica</small><br>
                        <small>CLAVE: 07PSU0018E</small><br>
                        <small>2a Norte Oriente N° 741, Tuxtla Gutierrez Chiapas</small>
                    </p>
                </div>
            </div>
        </div>
        <div></div>   
    </div><br><br><br><br>
    <div class="cabecera">
        <div>
            <div class="row">
                <div class="col-12">
                    <p>El (la) suscrito(a) <b>Jose Santiz Ruiz</b>, alumno(a) de la
                    licenciatura en Ingenieria en <b>Sistemas Computacionales</b>.
                    Me doy por enterado que a más tardar el día* 25 de Diciembre de 2021, debo
                    hacer la entrega de los documentos documentos: 
                    </p>
                </div>
            </div>
        </div>
        <div></div>   
    </div>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <b>Lista de documentos: </b>  <?php //echo($data['folio']); ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr> 
            <tr class="heading">
                <td class="col-2">#</td>
                <td class="col-8">Nombre del documento</td>
                <td class="col-2">Tipo</td>
            </tr>
            <?php
                $numeracion = 0;
                foreach ($arrValores as $key => $value) {
                    $numeracion += 1;
                    ?>
                        <tr class="details">
                            <td class="col-2"><b><?php echo $numeracion ?></b></td>
                            <td class="col-8"><?php echo($value['tipo_documento'])?></td>
                            <td class="col-2">Original</td>
                        </tr>
                    <?php
                }
            ?>    
        </table>
    </div><br><br>
    <div class="cabecera">
        <div>
            <div class="row">
                <div class="col-12">
                    <p>En caso de no entregar dicho documento en la fecha antes mencionada la Institución Educativa se
                    deslinda de toda responsabilidad, en caso de que surgiera alguna supervisión y no estuviese mi
                    documento bajo resguardo, y esto fuera causa de Baja en forma inmediata y definitiva sin
                    perjuicio para la Institución.
                    Así mismo en caso de que mi fecha de conclusión de los estudios resulta con invasión de ciclo
                    (máximo al 01 de Enero del 2021, la Institución me dará de baja definitiva del
                    sistema sin perjuicio alguno.
                    Me comprometo a entregar dicho DOCUMENTO a más tardar el día 31 de Diciembre del
                    2021. 
                    </p>
                </div>
            </div>
        </div>
        <div></div>   
    </div>
    <div style='text-align:center'>
        <h4>FIRMAS</h4>   
    </div>
    <div>
        <div class="col-6" style="text-align:center">
            <h4>Alumno</h4><br><br>
            <hr style="width:50%">
        </div>
        <div class="col-6" style="text-align:center">
            <h4>Director</h4><br><br>
            <hr style="width:50%">
        </div>
    </div>
    <div class="footer">
        <p>*el tiempo máximo de la entrega del documento lo define la institución de acuerdo a lo que marque
        la instancia educativa a la que estemos incorporados.</p>
    </div>
</html>