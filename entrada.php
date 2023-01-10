<?php
$title="Camaras | ";
include "head.php";
$active11="active";

date_default_timezone_set('America/Mexico_City');

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

if (!in_array('Camaras',$_SESSION['modulos'])) {
    #print_r($_SESSION['modulos']);
     header("location: index.php");
    exit;
 }

?>

<html>
<body>
<div class="right_col" role="main">
<div class="">
<div class="row">

<div class="x_panel">
                        <div class="x_title">
                            <h2>Camaras</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>


<div class="col-md-6 col-sm-12 col-xs-12">
<div class="card">



	
	<div class="col-md-6 col-sm-12 col-xs-12">
        <div class="card">

        <video id="video" controls="controls" poster="" src=""></video>

      
        </div>
        </div>



</div>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
    <script>
    if(Hls.isSupported())
    {
        var video = document.getElementById('video');
        var hls = new Hls();
        hls.loadSource('https://condominio-web.com/santaanita/video/ch3.m3u8');
        hls.attachMedia(video);
        hls.on(Hls.Events.MANIFEST_PARSED,function()
        {
            video.play();
        });
    }
    else if (video.canPlayType('application/vnd.apple.mpegurl'))
    {
        video.src = 'https://condominio-web.com/santaanita/video/ch3.m3u8';
        video.addEventListener('canplay',function()
        {
            video.play();
        });
    }
    </script>

<?php include "footer.php" ?>
  </body>
</html>

