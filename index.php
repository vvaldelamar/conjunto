<?php
    session_start();

    if (empty($_SESSION['token'])) {
 	 $_SESSION['tokens'] = bin2hex(random_bytes(32));
	}
		$tokens = $_SESSION['tokens'];

    include "config/config.php";

    if (isset($_SESSION['user_id']) && $_SESSION!==null) {
       header("location: profile.php");
    }


    $website = "website";
    $querycoin = mysqli_query($con,"select * from configuration where name=\"$website\" ");
    if ($r = mysqli_fetch_array($querycoin)) {
        $website_name=$r['val'];
    }
?>

<!DOCTYPE html>
    <head>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
       <html lang="en">
	<meta charset="UTF-8">
        <title>Iniciar sesión </title>

        <!-- Bootstrap -->
        <link href="css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="css/nprogress/nprogress.css" rel="stylesheet">
        <!-- Animate.css -->
        <link href="css/animate.css/animate.min.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="css/custom.min.css" rel="stylesheet">
	<link rel="icon" type="image/jpg" href="terminal.ico.png"/>

 <style>
    .text-center {
        text-align: center;
    }

    .g-recaptcha {
        display: inline-block;
    }
</style>

    </head>
    <body class="login" >
        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>
            <div class="login_wrapper">
                <div class="animate form login_form">
                    <?php 
                        $error=sha1(md5("cuenta inactiva"));
                        if (isset($_GET['error']) && $_GET['error']==$error) {
                            echo "<div class='alert alert-warning alert-dismissible fade in' role='alert'>
                                <strong>Error!</strong> Cuenta Inactiva
                                </div>";
                        }
                        $invalid=sha1(md5("contrasena y email invalido"));
                        if (isset($_GET['invalid']) && $_GET['invalid']==$invalid) {
                            echo "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                                <strong>Error!</strong> Contraseña o correo Electrónico invalido
                                </div>";
                        }
			$recap=sha1(md5("recaptcha"));
			if (isset($_GET['recap']) && $_GET['recap']==$recap) {
                            echo "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                                <strong>Error!</strong> Recaptcha invalido
                                </div>";
                        }
                    ?>
                    <section class="login_content">
                        <form action="action/login.php" id="login" method="post">
				<input type="hidden" name="anticsrf" value="<?php echo $tokens; ?>" />
                            <h1>Iniciar sesión</h1>
                            <div>
                                <input type="text" name="email" class="form-control" placeholder="Correo Electrónico" required />
                            </div>
                            <div>
                                <input type="password" name="password" class="form-control" placeholder="Contraseña" required/>
                            </div>
                            <div>
                                <button type="submit" name="token" value="Login" class="btn btn-default">Iniciar sesión</button>
                                
                            </div>
			      <div class="text-center">
				<div class="g-recaptcha" data-sitekey="6LdYG-EfAAAAACQkJObL7myY3obV6v7vIjiPkkhQ"></div>
			      </div>
                            <div class="clearfix"></div>
                            <div class="separator">
                                <div class="clearfix"></div>
                                <br />
                                <div>
                                    <h1><i class="fa fa-bar-chart"></i> <?php echo $website_name;?></h1>
                                    <p>© <?php echo date("Y"); ?> All Rights Reserved. <a style="text-decoration: underline;" target="_blank" href="https://ingeniero-web.com">Cloud Empresarial</a></p>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </body>
</html>
