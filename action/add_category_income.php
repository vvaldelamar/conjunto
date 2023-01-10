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
        } else if (
			!empty($_POST['name']) 
		){

		$name=mysqli_real_escape_string($con,(strip_tags($_POST["name"],ENT_QUOTES)));
		$created_at=date("Y-m-d H:i:s");
		$user_id=intval($_SESSION['user_id']);

		$read_only = mysqli_query($con, "SELECT count(*) AS numrows FROM user WHERE id=$user_id AND is_ready=1");
        $row= mysqli_fetch_array($read_only);
        $numrows = $row['numrows'];
		
			//loop through fetched data
			if ($numrows>0)
			{ $errors []= "No tienes permisos para hacer cambios."; }
			else
			{	
				$sql="INSERT INTO category_income (name, user_id, created_at) VALUES (\"$name\", $user_id, \"$created_at\")";
				$query_new_insert = mysqli_query($con,$sql);
				if ($query_new_insert){
					$messages[] = "Tu categoria ha sido ingresado satisfactoriamente.";
				} else{
					$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
				}
			} 
		}
			else { $errors []= "Error desconocido."; 
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
