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
            if ($delete1=mysqli_query($con,"DELETE FROM base WHERE id_tabla='".$id_expence."'")){
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> Datos eliminados exitosamente.
            </div>
    <?php
        }else{
    ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
            </div>
<?php
        } //end else
    } //end if
?>
    <?php
    if($action == 'ajax'){
        // escaping, additionally removing everything that could be (html/javascript-) code
         $daterange = mysqli_real_escape_string($con,(strip_tags($_REQUEST['daterange'], ENT_QUOTES)));
         $category  = mysqli_real_escape_string($con,(strip_tags($_REQUEST['casa'],ENT_QUOTES)));
         $sTable = "base";
         $sWhere = "";
                 $union="";

                list ($f_inicio,$f_final)=explode(" - ",$daterange);//Extrae la fecha inicial y la fecha final en formato espa?ol
                        list ($dia_inicio,$mes_inicio,$anio_inicio)=explode("/",$f_inicio);//Extrae fecha inicial
                        $fecha_inicial="$anio_inicio-$mes_inicio-$dia_inicio 00:00:00";//Fecha inicial formato ingles
                        list($dia_fin,$mes_fin,$anio_fin)=explode("/",$f_final);//Extrae la fecha final
                        $fecha_final="$anio_fin-$mes_fin-$dia_fin 23:59:59";

                        $sWhere= " fecha_mens between '$fecha_inicial' and '$fecha_final'  and casa='$category'";

        $sWhere.=" order by fecha_mens asc";
        include 'pagination.php'; //include pagination file
        //pagination variables
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 15; //how much records you want to show
        $adjacents  = 4; //gap between pages after number of adjacents
        $offset = ($page - 1) * $per_page;
        //Count the total number of row in your table*/

        $union="SELECT COUNT(*) AS numrows FROM saldos WHERE $sWhere";

        $count_query   = mysqli_query($con, $union);
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows/$per_page);
        $reload = './multas.php';
        //main query to fetch the data

        $vista="SELECT casa,mensualidades,depositos,fecha_mens,fecha_pago,notas,recibonum,category_id,id FROM saldos  WHERE ";

        $sql="$vista $sWhere LIMIT $offset,$per_page";

        $query = mysqli_query($con, $sql);
        //loop through fetched data
        if ($numrows>0){

            ?>
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                    <tr class="headings">
                        <th class="column-title">Fecha Mensualidad</th>
                        <th class="column-title">Fecha de Pago </th>
                        <th class="column-title">Mantenimiento </th>
                        <th class="column-title">Pago </th>
                        <th class="column-title">Notas </th>
                        <th class="column-title">Clave </th>
                        <th class="column-title no-link last"><span class="nobr"></span></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                        while ($r=mysqli_fetch_array($query)) {

                            $mensualidades=$r['mensualidades'];
                            $depositos=$r['depositos'];
                            $fecha_mens=date('d/m/Y', strtotime($r['fecha_mens']));
                                if (empty($r['fecha_pago'])) { $fecha_pago="No existe datos registrados.";}else{
                            $fecha_pago=date('d/m/Y', strtotime($r['fecha_pago']));}
                            $notas=$r['notas'];
                            $recibonum=$r['recibonum'];
                            $category_id=$r['category_id'];
                            $id=$r['id'];


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

                                if( $notas ==NULL)
                                        $notas="No existe datos registrados.";

                ?>

                    <tr class="even pointer">
                        <td><?php echo $fecha_mens;?></td>
                        <td ><?php echo $fecha_pago; ?></td>

                        <td><?php echo $coin; ?> <?php echo number_format($mensualidades,2);?></td>
                        <td><?php echo $coin; ?> <?php echo number_format($depositos,2);?></td>

                        <td ><?php echo $notas; ?></td>
                        <td><?php echo $id;?></td>
                        <td ><span class="pull-right">
                    </tr>

                <?php
                    } //end while
                            $querytotal = mysqli_query($con,"select (sum(ROUND(mensualidades,2))+ sum(ROUND(recargo,2)) )-sum(ROUND(depositos,2))AS amount FROM saldos where fecha_mens between '$fecha_inicial' and '$fecha_final' and casa='$category' ");
                            if ($r = mysqli_fetch_array($querytotal)) {
                                $total_saldo=$r['amount'];
                            }
                            $querypagado= mysqli_query($con,"select (sum(ROUND(depositos,2)))AS amount FROM saldos where id='PAG' and fecha_mens between '$fecha_inicial' and '$fecha_final' and casa='$category' ");
                            if ($r = mysqli_fetch_array($querypagado)) {
                                $total_pagado=$r['amount'];
                            }

                           $querypagado_t= mysqli_query($con,"select (sum(ROUND(depositos,2)))AS amount FROM saldos where fecha_mens between '$fecha_inicial' and '$fecha_final' and casa='$category' ");
                            if ($r = mysqli_fetch_array($querypagado_t)) {
                                $total_pagado_t=$r['amount'];
                            }
                           $query_mens= mysqli_query($con,"select (sum(ROUND(mensualidades,2)))AS amount FROM saldos where fecha_mens between '$fecha_inicial' and '$fecha_final' and casa='$category' ");
                            if ($r = mysqli_fetch_array($query_mens)) {
                                $total_mens_t=$r['amount'];
                            }
                           $query_ini= mysqli_query($con," select (sum(ROUND(mens,2))+ sum(ROUND(recargo,2)) )-sum(ROUND(deposito,2))AS amount FROM base_historica WHERE casa='$category' ");
                            if ($r = mysqli_fetch_array($query_ini)) {
                                $total_ini=$r['amount'];
                            }
                ?>

                                <div class="container">
                                        <div class="row">
                                        <div class="col-md-3 col-sm-6">
                                                <?php if($total_saldo<2000){ ?>
                                                <div class="panel panel-body has-bg-image">
                                                <?php }else{ ?>
                                                <div class="panel panel-body bg-danger has-bg-image">
                                                <?php } ?>
                                                        <div class="media no-margin">
                                                                <div class="media-body">
                                                                        <h3 class="no-margin">$
                                                                        <?php echo number_format($total_saldo,2);?>
                                                                        </h3>
                                                                        <span class="text-uppercase text-size-mini">SALDO </span>
                                                                </div>

                                                                <div class="media-right media-middle">
                                                                        <i class="icon-wallet icon-3x opacity-75"></i>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>



                                        <div class="col-md-3 col-sm-6">
                                                <div class="panel panel-body has-bg-image">
                                                        <div class="media no-margin">
                                                                <div class="media-body">
                                                                        <h3 class="no-margin">$
                                                                        <?php echo number_format($total_ini,2);?>
                                                                        </h3>
                                                                        <span class="text-uppercase text-size-mini">SALDO INICIAL </span>
                                                                </div>

                                                                <div class="media-right media-middle">
                                                                        <i class="icon-price-tag icon-3x opacity-75"></i>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>



                                       <div class="col-md-3 col-sm-6">
                                                <div class="panel panel-body has-bg-image">
                                                        <div class="media no-margin">
                                                                <div class="media-body">
                                                                        <h3 class="no-margin">$
                                                                        <?php echo number_format($total_pagado,2);?>
                                                                        </h3>
                                                                        <span class="text-uppercase text-size-mini">ADMIN. ACTUAL</span>
                                                                </div>

                                                                <div class="media-right media-middle">
                                                                        <i class="icon-cash icon-3x opacity-75"></i>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>



                                        <div class="col-md-3 col-sm-6">
                                                <div class="panel panel-body has-bg-image">
                                                        <div class="media no-margin">
                                                                <div class="media-body">
                                                                        <h3 class="no-margin">$
                                                                        <?php echo number_format($total_pagado_t,2);?>
                                                                        </h3>
                                                                        <span class="text-uppercase text-size-mini">TOTAL PAGADO.</span>
                                                                </div>

                                                                <div class="media-right media-middle">
                                                                        <i class="icon-cash3 icon-3x opacity-75"></i>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>


                                        </div>
                        </div>

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
