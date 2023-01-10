<?php
    $title ="Camaras | ";
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

<html  dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Camaras</title>
<style>
#playlist {  display:table;color: #7e7e7e;}
#playlist li{  cursor:pointer;  padding:0px;}
#splaylist li:hover{color:blue;}
#videoarea {    float:left;    width:100%;    height:430px;    margin:0px; object-fit: node; top: 0; right:0; left: 0;}

.video-js,
.playlist-container {
  position: relative;
  min-width: 460px;
  min-height: 460px;
  height: 0;
  width: 0;
}
.video-js {
  flex: 1 1 0%;
}

</style>
<link href="https://unpkg.com/video.js@7.10.2/dist/video-js.css" rel="stylesheet" />
<link href="https://unpkg.com/videojs-hls-quality-selector@1.1.4/dist/videojs-hls-quality-selector.css" rel="stylesheet" />

</head>
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
                      
                        
                     
                    

<div class="col-md-3 col-sm-3">


  <ul id="playlist">
   <h5 class="card-title"><i class="fa fa-video-camera"></i> Camara entrada de peatones</h5>
   <li movieurl="https://condominio-web.com/santaanita/video/ch1.m3u8">Live</li>
   <?php if (date('G')>14) {  ?> 
   <li movieurl="<?php  echo 'https://condominio-web.com/santaanita/video/output_hilook_'.date('Ymd').'.mp4'; ?>"><?php  echo date('d.m.Y')."\n"; ?></li>
   <?php  }   ?>
   <li movieurl="<?php  echo 'https://condominio-web.com/santaanita/video/output_hilook_'.date('Ymd',strtotime("-1 days")).'.mp4';?>"><?php echo date('d.m.Y',strtotime("-1 days")). "\n";?></li>
   <li movieurl="<?php  echo 'https://condominio-web.com/santaanita/video/output_hilook_'.date('Ymd',strtotime("-2 days")).'.mp4';?>"><?php echo date('d.m.Y',strtotime("-2 days")). "\n";?></li>
   <li movieurl="<?php  echo 'https://condominio-web.com/santaanita/video/output_hilook_'.date('Ymd',strtotime("-3 days")).'.mp4';?>"><?php echo date('d.m.Y',strtotime("-3 days")). "\n";?></li>
   <li movieurl="<?php  echo 'https://condominio-web.com/santaanita/video/output_hilook_'.date('Ymd',strtotime("-4 days")).'.mp4';?>"><?php echo date('d.m.Y',strtotime("-4 days")). "\n";?></li>

   <h5 class="card-title">  <i class="fa fa-video-camera"></i> Camara calle San Cristobal</h5>
   <li movieurl="https://condominio-web.com/santaanita/video/ch4.m3u8">Live</li>
   <?php if (date('G')>14) {  ?> 
   <li movieurl="<?php  echo 'https://condominio-web.com/santaanita/video/output_dahua_01_'.date('Ymd').'.mp4'; ?>"><?php  echo date('d.m.Y')."\n"; ?></li>
   <?php  }   ?>
   <li movieurl="<?php  echo 'https://condominio-web.com/santaanita/video/output_dahua_01_'.date('Ymd',strtotime("-1 days")).'.mp4';?>"><?php echo date('d.m.Y',strtotime("-1 days")). "\n";?></li>
   <li movieurl="<?php  echo 'https://condominio-web.com/santaanita/video/output_dahua_01_'.date('Ymd',strtotime("-2 days")).'.mp4';?>"><?php echo date('d.m.Y',strtotime("-2 days")). "\n";?></li>
   <li movieurl="<?php  echo 'https://condominio-web.com/santaanita/video/output_dahua_01_'.date('Ymd',strtotime("-3 days")).'.mp4';?>"><?php echo date('d.m.Y',strtotime("-3 days")). "\n";?></li>
   <li movieurl="<?php  echo 'https://condominio-web.com/santaanita/video/output_dahua_01_'.date('Ymd',strtotime("-4 days")).'.mp4';?>"><?php echo date('d.m.Y',strtotime("-4 days")). "\n";?></li>


   <h5 class="card-title">  <i class="fa fa-video-camera"></i> Camara entrada vehicular</h5>
   <li movieurl="https://condominio-web.com/santaanita/video/ch3.m3u8">Live</li>
   <?php if (date('G')>14) {  ?> 
   <li movieurl="<?php  echo 'https://condominio-web.com/santaanita/video/output_dahua_02_'.date('Ymd').'.mp4'; ?>"><?php  echo date('d.m.Y')."\n"; ?></li>
   <?php  }   ?>
   <li movieurl="<?php  echo 'https://condominio-web.com/santaanita/video/output_dahua_02_'.date('Ymd',strtotime("-1 days")).'.mp4';?>"><?php echo date('d.m.Y',strtotime("-1 days")). "\n";?></li>
   <li movieurl="<?php  echo 'https://condominio-web.com/santaanita/video/output_dahua_02_'.date('Ymd',strtotime("-2 days")).'.mp4';?>"><?php echo date('d.m.Y',strtotime("-2 days")). "\n";?></li>
   <li movieurl="<?php  echo 'https://condominio-web.com/santaanita/video/output_dahua_02_'.date('Ymd',strtotime("-3 days")).'.mp4';?>"><?php echo date('d.m.Y',strtotime("-3 days")). "\n";?></li>
   <li movieurl="<?php  echo 'https://condominio-web.com/santaanita/video/output_dahua_02_'.date('Ymd',strtotime("-4 days")).'.mp4';?>"><?php echo date('d.m.Y',strtotime("-4 days")). "\n";?></li>


   <h5 class="card-title"> <i class="fa fa-video-camera"></i> Camara PTZ</h5>
   <li movieurl="https://condominio-web.com/santaanita/video/ch2.m3u8">Live</li>
   <?php if (date('G')>14) {  ?> 
   <li movieurl="<?php  echo 'https://condominio-web.com/santaanita/video/output_dahua_03_'.date('Ymd').'.mp4'; ?>"><?php  echo date('d.m.Y')."\n"; ?></li>
   <?php  }   ?>
   <li movieurl="<?php  echo 'https://condominio-web.com/santaanita/video/output_dahua_03_'.date('Ymd',strtotime("-1 days")).'.mp4';?>"><?php echo date('d.m.Y',strtotime("-1 days")). "\n";?></li>
   <li movieurl="<?php  echo 'https://condominio-web.com/santaanita/video/output_dahua_03_'.date('Ymd',strtotime("-2 days")).'.mp4';?>"><?php echo date('d.m.Y',strtotime("-2 days")). "\n";?></li>
   <li movieurl="<?php  echo 'https://condominio-web.com/santaanita/video/output_dahua_03_'.date('Ymd',strtotime("-3 days")).'.mp4';?>"><?php echo date('d.m.Y',strtotime("-3 days")). "\n";?></li>
   <li movieurl="<?php  echo 'https://condominio-web.com/santaanita/video/output_dahua_03_'.date('Ymd',strtotime("-4 days")).'.mp4';?>"><?php echo date('d.m.Y',strtotime("-4 days")). "\n";?></li>
