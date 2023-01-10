<?php
	/*-------------------------
	Mail: vvaldelamar@gmaiil.com
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_id']) AND $_SESSION['user_id'] != 1) {
        header("location: ../../");
		exit;
    }
	/* Connect To Database*/

	include("../../config/config.php");

	/*
	$session_id= session_id();
	$sql_count=mysqli_query($con,"select * from base where user_id='".$session_id."'");
	$count=mysqli_num_rows($sql_count);
	if ($count>0)
	{
	echo "<script>alert('No hay ingresos agregados, por favor agregalo...')</script>";
	echo "<script>window.close();</script>";
	exit;
	}
	*/
	require_once(dirname(__FILE__).'/../html2pdf.class.php');
		
	//Variables por GET
	$daterange = mysqli_real_escape_string($con,(strip_tags($_REQUEST['daterange'], ENT_QUOTES)));
	$casa =  mysqli_real_escape_string($con,(strip_tags($_REQUEST['casa'], ENT_QUOTES)));
    // get the HTML
     ob_start();
     include(dirname('__FILE__').'/res/saldos_html.php');
    $content = ob_get_clean();

    try
    {
        // init HTML2PDF
        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        // send the PDF
        $html2pdf->Output('resumen_envio_correo.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
