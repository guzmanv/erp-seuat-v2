<?php
date_default_timezone_set('America/Mexico_City');

?>
<!-- <html>
<style>
    @page { margin: 168px 29px; }
    #header_pdf { position: fixed; left: 0px; top: -169px; right: 0px; height: 130px; text-align: center; font-size: 10px; }
    #footer_pdf { position: fixed; left: 0px; bottom: -169px; right: 0px; height: 50px; font-size:9px; }
    #footer_pdf .page:after { content: counter(page, upper-roman); }
background-image: url(<?php echo media() ?>/images/logo-seuat-contorno-ok.png);
background-repeat: no-repeat;
background-size:100%;
background-position: bottom left;
  .titulo{
    text-align: center;
    font-size:10px;
    font-weight: bold; /*300*/
    float: left;
    width: 100%;
    height: 25px;
    color: #01579b;
  }
  .titulo_plantel{
    text-align: center;
    font-size:16px;
    font-weight: bold; /*300*/
    float: left;
    width: 100%;
    height: 25px;
  }
  #contenedor_cabecera{
    width:100%;
    margin-top:27px; /*30px*/
    height: 90px;
  }
  .c_logo_left{
    width:15%;
    float: left;
    height: 90px;
    text-align: left;
  }
  .c_logo_right{
    width: 20%;
    float: left;
    height:90px;
    text-align: right;
  }
  .c_encabezado{
    width:65%;
    float: left;
    height: 90px;
  }
  #contenedor_firmas{
    vertical-align: bottom;
    position:absolute;
    bottom:0;
    left:0;
    margin-bottom: 70px;
    min-height: 70px;
    width:100%;
    text-align: center;
  }
  .linea-titulo{
    width: 75px;
    height:2px;
    margin:2px auto 0px;
  .c_logo_right{
    width: 20%;
    float: left;
    height:90px;
    text-align: right;
  }
    background-color: #A4A4A4;
  }
  #content_pdf{
    font-size: 11px;
    width: 100%;
    margin-top: 12px;

  }
#fila-normal{
  background-color: #eae9e9;
  width:759px; height: 21px; margin-top:7px;
}
.subfila{
  width: 759px;
  display: inline-block;
}

.borde-tabla{
 border-bottom: 1px dashed #ccc;
 padding-bottom:5px;
}
.borde-tabla-dos{
 border-bottom: 1px dashed #fff;
 padding-bottom:5px;
}

table {border-collapse:collapse}

