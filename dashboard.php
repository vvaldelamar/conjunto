<!--Google -->
<link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">

<?php 
    $title ="Dashboard - "; 
    include "head.php";
	$active1="active";
        include("funciones.php");
        
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

        
        if (!in_array('Dashboard',$_SESSION['modulos'])) {
                #print_r($_SESSION['modulos']);
                 header("location: index.php");
                exit;
             }

?>
<?php 
       $expenses = mysqli_query($con, "select sum(amount) as amount from expenses");
       $income = mysqli_query($con, "select sum(deposito) as amount from base");
       $mensual = mysqli_query($con, "select (sum(ROUND(mensualidades,2))+ sum(ROUND(recargo,2)) )-sum(ROUND(depositos,2))AS amount FROM saldos");
       $saldoini = mysqli_query($con, "select (sum(ROUND(mens,2))+ sum(ROUND(recargo,2)) )-sum(ROUND(deposito,2))AS amount FROM base_historica");      
?> 

<script>

function numberWithCommas(x) {
    return new Intl.NumberFormat('es-MX', {  maximumFractionDigits: 2}).format(x);
}

var income=<?php foreach ($income as $key2) { ?> <?php echo $key2['amount']; ?> <?php } ?>;
var expenses=<?php foreach ($expenses as $key) { ?> <?php echo $key['amount']; ?><?php } ?>;
var saldoini = <?php foreach ($saldoini as $key2) { ?><?php echo $key2['amount']; ?><?php } ?>;
var saldoactual= <?php foreach ($mensual as $key2) { ?> <?php echo $key2['amount']; ?><?php }?>;
</script>

	<div class="right_col" role="main">
         
            <div class="row">

                <div class="x_panel">
            
                                        <div class="col-md-3 col-sm-6">
                                                        <div class="counter green abajo">
                                                                        <h2 class="counter-value no-margin income">                                                                          
                                                                        </h2>
                                                                        <h3>INGRESO TOTAL.</h3>
                                                                <div class="media-center media-middle">
                                                                        <i class="icon-piggy-bank icon-3x opacity-75"></i>
                                                                </div>
                                                        </div>
                                         </div>


					                    <div class="col-md-3 col-sm-6">
                                                        <div class="counter cgreen">
                                                                        <h2 class="counter-value no-margin expenses">
                                                                        </h2>
                                                                        <h3>GASTOS TOTALES.</h3>
                                                                <div class="media-center media-middle">
                                                                        <i class="icon-bag icon-3x opacity-75"></i>
                                                                </div>
                                                        </div>
                                        </div>




                                        <div class="col-md-3 col-sm-6">
                                                        <div class="counter blue">
                                                                        <h2 class="counter-value no-margin saldo_inicial">
                                                                        </h2>
                                                                        <h3>SALDO INICIAL.</h3>
                                                                        <div class="media-center media-middle">
                                                                                <i class="icon-cash3 icon-3x opacity-75"></i>
                                                                        </div>
                                                        </div>                                                
                                        </div>



                                        <div class="col-md-3 col-sm-6">
                                                        
                                                                <div class="counter">
                                                                        <h2 class="counter-value no-margin saldo_actual">                                                                                  
                                                                        </h2>
                                                                        <h3>SALDO ACTUAL.</h3>
                                                                                <div class="media-center media-middle">
                                                                                <i class="icon-coins icon-3x opacity-75"></i>
                                                                        </div>
                                                                </div>

                                                        
                                                        
                                                </div>
    </div>
          
        <div class="x_panel">   
            <div class="">
                 <div class="col-md-3 col-sm-6">
                    <span class='zoom' id='ex1'>
                    <img class="img-responsive" src="pie_resumen_total_6.png" width="960" height="640"/>
                    </span>
                 </div>
                 <div class="col-md-3 col-sm-6">
                    <span class='zoom' id='ex2'>
                    <img class="img-responsive" src="bar_pag_total_2.png" width="960" height="640"/>
                    </span>
                 </div>      
                 <div class="col-md-3 col-sm-6">      
                    <span class='zoom' id='ex3'>
                    <img class="img-responsive" src="bar_pag_total_3.png" width="960" height="640"/>
                    </span>
                 </div>
                 <div class="col-md-3 col-sm-6">
                    <span class='zoom' id='ex4'>
                    <img class="img-responsive" src="bar_pagos5_tarjeta_4.png" width="458" height="458"/>
                    </span>
                 </div>
                 <div class="col-md-6 col-sm-6">
                    <span class='zoom' id='ex5'>
                    <img class="img-responsive center" src="bar_pagos_excelente1_5.png" width="748" height="480"/>
                    </span>
                 </div>
                 <div class="col-md-3 col-sm-6">
                    <span class='zoom' id='ex6'>
                    <img class="img-responsive" src="bar_pagos5_1.png" width="458" height="458"/>
                    </span>
                 </div>
                 <div class="col-md-3 col-sm-6">
                    <span class='zoom' id='ex7'>
                    <img class="img-responsive" src="pie_resumen_egresos_1.png" width="458" height="458"/>
                    </span>
                 </div>                   
            </div>
        </div>
    </div>
