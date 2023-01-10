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
                    &copy; <?php echo "Ingeniero Web "; echo  $anio=date('Y'); ?>
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
            <?php
             if($casa != 'null'){ 
            ?>
                <h2 style="color: #16a085;">Estado de cuenta historico</h2>
            <?php } else {?>  
                <h2 style="color: #16a085;">Resumen de envios de saldos</h2>
            <?php } ?>  

            </td>
        </tr>
    </table>
    <br>

	
	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
		<tr>
      <?php
     
       if($casa != 'null'){
     
        $sql = mysqli_query($con, "select propietario from personas where casa='$casa'");
                            if($c=mysqli_fetch_array($sql)) {
                                $propietario=$c['propietario'];
                            }
        ?>
			<td style="width: 100%;text-align:right">
			Fecha: <?php echo date("d/m/Y");?>
            Casa: <?php echo $casa;?>
            <strong>Propietario: <?php echo $propietario;?></strong>
			</td>

            <?php } ?> 
		</tr>
    </table>

    <br>
  
    <table cellspacing="0" style="width: 100%; border: solid 1px #16a085; background: #16a085;color:white; text-align: center; font-size: 10pt;padding:1mm;">
        <tr>
            <th style="width: 12%">Fecha Mensualidad</th>
            <th style="width: 12%">Fecha de Pago </th>
            <th style="width: 12%">Mantenimiento </th>
            <th style="width: 12%">Pago </th>
            <th style="width: 7%">Recargo </th>
            <th style="width: 30%">Notas </th>
            <th style="width: 15%">Clave </th>
        </tr>
    </table>

	<table cellspacing="0" style="width: 100%; border: solid 1px #16a085;  text-align: center; font-size: 9.5pt;padding:1mm;">
    <?php

  

      $sTable="saldos";
        
      /*
			list ($f_inicio,$f_final)=explode(" - ",$daterange);//Extrae la fecha inicial y la fecha final en formato espa?ol
			list ($mes_inicio,$dia_inicio,$anio_inicio)=explode("/",$f_inicio);//Extrae fecha inicial 
			$fecha_inicial="$anio_inicio-$mes_inicio-$dia_inicio 00:00:00";//Fecha inicial formato ingles
			list($mes_fin,$dia_fin,$anio_fin)=explode("/",$f_final);//Extrae la fecha final
			$fecha_final="$anio_fin-$mes_fin-$dia_fin 23:59:59";
	  */

            $sWhere .=" where  casa='$casa'";
			$sWhere.=" order by fecha_mens asc";
     		$sql="SELECT casa,mensualidades,depositos,recargo,fecha_mens,fecha_pago,notas,recibonum,category_id,id FROM $sTable $sWhere";
                         
			$query = mysqli_query($con, $sql);
			$sumador_total=0;
           	while ($key=mysqli_fetch_array($query)) {
			
				 ?>
			<tr>

                <td style="width: 12%; text-align: left"><?php echo date("d/m/Y", strtotime($key['fecha_mens'])); ?></td>
                <td style="width: 12%; text-align: left"><?php echo $key['fecha_pago']; ?></td>
				<td style="width: 12%; text-align: right;"><?php echo number_format($key['mensualidades'],2); ?></td>
                <td style="width: 12%; text-align: right;"><?php echo number_format($key['depositos'],2); ?></td>
                <td style="width: 7%; text-align: right;"><?php echo number_format($key['recargo'],2); ?></td>
                <td style="width: 30%; text-align: center;"><?php echo $key['notas']; ?></td>
                <td style="width: 15%; text-align: left"><?php echo $key['id']; ?></td>
           
			</tr>	 

		    <?php

                $sumador_total+=$key['depositos'];
                $sumador_total_mens+=$key['mensualidades'];
                $suma_recargo+=$key['recargo'];
                 
			}	
            ?>    
             
        <?php 
                $coin = mysqli_query($con, "select * from configuration where name=\"coin\" ");
                while($r_coin=mysqli_fetch_array($coin)){
                    $coin_c = $r_coin['val'];
                }
       ?>
                
            <tr>
                <td style='text-align:right; border-top:solid 1px #16a085;' colspan=3><strong>mtto:<?php echo $coin_c; echo number_format($sumador_total_mens,2);?></strong> </td>
                <td style='text-align:left; border-top:solid 1px #16a085;' colspan=3><strong>pago:<?php echo $coin_c;echo number_format($sumador_total,2);?></strong><strong> recargo:<?php echo $coin_c;echo number_format($suma_recargo,2);?></strong>  <strong>saldo:<?php echo $coin_c; echo number_format((($sumador_total_mens+$suma_recargo)-$sumador_total),2);?></strong></td>
            </tr>
       
      </table>
    <br><br><br><br>	
	
</page>
