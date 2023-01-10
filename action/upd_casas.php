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


	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_casa'])){
			$errors[] = "La casa no puede ser vacío";
		} else if ($_POST['mod_propietario']==""){
			$errors[] = "Selecciona un propietario";
		} else if ($_POST['mod_correo']==""){
			$errors[] = "Selecciona un correo";
		} else if (empty($_POST['mod_telefono1'])){
			$errors[] = "El telefono no puede ir vacío";
		} else if (
			$_POST['mod_tarjeta']!=""
			){
				
		$correo=mysqli_real_escape_string($con,(strip_tags($_POST["mod_correo"],ENT_QUOTES)));
		$correo_sec=mysqli_real_escape_string($con,(strip_tags($_POST["mod_correo_sec"],ENT_QUOTES)));
		$correo= $correo . ";". $correo_sec;
        $tarjeta=intval($_POST['mod_tarjeta']);
		$telefono1=mysqli_real_escape_string($con,(strip_tags($_POST['mod_telefono1'],ENT_QUOTES)));;
		$telefono2=mysqli_real_escape_string($con,(strip_tags($_POST['mod_telefono2'],ENT_QUOTES)));;
		$id=intval($_POST['mod_id']);	

		$user_id=intval($_SESSION['user_id']);
		$read_only = mysqli_query($con, "SELECT count(*) AS numrows FROM user WHERE id=$user_id AND is_ready=1");
        $row= mysqli_fetch_array($read_only);
        $numrows = $row['numrows'];	

			if ($numrows>0)
			{ $errors []= "No tienes permisos para hacer cambios."; }
				else
				{		

					$sql="UPDATE personas SET correo=\"$correo\",tarjetas=\"$tarjeta\",telefono1=\"$telefono1\",telefono2=\"$telefono2\" WHERE id=$id";
					$query_update = mysqli_query($con,$sql);
						if ($query_update){
							$messages[] = "La casa ha sido actualizado satisfactoriamente.";
						} else{
							$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
						}
				}		
		} else { 	$errors []= "Error desconocido.";	}
		
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
