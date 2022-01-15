<?php
    $medidaTicket = 180;
    $productos = [
        [
            "cantidad" => 1,
            "descripcion" => "Colegiatura Enero",
            "precio" => 800.00,
            "total" => 800.00,
        ],
        [
            "cantidad" => 1,
            "descripcion" => "Uniforme",
            "precio" => 500.00,
            "total" => 500.00,
        ],
        [
            "cantidad" => 2,
            "descripcion" => "Credencial Btca 1",
            "precio" => 150.00,
            "total" => 300.00,
        ]
    ];
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        * {
            font-size: 12px;
            font-family: 'DejaVu Sans', serif;
        }
        .ticket {
            margin: 5px;
            width: <?php echo $medidaTicket ?>px;
            max-width: <?php echo $medidaTicket ?>px;
        }
        td,th,tr,table {
            border-top: 1px solid black;
            border-collapse: collapse;
            margin: 0 auto;
        }

        td.precio {
            text-align: right;
            font-size: 11px;
        }
        #datos_alumno{
            font-size:8px;
        }
        td.cantidad {
            font-size: 11px;
        }
        th , .centrado, td.producto{
            text-align: center;
        }
        img {
            max-width: inherit;
            width: inherit;
        }
       /*  * {
            margin: 0;
            padding: 0;
        } */

        .ticket {
            margin: 0;
            padding: 0;
        }
        .encabezado{
            font-size: 9px;
            font-style:bold
        }
        .subencabezado{
            font-size: 8px;
        }
        .direccion{
            font-size: 6px;
        }
        .footer p{
            font-size:10px;
        }
    </style>
</head>

<body>
    <div class="ticket centrado">
        <p class="encabezado">SISTEMA EDUCATIVO UNIVERSITARIO AZTECA</p>
        <p class="subencabezado"> CLAVE: 07PSU0018E</p>
        <p class="direccion">2a. Norte Oriente #741. Tuxtla Gutiérrez,Centro,Tuxtla Gutiérrez,Chiapas, Mexico, CP:29000</p>
        <table>
            <tr>
                <td class="cantidad" colspan=2>
                    Folio: 4566823
                </td>
                <td class="producto"></td>
                <td class="precio">
                    24/12/2023
                </td>
            </tr>
            <tr>
                <td class="cantidad" colspan=3>
                    <p id="datos_alumno">Plantel: SEUAT Tuxtla</p>
                    <p id="datos_alumno">Estudiante: Jose Santiz Ruiz</p>
                    <p id="datos_alumno">Carrera: Lic. Trabajo social</p>
                    <p id="datos_alumno">Matricula: 04515484</p>
                </td>
                <td class="precio">
                </td> 
            </tr>
            <thead>
                <tr class="centrado">
                    <th class="cantidad">Desc.</th>
                    <th class="producto">#</th>
                    <th class="producto">P.U</th>
                    <th class="precio">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($productos as $producto) {
                    $total += $producto["cantidad"] * $producto["total"];
                ?>
                    <tr>
                        <td class="cantidad"><?php echo number_format($producto["cantidad"], 2) ?></td>
                        <td class="producto"><?php echo $producto["descripcion"] ?></td>
                        <td class="precio">$<?php echo number_format($producto["precio"], 2) ?></td>
                        <td class="precio">$<?php echo number_format($producto["total"], 2) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tr>
                <td class="cantidad"></td>
                <td class="producto">
                    <strong>TOTAL</strong>
                </td>
                <td class="precio">
                    $<?php echo number_format($total, 2) ?>
                </td>
            </tr>
        </table><br><br> 
        <div class="footer">
            <p class="centrado"><strong>¡GRACIAS</strong> <i>haz hecho una elección inteligente!</i>
            <br>www.seuat.mx</p>
        </div>
    </div>
</body>
</html>