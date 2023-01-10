<?php 
    $title ="Mi cuenta - "; 
    include "head.php";
    
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

    if (!in_array('Profile',$_SESSION['modulos'])) {
        #print_r($_SESSION['modulos']);
         header("location: index.php");
        exit;
     }
?>

    <div class="right_col" role="main"> <!-- page content -->
        <div class="">
            <div class="page-title">
   <div class="row">
      <div class="col-md-3 col-sm-3 col-xs-12">	
	<div class="row">
     	  <div class="x_panel">
              <div class="x_content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="image view view-first">
						<div id="respuesta">
			   <img class="thumb-image" style="width: 100%; display: block;" src="images/profiles/<?php echo $profile_pic; ?>" alt="image" /> 
						</div>	
					  </div>
                        <span class="btn btn-my-button btn-file">
                            <form method="post" id="formulario" enctype="multipart/form-data">
                            Cambiar Imagen de perfil: <input type="file" name="imagefile" id="imagefile"  accept="image/png, .jpeg, .jpg, image/gif" onchange="GetFileSize();">
                            </form>
                        </span>
                        
                    </div>
                   </div>
		 </div>
             </div>
           </div>
	</div>
 		<div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Información personal</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                            <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                                <?php
							$success=sha1(md5("datos actualizados"));
							if (isset($_GET['success']) && $_GET['success']==$success) {
                                                                ?>
                                                        <div class="alert alert-success" role="alert">
                                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                                <strong>..Bien hecho!</strong> Datos actualizados correctamente.
                                                        </div>
                                                                <?php
                                                        }
                                                ?>
                                <br />
                                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="action/upd_profile.php" method="post">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" name="name" id="first-name" class="form-control col-md-7 col-xs-12" value="<?php echo $name; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Correo electrónico 
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="last-name" name="email" class="form-control col-md-7 col-xs-12" value="<?php echo $email; ?>">
                                        </div>
                                    </div>

                                    <br><br><br>
                                    <h2 style="padding-left: 50px">Cambiar Contraseña</h2>
                            
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Contraseña antigua
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="birthday" name="password" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="**********">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nueva contraseña 
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="birthday" name="new_password" class="date-picker form-control col-md-7 col-xs-12" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Confirmar contraseña nueva
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input id="birthday" name="confirm_new_password" class="date-picker form-control col-md-7 col-xs-12" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-5 col-sm-5 col-xs-12">
                                            <input type="checkbox" name="status" <?php if($status){ echo "checked";}?>> Activo
                                        </label>
                                    </div>
                                    <p class="text-muted text-right">Si desactivas tu cuenta, no podras tener acceso</p>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button type="submit" name="token" class="btn btn-success">Actualizar Datos</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
    </div><!-- /page content -->
    
<?php include "footer.php" ?>
<script>

 function GetFileSize() {
        var fi = document.getElementById("imagefile"); // GET THE FILE INPUT.
        // VALIDATE OR CHECK IF ANY FILE IS SELECTED.
        if (fi.files.length > 0) {
            // RUN A LOOP TO CHECK EACH SELECTED FILE.
            for (var i = 0; i <= fi.files.length - 1; i++) {
                var fsize = fi.files.item(i).size;      // THE SIZE OF THE FILE.
               if( fsize >1048576)
 		 {
          	  $("#respuesta").text('Lo sentimos, pero el archivo es demasiado grande. Selecciona logo de menos de 1MB');
	 	  return false;
		} else upload_image(); 
            }
        }
    }
		function upload_image(){
				
				var inputFileImage = document.getElementById("imagefile");
				var file = inputFileImage.files[0];
				if( (typeof file === "object") && (file !== null) )
				{
					$("#respuesta").text('Cargando archivo...');	
					var data = new FormData();
					data.append('imagefile',file);
					
					
					$.ajax({
						url: "action/upload-profile.php",        // Url to which the request is send
						type: "POST",             // Type of request to be send, called as method
						data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
						contentType: false,       // The content type used when sending data to the server.
						cache: false,             // To unable request pages to be cached
						processData:false,        // To send DOMDocument or non processed data file it is set to false
						success: function(data)   // A function to be called if request succeeds
						{
							$("#respuesta").html(data);
							
						}
					});	
				}
				
				
			}
    </script>
