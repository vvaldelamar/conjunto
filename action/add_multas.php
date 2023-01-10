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
	session_start();
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['date'])) {
           $errors[] = "Fecha vacío";
        } else if (empty($_POST['description'])){
			$errors[] = "Description vacío";
		}
		else if ($_POST['category']==""){
			$errors[] = "Selecciona la categoria";
		} else if (empty($_POST['amount'])){
			$errors[] = "Cantidad vacío";
		} else if (
			!empty($_POST['date']) &&
			!empty($_POST['description']) &&
			$_POST['casa']!="" &&
			$_POST['category']!="" &&
			!empty($_POST['amount'])
		){
				
		$id_pago="MUL";
 		$casa=mysqli_real_escape_string($con,(strip_tags($_POST["casa"],ENT_QUOTES)));
                $description=mysqli_real_escape_string($con,(strip_tags($_POST["description"],ENT_QUOTES)));
                $amount=floatval($_POST['amount']);
                $upload_receipt="iimg.png";
                $category=intval($_POST['category']);
                $date_added=mysqli_real_escape_string($con,(strip_tags($_POST["date"],ENT_QUOTES)));
                $user_id=intval($_SESSION['user_id']);
                $fecha_mens= date("Y-m-d");

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
								$sql="INSERT INTO base (id,casa,fecha_mens,mens,notas,nombre,correo,refencia,user_id,category_id) VALUES (\"$id_pago\",\"$casa\",\"$date_added\",$amount,\"$description\",\"$propietario\",\"$correo\",\"$referencia\",$user_id,$category)";
								$query_new_insert = mysqli_query($con,$sql);
							
									if ($query_new_insert){
										$messages[] = "Tu Multa ha sido ingresado satisfactoriamente.";
									} else{
										$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
									}
							}
	} else { $errors []= "Error desconocido.";	}
	
		
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
