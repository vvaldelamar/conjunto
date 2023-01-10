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

	if (empty($_POST['mod_name'])) {
           $errors[] = "Nombre vacío";
        }else if (empty($_POST['mod_email'])){
			$errors[] = "Correo Vacio vacío";
		} else if ($_POST['mod_status']==""){
			$errors[] = "Selecciona el estado";
		}else if (
			!empty($_POST['mod_name']) &&
			!empty($_POST['mod_email']) &&
			$_POST['mod_status']!=""
		){

		$name=mysqli_real_escape_string($con,(strip_tags($_POST["mod_name"],ENT_QUOTES)));
		$email=mysqli_real_escape_string($con,(strip_tags($_POST["mod_email"],ENT_QUOTES)));
		$password=mysqli_real_escape_string($con,(strip_tags(sha1(md5($_POST["password"])),ENT_QUOTES)));
		$status=intval($_POST['mod_status']);
		$id=intval($_POST['mod_id']);

		$user_id=intval($_SESSION['user_id']);
		$read_only = mysqli_query($con, "SELECT count(*) AS numrows FROM user WHERE id=$user_id AND is_ready=1");
        $row= mysqli_fetch_array($read_only);
        $numrows = $row['numrows'];	

			if ($numrows>0)
			{ $errors []= "No tienes permisos para hacer cambios."; }
				else
				{	
					$sql="UPDATE user SET status=$status, name=\"$name\", email=\"$email\" WHERE id=$id";
					$query_update = mysqli_query($con,$sql);
						if ($query_update){
							$messages[] = "Datos actualizados satisfactoriamente.";

							// update password
							if($_POST["password"]!=""){
								$update_passwd=mysqli_query($con,"update user set password=\"$password\" where id=$id");
								if ($update_passwd) {
									$messages[] = " y la Contraseña ha sido actualizada.";
								}
							}

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
