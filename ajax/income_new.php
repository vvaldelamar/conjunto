<?php
    session_start();
    include "../config/config.php";
    if (!isset($_SESSION['user_id'])&& $_SESSION['user_id']==null) {
        header("location: index.php");
        exit;
    }
?>
<?php
    
    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if (isset($_GET['id'])){
	$id_expence=intval( mysqli_real_escape_string($con,(strip_tags($_GET['id'],ENT_QUOTES))));
    $query=mysqli_query($con, "SELECT * from base WHERE id_tabla='".$id_expence."'");
    $count=mysqli_num_rows($query);

    $user_id=intval($_SESSION['user_id']);
    $read_only = mysqli_query($con, "SELECT count(*) AS numrows FROM user WHERE id=$user_id AND is_ready=1");
    $row= mysqli_fetch_array($read_only);
    $numrows = $row['numrows'];

      if ($numrows==0)
       { 

            if ($delete1=mysqli_query($con,"DELETE FROM base WHERE id_tabla='".$id_expence."'")){
            ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Aviso!</strong> Datos eliminados exitosamente.
                    </div>
                    <?php }else{  ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
                    </div>
                        <?php   } //end else ?>

                        <?php 
        }     else  {
                ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Error!</strong>  No tienes permisos para hacer cambios.
                </div>
            <?php  } ?>    
   <?php  
   }
   ?>     

    <?php
    if($action == 'ajax'){
        // escaping, additionally removing everything that could be (html/javascript-) code
         $daterange = mysqli_real_escape_string($con,(strip_tags($_REQUEST['daterange'], ENT_QUOTES)));
         $category=mysqli_real_escape_string($con,(strip_tags($_REQUEST['casa'],ENT_QUOTES))); 
         $sTable = "base";
         $sWhere = "";
		
		list ($f_inicio,$f_final)=explode(" - ",$daterange);//Extrae la fecha inicial y la fecha final en formato espa?ol
			list ($dia_inicio,$mes_inicio,$anio_inicio)=explode("/",$f_inicio);//Extrae fecha inicial 
			$fecha_inicial="$anio_inicio-$mes_inicio-$dia_inicio 00:00:00";//Fecha inicial formato ingles
			list($dia_fin,$mes_fin,$anio_fin)=explode("/",$f_final);//Extrae la fecha final
			$fecha_final="$anio_fin-$mes_fin-$dia_fin 23:59:59";
		
			$sWhere = "where fecha_pago between '$fecha_inicial' and '$fecha_final' and id != 'INI' and id !='MEN' and deposito !=0 ";

            if($category == 'null'){} else  { $sWhere .=" and casa='$category'"; }
			
        $sWhere.=" order by fecha_pago desc";
	$licuado=0;
	$sumador_total=0;
	$querytotal = mysqli_query($con,"select tipo,deposito from base ".$sWhere);
        while ($r=mysqli_fetch_array($querytotal)) { 
       		if($r['tipo'] == 'EFECTIVO'){ $licuado= $licuado + $r['deposito'];  }
                $sumador_total+=$r['deposito'];
       		}
        
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
        $reload = './income.php';
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
                        <th class="column-title">Fecha </th>
                        <th class="column-title">Propietario </th>
                        <th class="column-title">Cantidad </th>
                        <th class="column-title">Categoría </th>
                        <th class="column-title no-link last"><span class="nobr"></span></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                        while ($r=mysqli_fetch_array($query)) {

                            $id=$r['id_tabla'];
                            $created_at=date('d/m/Y', strtotime($r['fecha_mens']));
                            $description=$r['nombre'];
                            $notas=$r['notas'];
                            $casas=$r['casa'];
                            $tipo=$r['tipo'];
                            $fecha_pago=$r['fecha_pago'];
                            $recibonum=$r['recibonum'];
                            $amount=$r['deposito'];
                            $user_id=$r['user_id'];
                            $category_id=$r['category_id'];
	                    $ref= $r['refencia'];
			    $ordenante=$r['ordenante'];
			    $image=$r['imagen'];
                            #Se agrega esto para agregar multas se cargan como depositos
                      
                            $sql = mysqli_query($con, "select * from category_income where id=$category_id");
                            if($c=mysqli_fetch_array($sql)) {
                                $name_category=$c['name'];
                            }

                            $coin_name = "coin";
                            $querycoin = mysqli_query($con,"select * from configuration where name=\"$coin_name\" ");
                            if ($r = mysqli_fetch_array($querycoin)) {
                                $coin=$r['val'];
                            }
                ?>
                    <!-- <input type="hidden" value="<?php echo $created_at;?>" id="created_at<?php echo $id;?>"> -->
                    
                    <input type="hidden" value="<?php echo $description;?>" id="description<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $category_id;?>" id="category_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo number_format($amount,2,'.','');?>" id="amount<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $recibonum;?>" id="recibonum<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $notas;?>" id="notas<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $casas;?>" id="casas<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $tipo;?>" id="tipo<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $fecha_pago;?>" id="fecha_pago<?php echo $id;?>">
		    <input type="hidden" value="<?php echo $ordenante;?>" id="ordenante<?php echo $id;?>">
		    <input type="hidden" value="<?php echo $image;?>" id="image<?php echo $id;?>">


                    <tr class="even pointer">
<td> <?php if (strlen($ref) != 0){ ?> <i class="fa fa-hashtag" aria-hidden="true"></i> <?php echo $ref; ?>  <?php }?> </td>
<td> <?php if (strlen($casas) != 0){ ?> <i class="fa fa-home" aria-hidden="true"></i> <?php echo $casas; ?>  <?php }?> </td>
                        <td><?php echo date('d/m/Y', strtotime($fecha_pago));?></td>
                        <td><?php echo $description; ?></td>
                        <td><?php echo "  ". $coin; ?> <?php echo number_format($amount,2);?></td>
                        <td><?php echo $name_category;?></td>
                        <td ><span class="pull-right">
                        <a href="#" class='btn btn-default' title='Editar ingreso' onclick="obtener_datos('<?php echo $id;?>');" data-toggle="modal" data-target=".bs-example-modal-lg-udp"><i class="glyphicon glyphicon-edit"></i></a> 
                        <a href="#" class='btn btn-default' title='Borrar ingreso' onclick="eliminar('<?php echo $id; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
                    </tr>              

                <?php
                    } //end while
                ?>

			<tr>
			<div class="row">
                                       <div class="col-md-3 col-sm-4">
                                                <div class="panel panel-body has-bg-image">
                                                        <div class="media no-margin">
                                                                <div class="media-body">
                                                                        <h3 class="counter-value no-margin">$
                                                                        <?php echo number_format($sumador_total,2);?>
                                                                        </h3>
                                                                        <span class="text-uppercase text-size-mini">TOTAL </span>
                                                                </div>

                                                                <div class="media-right media-middle">
                                                                        <i class="icon-piggy-bank icon-3x opacity-75"></i>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                         <div class="col-md-3 col-sm-4">
                                                <div class="panel panel-body has-bg-image">
                                                        <div class="media no-margin">
                                                                <div class="media-body">
                                                                        <h3 class="counter-value no-margin">$
                                                                        <?php echo number_format($licuado,2);?>
                                                                        </h3>
                                                                        <span class="text-uppercase text-size-mini">EFECTIVO </span>
                                                                </div>

                                                                <div class="media-right media-middle">
                                                                        <i class="icon-coins icon-3x opacity-75"></i>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>

                                       <div class="col-md-3 col-sm-4">
                                                <div class="panel panel-body has-bg-image">
                                                        <div class="media no-margin">
                                                                <div class="media-body">
                                                                        <h3 class="counter-value no-margin">$
                                                                        <?php echo number_format($sumador_total- $licuado,2);?>
                                                                        </h3>
                                                                        <span class="text-uppercase text-size-mini">BANCO </span>
                                                                </div>

                                                                <div class="media-right media-middle">
                                                                        <i class="icon-credit-card icon-3x opacity-75"></i>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>

                        </div>
                </tr>
		<tr>

                    <td colspan=8><span class="pull-right">
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
