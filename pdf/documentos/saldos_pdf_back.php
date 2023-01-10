<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: www.obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
	/* Connect To Database*/

	include("../../config/config.php");

	require_once(dirname(__FILE__).'/../html2pdf.class.php');

	$argu=getopt(null, ["casa:"]);
    	var_dump($argu);
        extract($argu);
	echo "se encontro:".$casa;

    // get the HTML
     ob_start();
     include(dirname('__FILE__').'/res/saldos_html_back.php');
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
        $html2pdf->Output('imprimir.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }

