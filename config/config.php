<?php

	include("db.php");

	$con=@mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if(!$con){
        @die("<h2 style='text-align:center'>Imposible conectarse a la base de datos! </h2>".mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        @die("Conexión falló: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }

    $inactivo = 900;
    if(isset($_SESSION['tiempo']) ) {
    $vida_session = time() - $_SESSION['tiempo'];
        if($vida_session > $inactivo)
        {
            session_destroy();
            header("Location: index.php");
        }
    }

    $_SESSION['tiempo'] = time();
