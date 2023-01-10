<?php
    $title ="Ingresos | ";
    include "head.php";
	$active3="active";
    

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

    if (!in_array('Ingresos',$_SESSION['modulos'])) {
        #print_r($_SESSION['modulos']);
         header("location: index.php");
        exit;
     }
?>


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

    <div class="right_col" role="main"> <!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php
                        include("modal/new_income2.php");
                        include("modal/upd_income.php");
                    ?>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Ingresos</h2>
                            <ul class="nav navbar-right panel_toolbox">
				<li><a class="imprimir-excel"><i class="fa fa-file-excel-o"></i></a>
				<li><a class="imprimir-link"><i  class="fa fa-file-pdf-o"></i></a>
                                </li>
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
        
                        <!-- form print -->
                        <form class="form-horizontal" role="form" id="data_income">
                             <div class="form-group row">
                                   <input type="hidden" class="form-control" id="name_user" value="<?php echo $name; ?>">
                                    <div class="col-md-3 pull-left">
                                       <input type="text" class="form-control" id="daterange" name="daterange" value="<?php echo "01/".date("m/Y")." - ".date("d/m/Y");?>" onchange="load(1);">
                                    </div>
				     <div class="col-md-3 pull-left">
                                        <select class="form-control" id="casa" name="casa" onchange="load(1);">
                                        <option selected="" value="null">-- Imprimir por Propietario --</option>
                                            <?php
                                            $categories = mysqli_query($con,"select * from personas");
                                            while ($cat=mysqli_fetch_array($categories)) { ?>
                                            <option value="<?php echo $cat['casa']; ?>"><?php echo $cat['referencia']; ?> <?php echo $cat['propietario']; ?> <?php echo $cat['casa']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div> 
									<div class="col-md-3 pull-left">
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
<script type="text/javascript" src="js/income.js"></script>
<script type="text/javascript" src="js/VentanaCentrada.js"></script>
<script>


$(document).ready(function(){


    $(".imprimir-excel").on("click",function(){
         var daterange = $("#daterange").val();
         var casa = $("#casa").val();
         VentanaCentrada('./pdf/documentos/income_excel.php?daterange='+daterange+'&casa='+casa,'Gasto','','1024','768','true');

        });
  
    $(".imprimir-link").on("click",function(){
         var daterange = $("#daterange").val();
         var casa = $("#casa").val();
         VentanaCentrada('./pdf/documentos/income_pdf.php?daterange='+daterange+'&casa='+casa,'Gasto','','1024','768','true');

	});

   $("#myBtn").click(function(){
    $("#myModal").modal("show");
       });

  $("#myModal").on('hidden.bs.modal', function(){
    $('input[type=file]').val(null);
    $("#load_img").text('');
  });

 $("#myModal2").on('hidden.bs.modal', function(){
    $('input[type=file]').val(null);
    $("#load_img").text('');
  });

	$('#imagefile').change(function(){
               var fp = $("#imagefile");
               var lg = fp[0].files.length; // get length
               var items = fp[0].files;
               var fileSize = 0;

           if (lg > 0) {
               for (var i = 0; i < lg; i++) {
                   fileSize = fileSize+items[i].size; // get file size
               }
               if(fileSize > 1048576) {
                    alert('Lo sentimos, pero el archivo es demasiado grande. Selecciona una imagen de menos de 1MB');
                    $('#imagefile').val('');
               }
           }
        });


      $('#imagefile2').change(function(){


	        $('.link').hide();
                $('.cerrar').hide();

               var fp = $("#imagefile2");
               var lg = fp[0].files.length; // get length
               var items = fp[0].files;
               var fileSize = 0;

           if (lg > 0) {
               for (var i = 0; i < lg; i++) {
                   fileSize = fileSize+items[i].size; // get file size
               }
               if(fileSize > 1048576) {
                    alert('Lo sentimos, pero el archivo es demasiado grande. Selecciona una imagen de menos de 1MB');
                    $('#imagefile2').val('');
               }
           }
        }); 

        $('#cerrar').click(function(){

	$(".link").removeAttr('href');
        $('.link').hide();
	$("#mod_image").val('');
	$('.cerrar').hide();

        });

});

function getval(sel)
{
	$('select[name=ref]').val(sel.value);
}

function getvalr(sel)
{
        $('select[name=casa]').val(sel.value);
}


$ordenante='';
$ord_name='';
$licuado='null';

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

  var target = $(e.target).attr("href") // activated tab
  $('select[name=casa]').val($ordenante);
  $('select[name=ref]').val($ordenante);
  $("#ord_name").val($ord_name);
});


$(document).ready(function () {

   $('#example tbody').on( 'click', 'tr', function () {
    var table = $('#example').DataTable();
    var lista = table.row( this ).data();
    console.log( lista[6] );
   
     $ordenante=lista[0];
     $ord_name=lista[6];  
         var events = $('#events');
		$('#events').empty().append('<div>La casa seleccionada es: '+ lista[0] + ', El ordenante es : '+ lista[6] +' row(s) selected</div>') 
        } );

    $('#example').DataTable({
	 "pagingType": "simple",
	 "lengthMenu": [ 5, 7, 10],
        initComplete: function () {
            var api = this.api();
            api.$('td').click(function () {
            api.search(this.innerHTML).draw();
            });
        }

    });
	// Muestra el tab
  //  $('[href="#settings"]').tab('show');


});


  $("#add_income").submit(function( event ) {
  $('#save_data').attr("disabled", true);


 var parametros = $(this).serialize();
 var formData = new FormData($("#add_income")[0]); 
     $.ajax({
            type: "POST",
            url: "action/add_income.php",
	   data:formData,
	    contentType: false,
            cache: false,
            processData:false,
             beforeSend: function(objeto){
                $("#result_income").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result_income").html(datos);
            $('#save_data').attr("disabled", false);
	    $("#load_img").text('');
            document.getElementById("add_income").reset();
            load(1);
          }
    });
  event.preventDefault();
})

// success

$( "#upd_income" ).submit(function( event ) {
$('#upd_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
 var formData = new FormData($("#upd_income")[0]); 
 var delay = 2600;
     $.ajax({
            type: "POST",
            url: "action/upd_income.php",
            data: formData,
	    contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(objeto){
                $("#result_income2").html("Mensaje: Cargando...");
              },
            success: function(datos){

            $("#result_income2").html(datos);
            $('#upd_data').attr("disabled", false); 

             setTimeout(function() {
               $('#myModal').modal('hide'); 
		}, delay);

	    $("#load_img").text('');
	    $('input[type=file]').val(null);
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
	    var ordenante=$("#ordenante"+id).val();
	    var image=$("#image"+id).val();

            $("#mod_id").val(id);
            $("#mod_description").val(description);
            $("#mod_amount").val(amount);
	    $("#mod_category").val(category_id);
            $("#mod_recibonum").val(recibonum);
            $("#mod_notas").val(notas);
            $("#mod_casas").val(casas);
            $("#mod_tipo").val(tipo);
            $("#mod_fecha_pago").val(fecha_pago);
	    $("#mod_ordena").val(ordenante);
	    $("#mod_image").val(image);

           if(image.trim().length == 0){
		$(".link").removeAttr('href');
		$('.link').hide();
		$('.cerrar').hide();
		 }
	    else
               {
	      $('.link').show();
	      $('.cerrar').show();
              $(".link").attr("href","https://condominio-web.com/santaanita/images/recibos/"+image);
	      $('.link').text(image);
		}

        }



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
