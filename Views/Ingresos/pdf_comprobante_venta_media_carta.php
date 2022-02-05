<?php
date_default_timezone_set('America/Mexico_City');

?>
<html>
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
    width: 35%;
    float: left;
    height:90px;
    text-align: right;
  }
  .c_encabezado{
    width:50%;
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
</style>
<div id="header_pdf">

    <!--Encabezado -->
    <div id="contenedor_cabecera">
        <div class="c_logo_left">
          <img src="<?php echo(media().'/images/logo_iessic.jpg') ?>" alt="logo SEUAT" height="76" width="76">
        </div>
        <div class="c_encabezado">
            <table class="sin_borde">
                <tr>
                    <th colspan="5" style="font-size:12px;font-weight: bold; text-align: left;">SISTEMA EDUCATIVO UNIVERSITARIO AZTECA TUXTLA S.C.</th>
                </tr>
                <tr>
                    <th colspan="5" style="font-size:12px;font-weight: bold; text-align: left;">R.F.C.: SEU020319FL8</th>
                </tr>
                <tr>
                    <th colspan="5" style="font-size:12px;font-weight:normal;text-align: left;">AVENIDA 2a NORTE No 741 ENTRE 6a Y 7a ORIENTE</th>
                </tr>
                <tr>
                    <th colspan="5" style="font-size:12px;font-weight:norml; text-align: left;">COL. CENTRO C.P. 29000 TUXTLA GUTIERREZ, CHIAPAS</th>
                </tr>
            </table>
        </div>
        <div class="c_logo_right">
            <table class="sin_borde">
                <tr><th><th><th></tr>
                <tr>
                    <th colspan="1" style="font-size:12px;font-weight: bold; text-align: left;">TAPILULA</th>
                    <th colspan="2" style="font-size:12px;font-weight: normal; text-align: left;">FOLIO: TAPI</th>
                </tr>
                <tr>
                    <th colspan="3" style="font-size:12px;font-weight: normal; text-align: left;">CARRETERA FEDERAL, TAPILULA - PICHUCALCO. KILOMETRO 1,</th>
                </tr>
                <tr>
                    <th colspan="3" style="font-size:12px;font-weight:normal; text-align: left;">BARRIO GUADALUPE, TAPILULA, CHIAPAS, CP: 29730</th>
                </tr>
            </table>
        </div>
    </div>
    
    <div id="content_pdf">
        <div style="width:759px; font-size:16px; font-weight: bold; letter-spacing: 0.2em; text-align: center;background-color: #eae9e9; "> RECIBO DE INSCRIPCION</div>

        <br>
        <div id="fila-normal" >
            <div class="subfila" style="width: 156px; height: 12px; float:left; background-color: #ffffff; padding: 7px 2px 2px 0px;text-align:left">RECIBÍ DEL (A) ALUMNO (A):</div>
            <div class="subfila" style="width:262px; height: 12px; float:left; background-color: #eae9e9; padding: 5px 2px 4px 4px; text-align: left; "></div>
        </div>
        <div id="fila-normal" >
            <div class="subfila" style="width: 96px; height: 12px; float:left; background-color: #ffffff; padding: 7px 2px 2px 0px;text-align:left">PARA ESTUDIAR</div>
            <div class="subfila" style="width:262px; height: 12px; float:left; background-color: #eae9e9; padding: 5px 2px 4px 4px; text-align: left; "></div>
        </div>
        <div id="fila-normal">
            <div class="subfila" style="width: 180px; height: 12px; background-color: #ffffff; padding: 7px 2px 2px 0px; text-align: left; ">POR CONCEPTO DE: <b>INSCRIPCION</b></div>
            <div class="subfila" style="width: 70px; height: 12px; background-color: #eae9e9; padding: 5px 2px 4px 4px; text-align: left; "></div>
            <div class="subfila" style="width: 100px; height: 12px; background-color: #ffffff; padding: 7px 2px 2px 0px; text-align: left; "><b>COLEGIATURA $</b></div>
            <div class="subfila" style="width: 70px; height: 12px; background-color: #eae9e9; padding: 5px 2px 4px 4px; text-align: left; "></div>
            <div class="subfila" style="width: 50px; height: 12px; background-color: #ffffff; padding: 7px 2px 2px 0px; text-align: left; "><b>OTROS</b></div>
            <div class="subfila" style="width: 70px; height: 12px; background-color: #eae9e9; padding: 5px 2px 4px 4px; text-align: left; "></div>
            <div class="subfila" style="width: 70px; height: 12px; background-color: #eae9e9; padding: 5px 2px 4px 4px; text-align: left; "><b>$</b></div>
        </div>
        <br><br><br><br>
        <?php //if($data['datos']['grado'] != 1){?>
            <div id="fila-normal">
                <div class="subfila" style="width:246px; height: 12px; float:left; background-color: #ffffff; padding: 7px 2px 2px 0px; text-align: left; ">Por presentar estudios equivalentes se integra a:</div>
                <div class="subfila" style="width:505px; height: 12px; float:left; background-color: #eae9e9; padding: 5px 2px 4px 4px; text-align: left; "><?php //echo(strtoupper($data['datos']['grado']))?> cuatrimestre</div>
            </div>
        <?php// } ?>
        <div style="width:759px; font-size: 13px; letter-spacing: 0.2em; text-align: center; margin: 30px 0px 7px 0px; ">DATOS DEL SOLICITANTE</div>

        <div style="width:759px; background-color: #eae9e9; margin-top:7px; ">
            <div class="subfila" style="width:246px; height: 12px; padding: 5px 0px 4px 0px; float-left; text-align: center;"><?php //echo(strtoupper($data['datos']['nombre_persona']))?></div>
            <div class="subfila" style="width:246px; height: 12px; padding: 5px 0px 4px 0px; float-left; text-align: center;"><?php //echo(strtoupper($data['datos']['ap_paterno']))?></div>
            <div class="subfila" style="width:236px; height: 12px; padding: 5px 0px 4px 0px; float-left; text-align: center;"><?php //echo(strtoupper($data['datos']['ap_materno'])) ?></div>
        </div>

        <div style="width:759px; border-top: solid 1px #848484;">
            <div class="subfila" style="width:246px; font-size:8px; text-align: center; ">APELLIDO PATERNO</div>
            <div class="subfila" style="width:246px; font-size:8px; text-align: center; " >APELLIDO MATERNO</div>
            <div class="subfila" style="width:236px; font-size:8px; text-align: center; ">NOMBRE(S)</div>
        </div>

        <div style="width: 759px; background-color: #eae9e9; margin-top:7px; ">
            <div class="subfila" style="width: 759px; height: 12px; padding: 5px 0px 4px 0px; float-left; text-align: center;"><?php //echo(strtoupper($data['datos']['direccion'])) ?></div>
        </div>

        <div style="width:759px; border-top: solid 1px #848484;">
            <div class="subfila" style="width:759px; font-size:8px; text-align: center; ">CALLE Y NUMERO</div>
        </div>

        <div style="width:759px; background-color: #eae9e9; margin-top:7px; ">
            <div class="subfila" style="width:259px; height: 12px; padding: 5px 0px 4px 0px; text-align: center; float-left; "><?php //echo(strtoupper($data['datos']['colonia'])) ?></div>
            <div class="subfila" style="width:320px; height: 12px; padding: 5px 0px 4px 0px; text-align: center; float-left; text-transform: uppercase;"><?php //echo(strtoupper($data['datos']['municipio']))?></div>
            <div class="subfila" style="width:164px; height: 12px; padding: 5px 0px 4px 0px; text-align: center; float-left; text-transform: uppercase;"><?php //echo(strtoupper($data['datos']['estado']))?></div>
        </div>

        <div style="width:759px; border-top: solid 1px #848484;">
            <div class="subfila" style="width:259px; font-size:8px; text-align: center; " >COLONIA</div>
            <div class="subfila" style="width:320px; font-size:8px; text-align: center; ">CIUDAD</div>
            <div class="subfila" style="width:164px; font-size:8px; text-align: center; ">ESTADO</div>
        </div>

        <div style="width:759px; background-color: #eae9e9; margin-top:7px; ">
            <div class="subfila" style="width:249px; height: 12px; padding: 5px 0px 4px 0px; float-left; text-align: center;"><?php //echo($data['datos']['tel_celular_alumno']) ?></div>
            <div class="subfila" style="width:249px; height: 12px; padding: 5px 0px 4px 0px; float-left; text-align: center;"><?php //echo($data['datos']['tel_fijo_alumno']) ?></div>
            <div class="subfila" style="width:242px; height: 12px; padding: 5px 0px 4px 0px; float-left; text-align: center;  text-transform: uppercase; "><?php //echo(strtoupper($data['datos']['email_alumno']))?></div>
        </div>

        <div style="width:759px; border-top: solid 1px #848484;">
            <div class="subfila" style="width:249px; font-size:8px; text-align: center; ">CELULAR</div>
            <div class="subfila" style="width:249px; font-size:8px; text-align: center; " >TELÉFONO FIJO</div>
            <div class="subfila" style="width:242px; font-size:8px; text-align: center; ">CORREO ELECTRÓNICO</div>
        </div>

        <div style="width:759px; background-color: #eae9e9; margin-top:7px; ">
            <div class="subfila" style="width:308px; height: 12px; padding: 5px 0px 4px 0px; text-align: center; float-left; "><?php //echo($data['datos']['nombre_escolaridad'])?></div>
            <div class="subfila" style="width:444px; height: 12px; padding: 5px 0px 4px 0px; text-align: center; float-left; "><?php //echo($data['datos']['nombre_empresa'])?></div>
        </div>

        <div style="width:759px; border-top: solid 1px #848484;">
            <div class="subfila" style="width:308px; font-size:8px; text-align: center; " >NIVEL DE ESTUDIOS REALIZADOS</div>
            <div class="subfila" style="width:444px; font-size:8px; text-align: center; ">EMPRESA DONDE TRABAJA</div>
        </div>

        <div style="width:759px; font-size: 13px; letter-spacing: 0.2em; text-align: center; margin: 30px 0px 7px 0px; ">DATOS DEL PADRE O TUTOR</div>

        <div style="width:759px; background-color: #eae9e9; margin-top:7px; ">
            <div class="subfila" style="width:249px; height: 12px; padding: 5px 0px 4px 0px; float-left; text-align: center;"><?php //echo(strtoupper($data['datos']['appat_tutor']))?></div>
            <div class="subfila" style="width:249px; height: 12px; padding: 5px 0px 4px 0px; float-left; text-align: center;"><?php //echo(strtoupper($data['datos']['apmat_tutor']))?> </div>
            <div class="subfila" style="width:232px; height: 12px; padding: 5px 0px 4px 0px; float-left; text-align: center;"><?php //echo(strtoupper($data['datos']['nombre_tutor']))?></div>
        </div>

        <div style="width:759px; border-top: solid 1px #848484;">
            <div class="subfila" style="width:249px; font-size:8px; text-align: center; ">APELLIDO PATERNO</div>
            <div class="subfila" style="width:249px; font-size:8px; text-align: center; " >APELLIDO MATERNO</div>
            <div class="subfila" style="width:232px; font-size:8px; text-align: center; ">NOMBRE(S)</div>
        </div>  

        <div style="width:759px; background-color: #eae9e9; margin-top:7px; ">
            <div class="subfila" style="width:249px; height: 12px; padding: 5px 0px 4px 0px; float-left; text-align: center;"><?php //echo($data['datos']['tel_celular_tutor']) ?></div>
            <div class="subfila" style="width:249px; height: 12px; padding: 5px 0px 4px 0px; float-left; text-align: center;"><?php //echo($data['datos']['tel_fijo_tutor'])?></div>
            <div class="subfila" style="width:232px; height: 12px; padding: 5px 0px 4px 0px; float-left; text-align: center;  text-transform: uppercase; "><?php //echo(strtoupper($data['datos']['email_tutor']))?></div>
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
                        <?php
                            //foreach ($data['doc'] as $key => $value) { ?>
                                <tr>
                                    <td class="borde-tabla" width="99"><?php //echo($value['tipo_documento']) ?></td>
                                    <td class="borde-tabla" width="1" style="text-align:center;"><input type="checkbox" value="second_checkbox"></td>
                                    <td class="borde-tabla" width="1" style="text-align:center;"><input type="checkbox" value="second_checkbox"></td>
                                    <td class="borde-tabla" width="1" style="text-align:center;"><input type="checkbox" value="second_checkbox"></td>
                                </tr>
                            <?php //}
                        ?>
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
        </table>
    </div>-->
</div>
</html>