/*borde simple*/
table.borde_simple>thead>tr>th{border:1px solid #9e9e9e;border-radius:0;padding:4px 5px;display:table-cell;text-align:left;vertical-align:middle;border-radius:2px;font-size: 10px;background-color:#eae9e9}
table.borde_simple>thead>tr>td{border:1px solid #9e9e9e;border-radius:0;padding:4px 5px;display:table-cell;text-align:left;vertical-align:middle;border-radius:2px;font-size: 10px}
table.borde_simple>tbody>tr>td{border:1px solid #9e9e9e;border-radius:0;padding:4px 5px;display:table-cell;text-align:left;vertical-align:middle;border-radius:2px;font-size: 10px}
table.borde_simple>tbody>tr>th{border:1px solid #9e9e9e;border-radius:0;padding:4px 5px;display:table-cell;text-align:left;vertical-align:middle;border-radius:2px;font-size: 10px}
table.borde_simple>tfoot>tr>th{border:1px solid #9e9e9e;border-radius:0;padding:4px 5px;display:table-cell;text-align:left;vertical-align:middle;border-radius:2px;font-size: 10px}
table.borde_simple>tfoot>tr>td{border:1px solid #9e9e9e;border-radius:0;padding:4px 5px;display:table-cell;text-align:left;vertical-align:middle;border-radius:2px;font-size: 10px}

/*Sin borde*/
table.sin_borde{border:0px solid #ffffff; width: 100%;}

.invoice-box {
    max-width: 800px;
    margin: auto;
    border: 1px solid #eee;
    box-shadow: 0 0 10px rgba(0, 0, 0, .15);
    font-size: 10px;
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
    text-align: right;
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
    font-size: 14px;
    text_align: center;
}
.invoice-box table tr.heading td {
    background: #eee;
    border-bottom: 1px solid #ddd;
    font-weight: bold;
}
.invoice-box table tr.details td {
    padding-bottom: 1px;
    font-size: 8px;
}
.invoice-box table tr.item td{
    border-bottom: 1px solid #eee;
    font-size: 8px;
}
.invoice-box table tr.item.last td {
    border-bottom: none;
}
.invoice-box table tr.total td:nth-child(2) {
    border-top: 2px solid #eee;
    font-weight: bold;
}
.invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
}
@media only screen and (max-width: 600px) {
    .invoice-box table tr.top table td {
        width: 100%;
        display: block;
        text-align: center;
    }
    .invoice-box table tr.information table td {
        width: 100%;
        display: block;
        text-align: center;
    }
}
</style>
<div id="header_pdf">
    <div id="contenedor_cabecera">
        <div class="c_logo_left">
          <img src="<?php echo(media().'/images/logo_iessic.jpg') ?>" alt="logo SEUAT" height="76" width="76">
        </div>
        <div class="c_encabezado">
            <table class="sin_borde">
                <tr>
                    <th colspan="5" style="font-size:18px;font-weight: bold; text-align: left;"><?php echo(strtoupper('Titulo')) ?></th>
                </tr>
                <tr>
                    <th colspan="5" style="font-size:12px;font-weight: bold; text-align: left;"><?php  echo(strtoupper('Subtitulo')) ?><br><br></th>
                </tr>
                <tr>
                    <td colspan="5" style="padding-top: -15px; font-size: 8px; text-align: left;">
                        <?php echo('Tuxtla') ?><br>
                        CLAVE: <?php echo('01003030')?><br>
                        <?php echo('Calle central')?>.
                        <br><br>
                    </td>
                </tr>
                <tr>
                    <th colspan="5"></th>
                </tr>
            </table>
        </div>
        <div class="c_logo_right">
            <table class="sin_borde">
                <tr style="background-color:#F2F2F2; ">
                    <th colspan="5" style="font-size:16px;font-weight: bold; text-align: right; vertical-align:middle; padding: 15px 7px 15px 5px">Fecha de Emision<br>Plantel Emision<br>Periodo comprendido entre el ___al ___ del ___</th>
                </tr>
            </table>
        </div>
    </div>
    <div id="footer_pdf">
        <p>
            <small><br><i> Documento Impreso el <?php echo DATE('d-m-Y H:i:s') ?> por Jose Santiz Ruiz</i></small>
        </p>
    </div>
    <div id="content_pdf">
        <div class="invoice-box"> 
            <table cellpadding="0" cellspacing="0">
                <tr class="information">
                    <td colspan="10">
                        <table>
                            <tr>
                                <td>
                                    <b>COLEGIATURAS</b>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="heading">
                    <td>FECHA</td>
                    <td>CANTIDAD</td>
                    <td>CODIGO SERVICIO</td>
                    <td>CONCEPTO</td>
                    <td>CARGO</td>
                    <td>RECARGO</td>
                    <td>ABONO</td>
                    <td>SALDO</td>
                </tr>
                <tr class="details">
                    <td><b>08/ENE/22</b></td>
                    <td><b>08/ENE/22</b></td>
                    <td><b>08/ENE/22</b></td>
                    <td><b>08/ENE/22</b></td>
                    <td><b>08/ENE/22</b></td>
                    <td><b>08/ENE/22</b></td>
                    <td><b>08/ENE/22</b></td>
                    <td><b>08/ENE/22</b></td>
                </tr>
                <tr class="details">
                    <td><b>08/ENE/22</b></td>
                    <td><b>08/ENE/22</b></td>
                    <td><b>08/ENE/22</b></td>
                    <td><b>08/ENE/22</b></td>
                    <td><b>08/ENE/22</b></td>
                    <td><b>08/ENE/22</b></td>
                    <td><b>08/ENE/22</b></td>
                    <td><b>08/ENE/22</b></td>
                </tr>
                <tr class="details">
                    <td><b>08/ENE/22</b></td>
                    <td><b>08/ENE/22</b></td>
                    <td><b>08/ENE/22</b></td>
                    <td><b>08/ENE/22</b></td>
                    <td><b>08/ENE/22</b></td>
                    <td><b>08/ENE/22</b></td>
                    <td><b>08/ENE/22</b></td>
                    <td><b>08/ENE/22</b></td>
                </tr>
                <tr class="details">
                    <td><b>08/ENE/22</b></td>
                    <td><b>08/ENE/22</b></td>
                    <td><b>08/ENE/22</b></td>
                    <td><b>08/ENE/22</b></td>
                    <td><b>08/ENE/22</b></td>
                    <td><b>08/ENE/22</b></td>
                    <td><b>08/ENE/22</b></td>
                    <td><b>08/ENE/22</b></td>
                </tr>
                <tr class="total">
                    <td></td>
                    <td>
                    Total: $155.00
                    </td>
            </tr>
            </table>
        </div>
        <!-- <div style="width:759px; font-size:16px; font-weight: bold; letter-spacing: 0.2em; text-align: center; "> Estado de cuenta del 07/12/2022</div>
        <div class="linea-titulo" style="margin-bottom:20px; "></div>
        <div style="width:759px; text-align:left; ">El (la) suscrito ingresa como alumno(a) de esta Institución Educativa, para cursar los estudios en:</div>
        <div style="width:753px; height: 12px; border-bottom: solid 1px #848484; padding: 5px 2px 4px 4px; text-align: center; background-color: #eae9e9; margin-top:7px; "><?php echo(strtoupper('Ingenieria en Sistemas Computacionales'))?></div>
        <div id="fila-normal" >
            <div class="subfila" style="width: 26px; height: 12px; float:left; background-color: #ffffff; padding: 7px 2px 2px 0px;">Plan:</div>
            <div class="subfila" style="width:262px; height: 12px; float:left; background-color: #eae9e9; padding: 5px 2px 4px 4px; text-align: left; "><?php echo(strtoupper('Semestral')) ?></div>
            <div class="subfila" style="width: 47px; height: 21px; float:left; background-color: #ffffff; padding: 7px 2px 2px 0px; text-align: right; ">Horario:</div>
            <div class="subfila" style="width:408px; height: 12px; float:left; background-color: #eae9e9; padding: 5px 2px 2px 4px; text-align: left; "> de <?php echo('07:00 am') ?> a <?php echo('20:00 pm') ?></div>
        </div>
        <div id="fila-normal">
            <div class="subfila" style="width: 78px; height: 12px; background-color: #ffffff; padding: 7px 2px 2px 0px; text-align: left; ">Fecha de inicio:</div>
            <div class="subfila" style="width:383px; height: 12px; background-color: #eae9e9; padding: 5px 2px 4px 4px; text-align: left; ">Pendiente</div>
            <div class="subfila" style="width: 63px; height: 21px; background-color: #fff; padding: 7px 2px 2px 0px; text-align: right; ">Duración:</div>
            <div class="subfila" style="width:219px; height: 12px; padding: 5px 2px 4px 4px; text-align: left; "><?php echo(strtoupper('2 años'))?></div>
        </div>
        <div style="width:759px; font-size: 13px; letter-spacing: 0.2em; text-align: center; margin: 30px 0px 7px 0px; ">DATOS DEL SOLICITANTE</div>

        <div style="width:759px; background-color: #eae9e9; margin-top:7px; ">
            <div class="subfila" style="width:246px; height: 12px; padding: 5px 0px 4px 0px; float-left; text-align: center;"><?php echo(strtoupper('Jose'))?></div>
            <div class="subfila" style="width:246px; height: 12px; padding: 5px 0px 4px 0px; float-left; text-align: center;"><?php echo(strtoupper('Santiz'))?></div>
            <div class="subfila" style="width:236px; height: 12px; padding: 5px 0px 4px 0px; float-left; text-align: center;"><?php echo(strtoupper('Ruiz')) ?></div>
        </div>

        <div style="width:759px; border-top: solid 1px #848484;">
            <div class="subfila" style="width:246px; font-size:8px; text-align: center; ">APELLIDO PATERNO</div>
            <div class="subfila" style="width:246px; font-size:8px; text-align: center; " >APELLIDO MATERNO</div>
            <div class="subfila" style="width:236px; font-size:8px; text-align: center; ">NOMBRE(S)</div>
        </div>

        <div style="width: 759px; background-color: #eae9e9; margin-top:7px; ">
            <div class="subfila" style="width: 759px; height: 12px; padding: 5px 0px 4px 0px; float-left; text-align: center;"><?php echo(strtoupper('Calle candoquis 209')) ?></div>
        </div>

        <div style="width:759px; border-top: solid 1px #848484;">
            <div class="subfila" style="width:759px; font-size:8px; text-align: center; ">CALLE Y NUMERO</div>
        </div>

        <div style="width:759px; background-color: #eae9e9; margin-top:7px; ">
            <div class="subfila" style="width:259px; height: 12px; padding: 5px 0px 4px 0px; text-align: center; float-left; "><?php echo(strtoupper('El bosquiueeueieiie')) ?></div>
            <div class="subfila" style="width:320px; height: 12px; padding: 5px 0px 4px 0px; text-align: center; float-left; text-transform: uppercase;"><?php echo(strtoupper('Tuxtla Gtrz'))?></div>
            <div class="subfila" style="width:164px; height: 12px; padding: 5px 0px 4px 0px; text-align: center; float-left; text-transform: uppercase;"><?php echo(strtoupper('Chiapas'))?></div>
        </div>

        <div style="width:759px; border-top: solid 1px #848484;">
            <div class="subfila" style="width:259px; font-size:8px; text-align: center; " >COLONIA</div>
            <div class="subfila" style="width:320px; font-size:8px; text-align: center; ">CIUDAD</div>
            <div class="subfila" style="width:164px; font-size:8px; text-align: center; ">ESTADO</div>
        </div>

        <div style="width:759px; background-color: #eae9e9; margin-top:7px; ">
            <div class="subfila" style="width:249px; height: 12px; padding: 5px 0px 4px 0px; float-left; text-align: center;"><?php echo('9612168345') ?></div>
            <div class="subfila" style="width:249px; height: 12px; padding: 5px 0px 4px 0px; float-left; text-align: center;"><?php echo('9612168345') ?></div>
            <div class="subfila" style="width:242px; height: 12px; padding: 5px 0px 4px 0px; float-left; text-align: center;  text-transform: uppercase; "><?php echo(strtoupper('jose@gmail.com'))?></div>
        </div>

        <div style="width:759px; border-top: solid 1px #848484;">
            <div class="subfila" style="width:249px; font-size:8px; text-align: center; ">CELULAR</div>
            <div class="subfila" style="width:249px; font-size:8px; text-align: center; " >TELÉFONO FIJO</div>
            <div class="subfila" style="width:242px; font-size:8px; text-align: center; ">CORREO ELECTRÓNICO</div>
        </div>

        <div style="width:759px; background-color: #eae9e9; margin-top:7px; ">
            <div class="subfila" style="width:308px; height: 12px; padding: 5px 0px 4px 0px; text-align: center; float-left; "><?php echo('Secundarias')?></div>
            <div class="subfila" style="width:444px; height: 12px; padding: 5px 0px 4px 0px; text-align: center; float-left; "><?php echo('SEUAT')?></div>
        </div>

        <div style="width:759px; border-top: solid 1px #848484;">
            <div class="subfila" style="width:308px; font-size:8px; text-align: center; " >NIVEL DE ESTUDIOS REALIZADOS</div>
            <div class="subfila" style="width:444px; font-size:8px; text-align: center; ">EMPRESA DONDE TRABAJA</div>
        </div>

        <div style="width:759px; font-size: 13px; letter-spacing: 0.2em; text-align: center; margin: 30px 0px 7px 0px; ">DATOS DEL PADRE O TUTOR</div>

        <div style="width:759px; background-color: #eae9e9; margin-top:7px; ">
            <div class="subfila" style="width:249px; height: 12px; padding: 5px 0px 4px 0px; float-left; text-align: center;"><?php echo(strtoupper('Marciano'))?></div>
            <div class="subfila" style="width:249px; height: 12px; padding: 5px 0px 4px 0px; float-left; text-align: center;"><?php echo(strtoupper('Extra'))?> </div>
            <div class="subfila" style="width:232px; height: 12px; padding: 5px 0px 4px 0px; float-left; text-align: center;"><?php echo(strtoupper('Super'))?></div>
        </div>

        <div style="width:759px; border-top: solid 1px #848484;">
            <div class="subfila" style="width:249px; font-size:8px; text-align: center; ">APELLIDO PATERNO</div>
            <div class="subfila" style="width:249px; font-size:8px; text-align: center; " >APELLIDO MATERNO</div>
            <div class="subfila" style="width:232px; font-size:8px; text-align: center; ">NOMBRE(S)</div>
        </div>  

        <div style="width:759px; background-color: #eae9e9; margin-top:7px; ">
            <div class="subfila" style="width:249px; height: 12px; padding: 5px 0px 4px 0px; float-left; text-align: center;"><?php echo('9612168345') ?></div>
            <div class="subfila" style="width:249px; height: 12px; padding: 5px 0px 4px 0px; float-left; text-align: center;"><?php echo('961216834')?></div>
            <div class="subfila" style="width:232px; height: 12px; padding: 5px 0px 4px 0px; float-left; text-align: center;  text-transform: uppercase; "><?php echo(strtoupper('email'))?></div>
        </div>

        <div style="width:759px; border-top: solid 1px #848484;">
            <div class="subfila" style="width:249px; font-size:8px; text-align: center; ">CELULAR</div>
            <div class="subfila" style="width:249px; font-size:8px; text-align: center; " >TELÉFONO DE OFICINA</div>
            <div class="subfila" style="width:232px; font-size:8px; text-align: center; ">CORREO ELECTRÓNICO</div>
        </div>
        <table class="tg" style="undefined;table-layout: fixed; width: 759px; margin-top: 25px;">
            <colgroup>
                <col style="width: 72px">
                <col style="width: 54px">
            </colgroup>
            <tr>
                <th valign="top" rowspan="2">
                    <table class="" width="100%" height="50" style="font-size: 12px; font-weight: normal; line-height:17px; background-color: #eae9e9; padding:0 7px;">
                        <tr>
                            <th class="" colspan="3" style="padding-top: 5px;">DOCUMENTACIÓN<br><br></th>
                        </tr>
                        <tr style="text-align:center; font-size: 10px;">
                            <td class="">Documento</td>
                            <td class="" width="1">Original</td>
                            <td class="" width="1">Copia</td>
                            <td class="" width="1">Pendiente</td>
                        </tr>
                       
                    </table>
                </th>
                <th valign="top">
                    <div style="background-color: #E6E6E6; text-align: center; font-size: 14px; font-weight: bold; letter-spacing: 0.2em; padding: 5px 5px 15px 5px; margin: 0 0 0 10px; ">COMPROMISO</div>
                    <div style="background-color: #E6E6E6; text-align: justify; font-size: 11px; font-weight: normal; padding: 0 5px 10px 5px; margin: 0 0 0 10px; ">
                    Me comprometo a entregar los documentos faltantes de mi inscripción antes del:<br><br>
                    ______________________________________ del año:_____________<br><br>
                    En caso contrario estoy consciente de que automáticamente se cancelará mi inscripción y no pondré objeción alguna, ya que lo anterior es requisito
                    indispensable para presentar mi alta ante la secretaría de educación, por lo tanto firmo de conformidad y bajo protesta de decir la verdad.<br><br><br>
                        <div Style="font-size: 8px; text-align: center; ">
                        _____________________________________________________________<br>
                        NOMBRE Y FIRMA
                        </div>
                    </div>
                    <div Style="background-color: #fff; font-size: 9px; font-weight: normal; text-align: center; padding: 0 5px 0px 5px; margin: 5px 0 0 10px;">
                    Estamos comprometidos con usted por el buen uso y manejo que daremos a sus datos personales, por eso el SISTEMA EDUCATIVO UNIVERSITARIO AZTECA S. C.
                    con domicilio en avenida 2da. norte oriente No. 741, Centro, Tuxtla Gutiérrez, Chiapas. C.P. 29000 con Tel. 61 22329 y 61 3792 pone a su disposición su
                    AVISO DE PRIVACIDAD. Para conocerlo visite nuestra página www.seuat.mx
                    </div>
                </th>
            </tr>
        </table> -->
    </div>
</div>
</html>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <body data-temp="<?php echo $data['folio_xml'] ?>">
    <title>Constancia de titulación</title>
    <style type="text/css">
        body {
             #background-image: url(<?php echo $url_image;  ?>);
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
        .cabecera{
            background-color: #222e3c;
        }
        h3{
            color:white;
            margin: 0px;
        }
        .invoice-box {
        max-width: 800px;
        margin: auto;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 10px;
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
        text-align: right;
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
        font-size: 14px;
        text_align: center;
    }
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 1px;
        font-size: 8px;
    }

    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
        font-size: 8px;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }

        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    .rtl {
        direction: rtl;
    }    /** RTL **/

    .rtl table {
        text-align: right;
    }

    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="information">
                <td colspan="10">
                    <table>
                        <tr>
                            <td>
                                <b>SERVICIOS</b>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>FECHA</td>
                <td>CANTIDAD</td>
                <td>CODIGO SERVICIO</td>
                <td>CONCEPTO</td>
                <td>CARGO</td>
                <td>RECARGO</td>
                <td>ABONO</td>
                <td>SALDO</td>
            </tr>
            <tr class="details">
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
            </tr>
            <tr class="details">
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
            </tr>
            <tr class="details">
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
            </tr>
            <tr class="details">
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
            </tr>
        </table>
        <table cellpadding="0" cellspacing="0">
            <tr class="information">
                <td colspan="10">
                    <table>
                        <tr>
                            <td>
                                <b>COLEGIATURAS</b>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>FECHA</td>
                <td>CANTIDAD</td>
                <td>CODIGO SERVICIO</td>
                <td>CONCEPTO</td>
                <td>CARGO</td>
                <td>RECARGO</td>
                <td>ABONO</td>
                <td>SALDO</td>
            </tr>
            <tr class="details">
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
            </tr>
            <tr class="details">
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
            </tr>
            <tr class="details">
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
            </tr>
            <tr class="details">
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
                <td><b>08/ENE/22</b></td>
            </tr>
        </table>
    </div>
    
</html> -->

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>A simple, clean, and responsive HTML invoice template</title>

    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
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
        text-align: right;
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
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(8) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
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
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .rtl table {
        text-align: right;
    }

    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>SERVICIOS</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>
                    Fecha
                </td>
                <td>
                    Cantidad
                </td>
                <td>
                    Codigo servicio
                </td>
                <td>
                    Concepto
                </td>
                <td>
                    Cargo
                </td>
                <td>
                    Recargo
                </td>
                <td>
                    Abono
                </td>
                <td>
                    Saldo
                </td>
            </tr>
            <tr class="item">
                <td>
                    2022-12-12
                </td>
                <td>
                    1
                </td>
                <td>
                    CP
                </td>
                <td>
                    Colegiatura
                </td>
                <td>
                    0.00
                </td>
                <td>
                    0.00
                </td>
                <td>
                    100.00
                </td>
                <td>
                    100.00
                </td>
            </tr>

            <tr class="item">
                <td>
                    2022-12-12
                </td>
                <td>
                    1
                </td>
                <td>
                    CP
                </td>
                <td>
                    Colegiatura
                </td>
                <td>
                    0.00
                </td>
                <td>
                    0.00
                </td>
                <td>
                    100.00
                </td>
                <td>
                    100.00
                </td>
            </tr>

            <tr class="item last">
                <td>
                    2022-12-12
                </td>
                <td>
                    1
                </td>
                <td>
                    CP
                </td>
                <td>
                    Colegiatura
                </td>
                <td>
                    0.00
                </td>
                <td>
                    0.00
                </td>
                <td>
                    100.00
                </td>
                <td>
                    100.00
                </td>
            </tr>

            <tr class="total">
                <td></td>

                <td>
                   Total: $385.00
                </td>
            </tr>
        </table><br>
        <table cellpadding="0" cellspacing="0">
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>COLEGIATURAS</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>
                    Item
                </td>

                <td>
                    Price
                </td>
            </tr>

            <tr class="item">
                <td>
                    Website design
                </td>

                <td>
                    $300.00
                </td>
            </tr>

            <tr class="item">
                <td>
                    Hosting (3 months)
                </td>

                <td>
                    $75.00
                </td>
            </tr>

            <tr class="item last">
                <td>
                    Domain name (1 year)
                </td>

                <td>
                    $10.00
                </td>
            </tr>

            <tr class="total">
                <td></td>

                <td>
                   Total: $385.00
                </td>
            </tr>
        </table>
    </div>
</body>
</html>