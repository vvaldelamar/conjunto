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
                <td style="width: 50%; text-align: left">
                    P&aacute;gina [[page_cu]]/[[page_nb]]
                </td>
                <td style="width: 50%; text-align: right">
                    &copy; <?php echo "Sistemas Web "; echo  $anio=date('Y'); ?>
                </td>
            </tr>
        </table>
    </page_footer>
    <table cellspacing="0" style="width: 100%;">
        <tr>
        <?php foreach ($configuration as $settings) { ?> 
        <?php if ($settings['name']=="logo") { ?>
            <td style="width: 25%; color: #444444;">
                <img style="width: 100%;" src="../../images/<?php echo $settings['val']; ?>" alt="Logo"><br>
            </td>
        <?php } ?>   
		<?php } //end foreach ?>   
            <td style="width: 75%;text-align:right">
                <h2 style="color: #16a085;">Ingresos</h2>
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
            <th style="width: 10%">FECHA</th>
            <th style="width: 40%">PROPIETARIO</th>
            <th style="width: 15%">CANTIDAD</th>
            <th style="width: 15%">CASA</th>
	    <th style="width: 15%">TIPO</th>
            
        </tr>
    </table>

	<table cellspacing="0" style="width: 100%; border: solid 1px #16a085;  text-align: center; font-size: 9.5pt;padding:1mm;">
    <?php

      $sTable="base";
        
			list ($f_inicio,$f_final)=explode(" - ",$daterange);//Extrae la fecha inicial y la fecha final en formato espa?ol
			list ($dia_inicio,$mes_inicio,$anio_inicio)=explode("/",$f_inicio);//Extrae fecha inicial 
			$fecha_inicial="$anio_inicio-$mes_inicio-$dia_inicio 00:00:00";//Fecha inicial formato ingles
			list ($dia_fin,$mes_fin,$anio_fin)=explode("/",$f_final);//Extrae la fecha final
			$fecha_final="$anio_fin-$mes_fin-$dia_fin 23:59:59";
		
			$sWhere = "where fecha_pago between '$fecha_inicial' and '$fecha_final' and id='PAG' ";
		
		        if($casa == 'null'){} else  { $sWhere .=" and casa='$casa'"; }
		
		
			$sWhere.=" order by fecha_pago asc";

         
			$sql="SELECT * FROM  $sTable $sWhere";
			$query = mysqli_query($con, $sql);
			$sumador_total=0;
           
			while ($key=mysqli_fetch_array($query)) {
				
				if($key['tipo'] == 'EFECTIVO'){ $licuado= $licuado + $key['deposito'];  } 
			
				 ?>
            
			<tr>
				<td style="width: 10%; text-align: left"><?php echo date("d/m/Y", strtotime($key['fecha_pago'])); ?></td>
				<td style="width: 40%; text-align: left;"><?php echo $key['nombre']; ?></td>
				<td style="width: 15%; text-align: right;"><?php echo number_format($key['deposito'],2); ?></td>
                		<td style="width: 15%; text-align: center"><?php echo $key['casa']; ?></td>
				<td style="width: 15%; text-align: center"><?php echo $key['tipo']; ?></td>
      
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
			<td style='text-align:right; border-top:solid 1px #16a085;' colspan=2><strong>TOTAL <?php echo $coin_c;?></strong> </td>
			<td style='text-align:right; border-top:solid 1px #16a085' > <strong><?php echo number_format($sumador_total,2);?></strong></td>
			<td style='text-align:right; border-top:solid 1px #16a085' > <strong>Efectivo:<?php echo number_format($licuado,2);?></strong> </td>
			<td style='text-align:right; border-top:solid 1px #16a085' > <strong>Banco:<?php echo number_format($sumador_total- $licuado,2);?></strong> </td>
		 </tr>
    </table>
</page>