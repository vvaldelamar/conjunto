<?php
    $title ="Multas | ";
    include "head.php";
	$active8="active";
    
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
    if (!in_array('Multas',$_SESSION['modulos'])) {
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
                        include("modal/new_multas.php");
                        include("modal/upd_multas.php");
                    ?>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Ingresos</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        
                       

                        <!-- form print -->
                        <form class="form-horizontal" role="form" id="data_multas">
                             <div class="form-group row">
                                <input type="hidden" class="form-control" id="name_user" value="<?php echo $name; ?>">
                                    <div class="col-md-3 pull-left">
                                       <input type="text" class="form-control" id="daterange" name="daterange" value="<?php echo "01/".date("m/Y")." - ".date("d/m/Y");?>" readonly onchange="load(1);">
                                    </div>
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
 
<!-- Include Date Range Picker -->
<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript" src="js/multas.js"></script>
<script type="text/javascript" src="js/VentanaCentrada.js"></script>
<script>
$( "#add_multas" ).submit(function( event ) {
  $('#save_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/add_multas.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result_multas").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result_multas").html(datos);
            $('#save_data').attr("disabled", false);
            document.getElementById("add_multas").reset();
            load(1);
          }
    });
  event.preventDefault();
})

// success

$( "#upd_multas" ).submit(function( event ) {
  $('#upd_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/upd_multas.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result_multas2").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result_multas2").html(datos);
            $('#upd_data').attr("disabled", false);
            load(1);
          }
    });
  event.preventDefault();
})

    function obtener_datos(id){

            var description = $("#description"+id).val();
            var amount = $("#amount"+id).val();
			var category_id = $("#category_id"+id).val();
            var recibonum = $("#recibonum"+id).val();
            var notas = $("#notas"+id).val();
            var casas = $("#casas"+id).val();
             var tipo = $("#tipo"+id).val();
             var created_at= $("#created_at"+id).val();

            $("#mod_id").val(id);
            $("#mod_description").val(description);
            $("#mod_amount").val(amount);
			$("#mod_category").val(category_id);
            $("#mod_recibonum").val(recibonum);
            $("#mod_notas").val(notas);
            $("#mod_casas").val(casas);
            $("#mod_tipo").val(tipo);
            $("#mod_created_at").val(created_at);
        }


        // function print
        $("#data_multas").submit(function(e){
            e.preventDefault();
          var daterange = $("#daterange").val();
          var casa = $("#casa").val();
          

         VentanaCentrada('./pdf/documentos/multas_pdf.php?daterange='+daterange+'&casa='+casa,'Gasto','','1024','768','true');
    });

</script>
<script type="text/javascript">
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#daterange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
    }

    $('#daterange').daterangepicker({
        locale: { format: 'DD/MM/YYYY'},
        startDate: start,
        endDate: end,
        ranges: {
     'Hoy': [moment(), moment()],
           'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Ultimos 7 Days': [moment().subtract(6, 'days'), moment()],
           'Ultimos 30 dias': [moment().subtract(29, 'days'), moment()],
           'Este mes': [moment().startOf('month'), moment().endOf('month')],
           'Mes anterior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

});
</script>
