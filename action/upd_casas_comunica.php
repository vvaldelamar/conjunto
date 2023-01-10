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

		if (empty($_POST['mod_asunto'])) {
           $errors[] = "Escribe un asunto";
	    }
		else
		if (empty($_POST['mod_body'])) {
		   $errors[] = "Escribe una Descripcion";}
		else
		if (
			!empty($_POST['mod_asunto']) &&
			!empty($_POST['mod_body']) &&
			$_POST['mod_asunto']!="" &&
			$_POST['mod_body']!="" 
		)  {
			
			
			$asunto=mysqli_real_escape_string($con,(strip_tags($_POST['mod_asunto'],ENT_QUOTES)));
			$body=mysqli_real_escape_string($con,(strip_tags($_POST['mod_body'],ENT_QUOTES)));

			$user_id=intval($_SESSION['user_id']);
			$read_only = mysqli_query($con, "SELECT count(*) AS numrows FROM user WHERE id=$user_id AND is_ready=1");
			$row= mysqli_fetch_array($read_only);
			$numrows = $row['numrows'];	

			if ($numrows>0)
			{ $errors []= "No tienes permisos para hacer cambios."; }
				else
				{	
					$sql="UPDATE configuration SET name=\"$asunto\",val=\"$body\",cfg_id=1 WHERE label=\"Correo\"";
					$query_update = mysqli_query($con,$sql);
						if ($query_update){
							$messages[] = "Se realizo el envio del comunicado satisfactoriamente.";
						} else{
							$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
						}
				}		
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
