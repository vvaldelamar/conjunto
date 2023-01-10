<?php
    session_start();
    include "../config/config.php";
    if (!isset($_SESSION['user_id'])&& $_SESSION['user_id']==null) {
        header("location: index.php");
        exit;
    }
$action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
?>

    <?php
    if($action == 'ajax'){
        // escaping, additionally removing everything that could be (html/javascript-) code
        // $daterange = mysqli_real_escape_string($con,(strip_tags($_REQUEST['daterange'], ENT_QUOTES)));
         $category  = mysqli_real_escape_string($con,(strip_tags($_REQUEST['casa'],ENT_QUOTES)));
         $sTable = "personas";
     	 $sWhere = "where casa is not null ";

            if($category == 'null'){} else  { $sWhere .=" and casa='$category'"; }
			
        $sWhere.=" order by id asc";
        include 'pagination.php'; //include pagination file
        //pagination variables
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 10; //how much records you want to show
        $adjacents  = 4; //gap between pages after number of adjacents
        $offset = ($page - 1) * $per_page;
        //Count the total number of row in your table*/
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);      
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows/$per_page);
        $reload = './multas.php';
        //main query to fetch the data
        $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
        $query = mysqli_query($con, $sql);
        //loop through fetched data
        if ($numrows>0){
            
            ?>
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                    <tr class="headings">
			<th class="column-title">Referencia </th>
                        <th class="column-title">Casa </th>
                        <th class="column-title">Propietario </th>
                        <th class="column-title">Saldo </th> 
			            <th class="column-title">Tarjeta</th>
                        <th class="column-title no-link last"><span class="nobr"></span></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                        while ($r=mysqli_fetch_array($query)) {
                            $id=$r['id'];
                            $casa=$r['casa'];
                            $propietario=$r['propietario'];
                            $correo=$r['correo'];
                            $telefono1=$r['telefono1'];
                            $telefono2=$r['telefono2'];
                            $referencia=$r['referencia'];
                            $tarjeta=$r['tarjetas'];
                            $saldoini=$r['saldo_inicial'];
			    $ref=$r['referencia'];


                            $coin_name = "coin";
                            $querycoin = mysqli_query($con,"select * from configuration where name=\"$coin_name\" ");
                            if ($r = mysqli_fetch_array($querycoin)) {
                                $coin=$r['val'];
                            }

                 $querytotal = mysqli_query($con,"select (sum(ROUND(mensualidades,2))+ sum(ROUND(recargo,2)) )-sum(ROUND(depositos,2))AS amount FROM saldos where casa=\"$casa\" ");
                            if ($r = mysqli_fetch_array($querytotal)) {
                                $total_saldo=$r['amount'];
                            }
		$querypagado= mysqli_query($con,"select (sum(ROUND(depositos,2)))AS amount FROM saldos where casa=\"$casa\" and id='PAG' ");
                            if ($r = mysqli_fetch_array($querypagado)) {
                                $total_pagado=$r['amount'];
                            }
                             
                ?>
                   
                    <input type="hidden" value="<?php echo $casa;?>" id="casa<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $propietario;?>" id="propietario<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $correo;?>" id="correo<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $telefono1;?>" id="telefono1<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $telefono2;?>" id="telefono2<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $referencia;?>" id="referencia<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $tarjeta;?>" id="tarjeta<?php echo $id;?>">
              
            <tr class="even pointer">
			<td> <?php if (strlen($ref) != 0){ ?> <i class="fa fa-hashtag" aria-hidden="true"></i> <?php echo $ref; ?>  <?php }?> </td>
			<td> <?php echo $casa; ?> </td> 
			<td><?php   if (strlen($propietario) != 0){ ?><?php echo " ".$propietario;?><?php }?></td>
            
            <?php if ($total_saldo<2000){ ?>
			<td><span class="label label-success" style="font-size:12px;"><?php echo $coin; ?>  <?php echo number_format($total_saldo,2);?></span></td>
            <?php
                    }else{ 
           ?>
            <td><span class="label label-danger" style="font-size:12px;"><?php echo $coin; ?>  <?php echo number_format($total_saldo,2);?></span></td>
             <?php
                    } 
                ?>
                        <?php if ($tarjeta==1){ ?>
			<td class='text-left'><span class="label label-success" style="font-size:12px;">Activa</span></td> </td>
			<?php } else {?>
		         <td class='text-left'><span class="label label-danger" style="font-size:12px;">Inactiva</span></td>	
			<?php }?>
                        <td ><span class="pull-right">
                        <a href="#" class='btn btn-default' title='Editar ingreso' onclick="obtener_datos('<?php echo $id;?>');" data-toggle="modal" data-target=".bs-example-modal-lg-udp">
                        <i class="glyphicon glyphicon-edit"></i></a> 
                    </tr>              

                <?php
                    } //end while
                ?>
                <tr>
                    <td colspan=10><span class="pull-right">
                        <?php echo paginate($reload, $page, $total_pages, $adjacents);?>
                    </span></td>
                </tr>
              </table>
            </div>
            <?php
        }else{
           ?> 
            <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> No hay datos para mostrar
            </div>
        <?php    
        }
    }
?>
