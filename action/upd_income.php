<script type="text/javascript">

$(document).ready(function () {
 
window.setTimeout(function() {
    $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
        $(this).remove(); 
    });
}, 1000);
 
});
</script>

<?php
    session_start();
    include "../config/config.php";
    if (!isset($_SESSION['user_id'])&& $_SESSION['user_id']==null) {
        header("location: ../");
        exit;
    }
?>


<?php



    if ($_FILES['imagefile2']['size'] != 0 )
        {
                                $target_dir="../images/recibos/";
                                $image_name = uniqid(microtime()).basename($_FILES["imagefile2"]["name"]);
                                $ext = end(explode('.', $image_name));
                                # Encryptamos el nombre del archivo con md5() para evitar que el archivo tenga otra extensi..n y acortamos el nombre con substr()
                                $image_name = substr(md5($image_name), 0, 10);

                                $imageFileType = pathinfo($_FILES["imagefile2"]["name"],PATHINFO_EXTENSION);
                                $imageFileZise=$_FILES["imagefile2"]["size"];
                                $verifyimg = getimagesize($_FILES['imagefile2']['tmp_name']);
                                 # Le devolvemos la extensi..n al archivo
                                $image_name = $image_name .'.'.$ext;
                                $target_file = $target_dir . $image_name;
                                /* Inicio Validacion*/
                                // Allow certain file formats

                                $exts= array('jpg','jpeg','gif','png');
                                $extxs= array('image/jpg','image/jpeg','image/gif','image/png');

                                $ext = strtolower(end(explode('.',$imageFileType)));
                                $extx= strtolower(end(explode('.',$verifyimg['mime'])));

                                // Check image format
                                if (in_array($ext,$exts)===false) {
								$image_name ="";
                                $errors[]= "Lo sentimos, solo se permiten archivos JPG , JPEG, PNG y GIFx.";
                                 }else
                                if (in_array($extx,$extxs)===false){
                                $errors[]= "Lo sentimos, no tiene pinta de JPG , JPEG, PNG y GIF.";
                                 }
                                 else
                                if ($imageFileZise > 1048576) {//1048576 byte=1MB
                                $errors[]= "Lo sentimos, pero el archivo es demasiado grande. Selecciona logo de menos de 1MB";
                                }  else
                                /* Fin Validacion*/
                                if ($imageFileZise>0){ move_uploaded_file($_FILES["imagefile2"]["tmp_name"], $target_file);}
        }


	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_recibonum'])){
			$errors[] = "El recibo  no puede ser vacío";
		}else if (empty($_POST['mod_tipo'])){
			$errors[] = "Selecciona un tipo";
		}else if (empty($_POST['mod_notas'])){
			$errors[] = "La descripción no puede ser vacío";
		} else if ($_POST['mod_category']==""){
			$errors[] = "Selecciona una categoria";
		} else if ($_POST['mod_fecha_pago']==""){
			$errors[] = "Selecciona una categoria";
		} else if (empty($_POST['mod_amount'])){
			$errors[] = "Cantidad Vacio";
		} else if (
			!empty($_POST['mod_notas']) &&
			!empty($_POST['mod_amount']) &&
			$_POST['mod_category']!="" &&
			$_POST['mod_fecha_pago']!="" &&
			$_POST['mod_tipo']!=""
		){
		 		if ($image_name =="")	$image_name=mysqli_real_escape_string($con,(strip_tags($_POST["mod_image"],ENT_QUOTES)));
                
				$ordenante=mysqli_real_escape_string($con,(strip_tags($_POST["mod_ordena"],ENT_QUOTES)));
     		    $description=mysqli_real_escape_string($con,(strip_tags($_POST["mod_notas"],ENT_QUOTES)));
                $amount=floatval($_POST['mod_amount']);
                $category=intval($_POST['mod_category']);
                $fecha_pago=mysqli_real_escape_string($con,(strip_tags($_POST["mod_fecha_pago"],ENT_QUOTES)));
                $tipo=mysqli_real_escape_string($con,(strip_tags($_POST["mod_tipo"],ENT_QUOTES)));
                $recibonum=mysqli_real_escape_string($con,(strip_tags($_POST["mod_recibonum"],ENT_QUOTES)));
                $id=intval($_POST['mod_id']);
		
				$user_id=intval($_SESSION['user_id']);
				$read_only = mysqli_query($con, "SELECT count(*) AS numrows FROM user WHERE id=$user_id AND is_ready=1");
				$row= mysqli_fetch_array($read_only);
				$numrows = $row['numrows'];	

				if ($numrows>0)
				{ $errors []= "No tienes permisos para hacer cambios."; }
					else
					{
						$sql="UPDATE base SET notas=\"$description\",deposito=$amount,category_id=$category,fecha_pago=\"$fecha_pago\",tipo=\"$tipo\",ordenante=\"$ordenante\",recibonum=\"$recibonum\",imagen=\"$image_name\" WHERE id_tabla=$id";
						$query_update = mysqli_query($con,$sql);
							if ($query_update){
								$messages[] = "EL ingreso ha sido actualizado satisfactoriamente.";
							} else{
								$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
							}
					}		
		} else {$errors []= "Error desconocido.";}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>