</ul>
</div>


<div class="col-md-3 col-sm-6">
                        <video-js id="my_player" class="video-js vjs-controls-enabled vjs-workinghover vjs-v6 vjs-has-started vjs_video_3-dimensions vjs-playing"  poster="https://condominio-web.com/santaanita/images/video.jpg" controls>
                        </video-js>
                        </div>

</div>
</div>

</div>
</div>
<?php include "footer.php" ?>

                <!--This is for Video.js by itself -->
                <script src="https://unpkg.com/video.js@7.10.2/dist/video.js"></script>
                <script src="https://unpkg.com/videojs-contrib-quality-levels@2.0.9/dist/videojs-contrib-quality-levels.min.js"></script>
                <script src="https://unpkg.com/videojs-hls-quality-selector@1.1.4/dist/videojs-hls-quality-selector.min.js"></script>

                <!--This is for HLS compatibility with all major browsers-->
                <script src="https://unpkg.com/@videojs/http-streaming@2.4.1/dist/videojs-http-streaming.min.js"></script>
     
<script type="text/javascript">
     var player = videojs('my_player');

$(function(){
    $("#playlist li").on("click", function() {

        player.src($(this).attr("movieurl"))
        player.play();
        

    })
    $("#videoarea").attr({
        "src": $("#playlist li").eq(0).attr("movieurl"),
        "poster": $("#playlist li").eq(0).attr("moviesposter")
    })

 
})
</script>
</body>
</html>
