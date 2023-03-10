<?php
    $title ="Gastos Categorias | ";
    include "head.php";
	$active4="active";
    
    if(isset($_SESSION['perfil'])){
		
        switch ($_SESSION['perfil']){
            case '1':
                include "sidebar_presidente.php";
                break;
            case '2':
                include "sidebar_camaras.php";
                break;
            case '3':
                include "sidebar_tesorero.php";
                break;
            case '0':
                include "sidebar.php";
                break;
        }
    }

    if (!in_array('cat_Gastos',$_SESSION['modulos'])) {
        #print_r($_SESSION['modulos']);
         header("location: index.php");
        exit;
     }
?>
        
    <div class="right_col" role="main"><!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php
                        include("modal/new_category_expences.php");
                        include("modal/upd_category_expences.php");
                    ?>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Categorias <small>Gastos</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        
                        <!-- form search -->
                        <form class="form-horizontal" role="form" id="category_expence">
                            <div class="form-group row">
                                <label for="q" class="col-md-2 control-label">Fecha o Nombre</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="q" placeholder="Fecha o Nombre de la categoria" onkeyup='load(1);'>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-default" onclick='load(1);'>
                                        <span class="glyphicon glyphicon-search" ></span> Buscar</button>
                                    <span id="loader"></span>
                                </div>
                            </div>
                        </form>    
                        <!-- end form search -->

                        <div class="x_content">
                            <div class="table-responsive">
                                <!-- ajax -->
                                    <div id="resultados"></div><!-- Carga los datos ajax -->
                                    <div class='outer_div'></div><!-- Carga los datos ajax -->
                                <!-- /ajax -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /page content -->


<?php include "footer.php" ?>

<script type="text/javascript" src="js/category_expences.js"></script>

<script>
$( "#add_category_expence" ).submit(function( event ) {
  $('#save_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/add_category_expences.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result_c_expence").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result_c_expence").html(datos);
            $('#save_data').attr("disabled", false);
            load(1);
          }
    });
  event.preventDefault();
})

// success

$( "#upd_c_expence" ).submit(function( event ) {
  $('#upd_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/upd_category_expences.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result_c_expence2").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result_c_expence2").html(datos);
            $('#upd_data').attr("disabled", false);
            load(1);
          }
    });
  event.preventDefault();
})

    function obtener_datos(id){
            var name = $("#name"+id).val();
            $("#mod_id").val(id);
            $("#mod_name").val(name);
        }
</script>