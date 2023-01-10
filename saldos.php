<?php
    $title ="Saldos | ";
    include "head.php";
	$active9="active";
    
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
    if (!in_array('Saldos',$_SESSION['modulos'])) {
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
                      //  include("modal/new_saldos.php");
                      //  include("modal/upd_saldos.php");
                    ?>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Estados de cuenta</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="imprimir-link"><i class="fa fa-print"></i></a>
                                </li>
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>



                        <!-- form print -->
                        <form class="form-horizontal" role="form" id="data_saldos">
                             <div class="form-group row">
                                <input type="hidden" class="form-control" id="name_user" value="<?php echo $name; ?>">
                                    <div class="col-md-3 pull-left">
                                       <input type="text" class="form-control" id="daterange" name="daterange" value="<?php echo "01/01/2014 - ".date("d/m/Y");?>" onchange="load(1);">
                                    </div>
                                    <div class="col-md-3 pull-left">
                                        <select class="form-control" id="casa" name="casa" onchange="load(1);" required>
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script type="text/javascript" src="js/saldos.js"></script>
<script type="text/javascript" src="js/VentanaCentrada.js"></script>

<style>
  .table.dataTable  {
    font-family: "Helvetica Neue",Roboto,Arial,"Droid Sans",sans-serif;
    font-size: 12px;
}

            h2{
                font-family: 'Dosis', sans-serif;
            }
            .counter-value{
                font-size: 26px;
                font-family: 'Dosis', sans-serif;
                font-weight: 600;
                line-height: 40px;
                margin: 0 0 5px;
                display: block;
            }
            h3{
                font-size: 18px;
                font-family: 'Dosis', sans-serif;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 1px;
                margin: 0 0 20px;
            }
  
</style>
<script>


  $(document).ready(function(){

    $(".imprimir-link").on("click",function(){
        var daterange = $("#daterange").val();
        var casa = $("#casa").val();
        VentanaCentrada('./pdf/documentos/saldos_pdf.php?daterange='+daterange+'&casa='+casa,'Gasto','','1024','768','true');
        });

     });



  $( "#add_saldos" ).submit(function( event ) {
  $('#save_data').attr("disabled", true);

 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/add_saldos.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result_saldos").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result_saldos").html(datos);
            $('#save_data').attr("disabled", false);
            load(1);
          }
    });
  event.preventDefault();
})

// success

$( "#upd_saldos" ).submit(function( event ) {
  $('#upd_data').attr("disabled", true);

 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/upd_saldos.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result_saldos2").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result_saldos2").html(datos);
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
            var fecha_pago= $("#fecha_pago"+id).val();

            $("#mod_id").val(id);
            $("#mod_description").val(description);
            $("#mod_amount").val(amount);
            $("#mod_category").val(category_id);
            $("#mod_recibonum").val(recibonum);
            $("#mod_notas").val(notas);
            $("#mod_casas").val(casas);
            $("#mod_tipo").val(tipo);
            $("#mod_fecha_pago").val(fecha_pago);
        }

</script>
<script type="text/javascript">
$(function() {

    $('input[name="daterange"]').daterangepicker({
                 locale: {
      format: 'DD/MM/YYYY',
          "applyLabel": "Aplicar",
          "cancelLabel": "Cancelar",
          "daysOfWeek": [
            "Do",
            "Lu",
            "Ma",
            "Mi",
            "Ju",
            "Vi",
            "Sa"
        ],
       "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ],
    }
        });
});
</script>
