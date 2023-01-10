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

  if ($_FILES['imagefile']['size'] != 0 )
  {
                                $target_dir="../images/recibos/";
                                $image_name = uniqid(microtime()).basename($_FILES["imagefile"]["name"]);
                                $ext = end(explode('.', $image_name));
                                # Encryptamos el nombre del archivo con md5() para evitar que el archivo tenga otra extensi..n y acortamos el nombre con substr()
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
				$image_name = "";
                                $errors[]= "Lo sentimos, solo se permiten archivos JPG , JPEG, PNG y GIF.";
                                 }else
                                if (in_array($extx,$extxs)===false){
                                $errors[]= "Lo sentimos, no tiene pinta de JPG , JPEG, PNG y GIF.";
                                 }
                                 else
                                if ($imageFileZise > 1048576) {//1048576 byte=1MB
                                $errors[]= "Lo sentimos, pero el archivo es demasiado grande. Selecciona logo de menos de 1MB";
                                }  else
                                /* Fin Validacion*/
                                if ($imageFileZise>0){ move_uploaded_file($_FILES["imagefile"]["tmp_name"], $target_file);}
	}

	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['date'])) {
           $errors[] = "Fecha vacío";
        } else if (empty($_POST['recibonum'])){
			$errors[] = "Número de recibo no debe estar vacío";
		} else if (empty($_POST['description'])){
			$errors[] = "Description vacío";
		}
		else if ($_POST['category']==""){
			$errors[] = "Selecciona la categoria";
		} else if (empty($_POST['amount'])){
			$errors[] = "Cantidad vacío";
		} else if (
			!empty($_POST['date']) &&
			!empty($_POST['recibonum']) &&
			$_POST['tipo_trans']!="" &&
			!empty($_POST['description']) &&
			$_POST['casa']!="" &&
			$_POST['category']!="" &&
			!empty($_POST['amount'])
		){
				
 		$id_pago="PAG";
                $casa=mysqli_real_escape_string($con,(strip_tags($_POST['casa'],ENT_QUOTES)));
                $tipo_trans=mysqli_real_escape_string($con,(strip_tags($_POST['tipo_trans'],ENT_QUOTES)));      
				$recibonum=mysqli_real_escape_string($con,(strip_tags($_POST['recibonum'],ENT_QUOTES)));
                $description=mysqli_real_escape_string($con,(strip_tags($_POST["description"],ENT_QUOTES)));
                $amount=floatval($_POST['amount']);
                $upload_receipt="iimg.png";
                $category=intval($_POST['category']);
                $date_added=mysqli_real_escape_string($con,(strip_tags($_POST['date'],ENT_QUOTES))); 
                $user_id=intval($_SESSION['user_id']);
                $fecha_mens= date("Y-m-d");
				$ord_namew=mysqli_real_escape_string($con,(strip_tags($_POST['ord_name'],ENT_QUOTES)));

				$sql_personas = mysqli_query($con, "select * from personas where casa='$casa'");
				if($c=mysqli_fetch_array($sql_personas)) {
					$propietario=$c['propietario'];
					$correo=$c['correo'];
					$referencia=$c['referencia'];
					}
	 	
		$read_only = mysqli_query($con, "SELECT count(*) AS numrows FROM user WHERE id=$user_id AND is_ready=1");
        $row= mysqli_fetch_array($read_only);
        $numrows = $row['numrows'];

		if ($numrows>0)
						{ $errors []= "No tienes permisos para hacer cambios."; }
						else
						{	
							$sql="INSERT INTO base (id,casa,fecha_mens,fecha_pago,deposito,notas,tipo,recibonum,nombre,correo,refencia,user_id,category_id,ordenante,imagen) VALUES (\"$id_pago\",\"$casa\",\"$fecha_mens\",\"$date_added\",$amount,\"$description\",\"$tipo_trans\",\"$recibonum\",\"$propietario\",\"$correo\",\"$referencia\",$user_id,$category,\"$ord_namew\",\"$image_name\")";
							$query_new_insert = mysqli_query($con,$sql);
						
								if ($query_new_insert){
									$messages[] = "Tu ingreso ha sido ingresado satisfactoriamente.";

								} else{
									$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
								}
						}		
		} else {
			$errors []= "Error desconocido.";
		}
		
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
						<button type="button" class="close" data-dismiss="alert">&times;</button>
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
