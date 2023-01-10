<?php
    session_start();
    include "../config/config.php";
    if (!isset($_SESSION['user_id'])&& $_SESSION['user_id']==null) {
        header("location: index.php");
        exit;
    }
?>
	<?php
				if (isset($_FILES["imagefile"])){
			
    				$target_dir="../images/";
       				$image_name = uniqid(microtime()).basename($_FILES["imagefile"]["name"]);
				$ext = end(explode('.', $image_name));
       				# Encryptamos el nombre del archivo con md5() para evitar que el archivo tenga otra extensión y acortamos el nombre con substr()
           			$image_name = substr(md5($image_name), 0, 10);
				
				$imageFileType = pathinfo($_FILES["imagefile"]["name"],PATHINFO_EXTENSION);
				$imageFileZise=$_FILES["imagefile"]["size"];
			        $verifyimg = getimagesize($_FILES['imagefile']['tmp_name']);
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
				$errors[]= "<p>Lo sentimos, solo se permiten archivos JPG , JPEG, PNG y GIF.</p>";
				 }else
				if (in_array($extx,$extxs)===false){
				$errors[]= "<p>Lo sentimos, no tiene pinta de JPG , JPEG, PNG y GIF.</p>";
				 }
				 else 
				if ($imageFileZise > 1048576) {//1048576 byte=1MB
				$errors[]= "<p>Lo sentimos, pero el archivo es demasiado grande. Selecciona logo de menos de 1MB</p>";
				}  else{
				/* Fin Validacion*/
				if ($imageFileZise>0){
					move_uploaded_file($_FILES["imagefile"]["tmp_name"], $target_file);
					$logo_update="val='$image_name' ";
				}else { $logo_update="";}

                    $sql = "UPDATE  configuration SET $logo_update WHERE name='logo';";
                    $query_new_insert = mysqli_query($con,$sql);
                    if ($query_new_insert) {
                        ?>
			<img class="img-responsive" src="images/<?php echo $image_name;?>" alt="Logo">
			<?php
                   	 } else {
                        $errors[] = "Lo sentimos, actualización falló. Intente nuevamente. ".mysqli_error($con);
                    }
		  }
		}	
				
				
				
		
	?>
	<?php 
		if (isset($errors)){
	?>
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Error! </strong>
		<?php
			foreach ($errors as $error){
				echo $error;
			}
		?>
		</div>	
	<?php
			}
	?>
