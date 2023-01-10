<?php

	session_start();
        //validacion de CSRF , modificacion de autenticacion para openshift

     	if (isset($_POST['g-recaptcha-response']) &&  ( hash_equals($_SESSION['tokens'],$_POST['anticsrf']) ))	
	{	
 	unset($_SESSION['tokens']);	

	$url = 'https://www.google.com/recaptcha/api/siteverify';
	$data = array('secret' => '6LdYG-EfAAAAAMGG2KQATC1w6JKVRyyotFWwzyVY', 'response' => $_POST['g-recaptcha-response']);
 
	$verify = curl_init();
	curl_setopt($verify, CURLOPT_URL, $url);
	curl_setopt($verify, CURLOPT_POST, true);
	curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($verify);
	$responseData = json_decode($response);
	

	if($responseData->success)
	 {

	if (isset($_POST['token']) && $_POST['token']!=='') {

        //Contiene las variables de configuracion para conectar a la base de datos
        include "../config/config.php";

        $email=mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
        $password=sha1(md5(mysqli_real_escape_string($con,(strip_tags($_POST["password"],ENT_QUOTES)))));

        $query = mysqli_query($con,"SELECT * FROM user WHERE email = '" . $email . "' AND password = '" . $password . "';");
		$query_roles = mysqli_query($con,"SELECT b.modulo as modulo FROM user a , modulos b  WHERE a.is_admin = b.id AND email = '" . $email . "' AND password = '" . $password . "';");

								$arr_mod= [];
								
						while($roles = mysqli_fetch_array($query_roles))	{ $arr_mod[]= $roles['modulo']; }
							
										
                        if ($row = mysqli_fetch_array($query)) {
                        if ($row['status']==1) { //comprobamos que el usuario este activo
																				
                                $_SESSION['user_id'] = $row['id'];
								$_SESSION['perfil'] = $row['is_admin'];
								$_SESSION['modulos']= $arr_mod;
								header("location: ../dashboard.php");

                        }else{
                                $error=sha1(md5("cuenta inactiva"));
                                header("location: ../index.php?error=$error");
                        }
                }else{
                        $invalid=sha1(md5("contrasena y email invalido"));
                        header("location: ../index.php?invalid=$invalid");
                }
             }else{  header("location: ../");    }

	 }                    

	else
	 {
		 unset($_SESSION['tokens']);
		 $recap=sha1(md5("recaptcha"));
		 header("location: ../index.php?recap=$recap");
	 }

	}else
		 {
		unset($_SESSION['tokens']);
		$recap=sha1(md5("recaptcha"));
         	header("location: ../index.php?recap=$recap");
		exit;
		}	

?>
