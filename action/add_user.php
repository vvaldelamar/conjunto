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
	if (empty($_POST['name'])) {
           $errors[] = "Nombre vacío";
        } else if (empty($_POST['lastname'])){
			$errors[] = "Apellidos vacío";
		}else if (empty($_POST['email'])){
			$errors[] = "Correo Vacio vacío";
		} else if ($_POST['status']==""){
			$errors[] = "Selecciona el estado";
		} else if (empty($_POST['password'])){
			$errors[] = "Contraseña vacío";
		} else if (
			!empty($_POST['name']) &&
			!empty($_POST['lastname']) &&
			$_POST['status']!="" &&
			!empty($_POST['password'])
		){

		// escaping, additionally removing everything that could be (html/javascript-) code
		$name=mysqli_real_escape_string($con,(strip_tags($_POST["name"],ENT_QUOTES)));
		$lastname=mysqli_real_escape_string($con,(strip_tags($_POST["lastname"],ENT_QUOTES)));
		$email=mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
		$password=mysqli_real_escape_string($con,(strip_tags(sha1(md5($_POST["password"])),ENT_QUOTES)));
		$status=intval($_POST['status']);
		$end_name=$name." ".$lastname;
		$created_at=date("Y-m-d H:i:s");
		$user_id=intval($_SESSION['user_id']);
		$profile_pic="default.png";
		$is_admin=0;

		$read_only = mysqli_query($con, "SELECT count(*) AS numrows FROM user WHERE id=$user_id AND is_ready=1");
        $row= mysqli_fetch_array($read_only);
        $numrows = $row['numrows'];

					if ($numrows>0)
						{ $errors []= "No tienes permisos para hacer cambios."; }
						else
						{	
								if(isset($_POST["is_admin"])){$is_admin=1;}

									$sql="INSERT INTO user (status, name, password, email, profile_pic, is_admin, created_at) VALUES ($status,'$end_name','$password','$email','$profile_pic',$is_admin,'$created_at')";
									$query_new_insert = mysqli_query($con,$sql);
										if ($query_new_insert){
											$messages[] = "El usuario ha sido ingresado satisfactoriamente.";
										} else{
											$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
										}
						}
		} else
		{ $errors []= "Error desconocido.";}
		
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