</div>

<?php include "footer.php" ?>


<style>

	/* styles unrelated to zoom */
    * { border:0; margin:0; padding:0; }
		p { position:absolute; top:3px; right:28px; color:#555; font:bold 13px/1 sans-serif;}

		/* these styles are for the demo, but are not required for the plugin */
		.zoom {
			display:inline-block;
			position: relative;
		}
		
		/* magnifying glass icon */
		.zoom:after {
			content:'';
			display:block; 
			width:33px; 
			height:33px; 
			position:absolute; 
			top:0;
			right:0;
			background:url(icon.png);
		}

		.zoom img {
			display: block;
		}

		.zoom img::selection { background-color: white; }

		#ex2 img:hover { cursor: url(grab.cur), default; }
		#ex2 img:active { cursor: url(grabbed.cur), default; }

.two-columns {
width: 48%;
display: inline-block;
}
.three-columns {
width: 32%;
display: inline-block;
}

/* 1 columna para smartphones */
breakpoint  {
max-width: 100%;
display: inline-block;
}
/* 2 columnas para tablets */
@media (min-width: 420px) {
breakpoint  {
max-width: 48%;
}
}
/* 4 columnas para grandes dispositivos*/
@media (min-width: 760px) {
breakpoint  {
max-width: 24%;
}
}


.imagenes{
background-color: #ffffff;
padding: 5px 1px 5px 1px;
margin:12px;
float:left;
width:auto;
height: auto;	
text-align:center;
}

.counter{
    color: #fff;
    background: linear-gradient(to right bottom, #FFD81B, #f9b12a);
    font-family: 'Dosis', sans-serif;
    text-align: center;
    width: 270px;
    height: 180px;
    padding: 20px 20px 20px;
    margin: 0 auto;
    border-radius: 10px 10px 100px 100px;
    box-shadow: 0 0 15px -5px rgba(0,0,0,0.3);
    overflow: hidden;
    position: relative;
    z-index: 1;
}
.counter:after{
    content: '';
    background-color: #f9b12a;
    height: 100%;
    width: 100%;
    position: absolute;
    left: 0;
    top: 0;
    z-index: -1;
    clip-path: polygon(100% 0, 0% 100%, 100% 100%);
}
.counter .counter-value{
    font-family: 'Dosis', sans-serif;
    font-size: 42px;
    font-weight: 500;
    line-height: 40px;
    margin: 0 0 15px;
    display: block;
}
.counter h3{
    font-family: 'Dosis', sans-serif;
    font-size: 18px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin: 0 0 20px;
}
.counter.green{ background: linear-gradient(to right bottom, #a9dd23, #52C242); }
.counter.green:after{ background: #52C242; }
.counter.cgreen{ background: linear-gradient(to right bottom, #01AD9F, #008888); }
.counter.cgreen:after{ background: #008888; }
.counter.blue{ background: linear-gradient(to right bottom, #00C5EF, #0092f4); }
.counter.blue:after{ background: #0092f4; }
@media screen and (max-width:990px){
    .counter{ margin-bottom: 40px; }
}
</style>

<script>

(function($) {
    
    $.fn.countTo = function(options) {
        // merge the default plugin settings with the custom options
        options = $.extend({}, $.fn.countTo.defaults, options || {});

        // how many times to update the value, and how much to increment the value on each update
        var loops = Math.ceil(options.speed / options.refreshInterval),
            increment = (options.to - options.from) / loops;

        return $(this).each(function() {
            var _this = this,
                loopCount = 0,
                value = options.from,
                interval = setInterval(updateTimer, options.refreshInterval);

            function updateTimer() {
                value += increment;
                loopCount++;
                $(_this).html(value.toFixed(options.decimals));

                if (typeof(options.onUpdate) == 'function') {
                    options.onUpdate.call(_this, value);
                }

                if (loopCount >= loops) {
                    clearInterval(interval);
                    value = options.to;

                    if (typeof(options.onComplete) == 'function') {
                        options.onComplete.call(_this, value);
                    }
                }
            }
        });
    };

    $.fn.countTo.defaults = {
        from: 0,  // the number the element should start at
        to: 100,  // the number the element should end at
        speed: 1000,  // how long it should take to count between the target numbers
        refreshInterval: 100,  // how often the element should be updated
        decimals: 0,  // the number of decimal places to show
        onUpdate: null,  // callback method for every time the element is updated,
        onComplete: null,  // callback method for when the element finishes updating
    };
})(jQuery);



jQuery(function($) {
        $('.saldo_actual').countTo({
            from: 100,
            to:  saldoactual,
            speed: 3000,
            refreshInterval: 50,
            onComplete: function(value) {
                console.debug(this);
                   // Get a NodeList of all .demo elements
                   const demoClasses = document.querySelectorAll('.saldo_actual');
                // Change the text of multiple elements with a loop
                demoClasses.forEach(element => {
                element.textContent ="$ "+ numberWithCommas(saldoactual) ;
                });
            }
        });

        $('.saldo_inicial').countTo({
            from: 100,
            to: saldoini,
            speed: 3000,
            refreshInterval: 50,
            onComplete: function(value) {
                console.debug(this);
                
                 // Get a NodeList of all .demo elements
                 const demoClasses = document.querySelectorAll('.saldo_inicial');
                // Change the text of multiple elements with a loop
                demoClasses.forEach(element => {
                element.textContent ="$ "+ numberWithCommas(saldoini) ;
                });
            }
        });
                   
        $('.expenses').countTo({
            from: 100,
            to: expenses,
            speed: 3000,
            refreshInterval: 50,
            onComplete: function(value) {
                console.debug(this);

                 // Get a NodeList of all .demo elements
                 const demoClasses = document.querySelectorAll('.expenses');
                // Change the text of multiple elements with a loop
                demoClasses.forEach(element => {
                element.textContent ="$ "+ numberWithCommas(expenses) ;
                });
            }
        });


        $('.income').countTo({
            from: 100,
            to: income,
            speed: 3000,
            refreshInterval: 50,
            onComplete: function(value) {
                console.debug(this);

                // Get a NodeList of all .demo elements
                const demoClasses = document.querySelectorAll('.income');
                // Change the text of multiple elements with a loop
                demoClasses.forEach(element => {
                element.textContent ="$ "+ numberWithCommas(income) ;
                });

            }
        });
        

    });
</script>
<script src='https://condominio-web.com/santaanita/js/jquery.zoom.js'></script>
<!--Google -->
<link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">

<script>
		$(document).ready(function(){
			$('#ex1').zoom({ on:'toggle' });
            $('#ex2').zoom({ on:'toggle' });
            $('#ex3').zoom({ on:'toggle' });
            $('#ex4').zoom({ on:'toggle' });
            $('#ex5').zoom({ on:'toggle' });
            $('#ex6').zoom({ on:'toggle' });
            $('#ex7').zoom({ on:'toggle' });
			$('#ex2').zoom({ on:'grab' });
			$('#ex3').zoom({ on:'click' });			 
			$('#ex0').zoom({ on:'toggle' });
		});
	</script>