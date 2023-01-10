<?php
header("Content-Type: application/vnd.ms-excel; charset=iso-8859-1");
header("Content-Disposition: attachment; filename=conciliacion.xls");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);
        /*-------------------------
        ---------------------------*/
        session_start();
        if (!isset($_SESSION['user_id']) AND $_SESSION['user_id'] != 1){
        header("location: ../../");
                exit;
    }
        /* Connect To Database*/

        include("../../config/config.php");
        $session_id= session_id();
        $sql_count=mysqli_query($con,"select * from base where user_id='".$session_id."'");
        $count=mysqli_num_rows($sql_count);
        if ($count>0)
        {
        echo "<script>alert('No hay ingresos agregados!, por favor agregalo...')</script>";
        echo "<script>window.close();</script>";
        exit;
        }
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
}
-->
</style>
<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
        <page_footer>
        <table class="page_footer">
        <?php
            $configuration = mysqli_query($con, "select * from configuration");
        ?>
            <tr>
                <td style="width: 50%; text-align: right">
                    &copy; <?php echo "Sistemas Web Santa Anita  "; echo  $anio=date('Y'); ?>
                </td>
            </tr>
        </table>
    </page_footer>
    <table cellspacing="0" style="width: 100%;">
        <tr>
               <td style="width: 75%;text-align:right">
                <h2 style="color: #16a085;">Conciliacion Bancaria</h2>
            </td>
        </tr>
    </table>
    <br>


        <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
                <tr>
                        <td style="width: 100%;text-align:right">
                        Fecha: <?php echo date("d/m/Y");?>
                        </td>
                </tr>
        </table>

    <br>

    <table cellspacing="0" style="width: 100%; border: solid 1px #16a085; background: #16a085;color:white; text-align: center; font-size: 10pt;padding:1mm;">
        <tr>
            <th style="width: 5%">NUM.CASA</th>
            <th style="width: 10%">FECHA</th>
            <th style="width: 10%">TIPO DE TRANSFERENCIA</th>
            <th style="width: 35%">DESCRIPCION</th>
            <th style="width: 15%">NUM.RECIBO</th>
            <th style="width: 15%">PROPIETARIO</th>
            <th style="width: 15%">ORDENANTE</th>
            <th style="width: 15%">CANTIDAD</th>
        </tr>
    </table>

        <table cellspacing="0" style="width: 100%; border: solid 1px #16a085;  text-align: center; font-size: 9.5pt;padding:1mm;">
    <?php

      $sTable="base";

                        list ($f_inicio,$f_final)=explode(" - ",$_GET['daterange']);//Extrae la fecha inicial y la fecha final en formato espa?ol
                        list ($dia_inicio,$mes_inicio,$anio_inicio)=explode("/",$f_inicio);//Extrae fecha inicial
                        $fecha_inicial="$anio_inicio-$mes_inicio-$dia_inicio 00:00:00";//Fecha inicial formato ingles
                        list ($dia_fin,$mes_fin,$anio_fin)=explode("/",$f_final);//Extrae la fecha final
                        $fecha_final="$anio_fin-$mes_fin-$dia_fin 23:59:59";

                        $sWhere = "where fecha_pago between '$fecha_inicial' and '$fecha_final' and id='PAG' ";


                        $sWhere.=" order by fecha_pago asc";


                        $sql="SELECT * FROM  $sTable $sWhere";
                        $query = mysqli_query($con, $sql);
                        $sumador_total=0;

                        while ($key=mysqli_fetch_array($query)) {

                                if($key['tipo'] == 'EFECTIVO'){ $licuado= $licuado + $key['deposito'];  }

                                 ?>
                        <tr>
			        <td style="width: 5%; text-align: left"><?php echo$key['casa']; ?></td>
                                <td style="width: 10%; text-align: left"><?php echo date("d/m/Y", strtotime($key['fecha_pago'])); ?></td>
                                <td style="width: 10%; text-align: left;"><?php echo $key['tipo']; ?></td>
                                <td style="width: 35%; text-align: left;"><?php echo $key['notas']; ?></td>
                                <td style="width: 15%; text-align: left"><?php echo $key['recibonum']; ?></td>
                                <td style="width: 15%; text-align: left"><?php echo utf8_decode ($key['nombre']); ?></td>
                                <td style="width: 15%; text-align: left"><?php echo $key['ordenante']; ?></td>
                                <td style="width: 15%; text-align: left"><?php echo number_format($key['deposito'],2); ?></td>

                        </tr>
                                 <?php
                                 $sumador_total+=$key['deposito'];
                        }

    ?>
        <?php
                $coin = mysqli_query($con, "select * from configuration where name=\"coin\" ");
                while($r_coin=mysqli_fetch_array($coin)){
                    $coin_c = $r_coin['val'];
                }
       ?>


                <tr>
			<td style='text-align:right; border-top:solid 1px #16a085' ></td>			
			<td style='text-align:right; border-top:solid 1px #16a085' ></td>
                        <td style='text-align:left; border-top:solid 1px #16a085' > <strong>Efectivo:<?php echo number_format($licuado,2);?></strong> </td>
                        <td style='text-align:right; border-top:solid 1px #16a085' > <strong>Banco:<?php echo number_format($sumador_total- $licuado,2);?></strong> </td>
			<td style='text-align:right; border-top:solid 1px #16a085;' colspan=2><strong>TOTAL <?php echo $coin_c;?></strong> </td>
                        <td style='text-align:left; border-top:solid 1px #16a085' > <strong><?php echo number_format($sumador_total,2);?></strong></td>
                 </tr>
    </table>

