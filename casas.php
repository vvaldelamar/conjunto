<?php
    $title ="Casas | ";
    include "head.php";
	$active10="active";
    
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

    if (!in_array('Casas',$_SESSION['modulos'])) {
        #print_r($_SESSION['modulos']);
         header("location: index.php");
        exit;
     }
    

?>
    <div class="right_col" role="main"> <!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php
                        include("modal/upd_casas.php");
                        include("modal/new_comunica.php");
                    ?>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Editar información de propietarios</h2>
                            <ul class="nav navbar-right panel_toolbox">
             <li><a href="#" title='Enviar comunica general' onclick="obtener_datos('<?php echo $id;?>');" data-toggle="modal" data-target=".bs-example-modal-lg-mail">
                                 <i class="fa fa-envelope"></i></a>
                                 <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        
                       

                        <!-- form print -->
                        <form class="form-horizontal" role="form" id="data_casas">
                             <div class="form-group row">
                                    <div class="col-md-3 pull-left">
                                        <select class="form-control" id="casa" name="casa" onchange="load(1);">
                                        <option selected="" value="null">-- Imprimir por Propietario --</option>
                                            <?php
                                            $categories = mysqli_query($con,"select * from personas");
                                            while ($cat=mysqli_fetch_array($categories)) { ?>
                                            <option value="<?php echo $cat['casa']; ?>"><?php echo $cat['propietario']; ?>  <?php echo $cat['casa']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div> 
									<div class="col-md-3">
										<button type="button" class="btn btn-default" onclick='load(1);'>
											<span class="glyphicon glyphicon-search" ></span> Buscar</button>
										<span id="loader"></span>
									</div>		
                 
                            </div>    
                        </form>
                        <!-- end form print -->

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
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="js/casas.js"></script>
<script type="text/javascript" src="js/VentanaCentrada.js"></script>
<script>

  $( "#add_casas" ).submit(function( event ) {
  $('#save_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/add_casas.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result_casas").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result_casas").html(datos);
            $('#save_data').attr("disabled", false);
            document.getElementById("add_casas").reset();
            load(1);
          }
    });
  event.preventDefault();
})


$("#upd_saldo").on("click", function(){
    $('#upd_saldo').attr("disabled", true);
     var parametros = $( "#upd_casas" ).serialize();
    $.ajax({
				url: "action/upd_casas_saldo.php",
				type: "POST",
                data: parametros,
                beforeSend: function(objeto){  $("#result_casas2").html("Mensaje: Cargando...");  },
                success: function(datos){
                $("#result_casas2").html(datos);
                $('#upd_saldo').attr("disabled", false);
                load(1);
                }
			})
            event.preventDefault();
		});


$("#upd_comun").on("click", function(){
    $('#upd_comun').attr("disabled", true);
     var parametros = $( "#upd_cominica" ).serialize();
    $.ajax({
				url: "action/upd_casas_comunica.php",
				type: "POST",
                data: parametros,
                beforeSend: function(objeto){  $("#result_casas3").html("Mensaje: Cargando...");  },
                success: function(datos){
                $("#result_casas3").html(datos);
                $('#upd_comun').attr("disabled", false);
                load(1);
                }
			})
            event.preventDefault();
		});


$("#upd_data").on("click", function(){
    $('#upd_data').attr("disabled", true);
     var parametros = $( "#upd_casas" ).serialize();
    $.ajax({
				url: "action/upd_casas.php",
				type: "POST",
                data: parametros,
                beforeSend: function(objeto){  $("#result_casas2").html("Mensaje: Cargando...");  },
                success: function(datos){
                $("#result_casas2").html(datos);
                $('#upd_data').attr("disabled", false);
                load(1);
                }
			})
            event.preventDefault();
		});

// sucess saldo
    function obtener_datos(id){

            var casa = $("#casa"+id).val();
            var propietario = $("#propietario"+id).val();
			var correo = $("#correo"+id).val();
            var telefono1 = $("#telefono1"+id).val();
            var telefono2 = $("#telefono2"+id).val();

            var tarjeta = $("#tarjeta"+id).val();

            var corr = correo.split(";"); 
  
            $("#mod_id").val(id);
            $("#mod_casa").val(casa);
            $("#mod_propietario").val(propietario);
			if (corr && corr.length >= 0) {   $("#mod_correo").val(corr[0]); }
            if (corr && corr.length >= 1) {   $("#mod_correo_sec").val(corr[1]); }
            $("#mod_telefono1").val(telefono1);
            $("#mod_telefono2").val(telefono2);
            $("#mod_tarjeta").val(tarjeta);
  
        }

</script>
