<?php

// always load alternative config file for examples
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/tcpdf/config/tcpdf_config.php');

// Include the main TCPDF library (search the library on the following directories).
$tcpdf_include_dirs = array($_SERVER['DOCUMENT_ROOT'].'/lib/tcpdf/tcpdf.php');
/*
$tcpdf_include_dirs = array(
	realpath('../tcpdf.php'),
	'/usr/share/php/tcpdf/tcpdf.php',
	'/usr/share/tcpdf/tcpdf.php',
	'/usr/share/php-tcpdf/tcpdf.php',
	'/var/www/tcpdf/tcpdf.php',
	'/var/www/html/tcpdf/tcpdf.php',
	'/usr/local/apache2/htdocs/tcpdf/tcpdf.php'
);
*/
foreach ($tcpdf_include_dirs as $tcpdf_include_path) {
	if (@file_exists($tcpdf_include_path)) {
		require_once($tcpdf_include_path);
		break;
	}
}

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 021');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 021', PDF_HEADER_STRING);
$pdf->SetHeaderData(0, 0, 'TEST', 'test');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

/*
// set font
$pdf->SetFont('nanumbarungothicyethangul', '', 9);

// add a page
$pdf->AddPage();

// create some HTML content
$html = addslashes($_POST['pdfhtml']);

// output the HTML content
$pdf->writeHTML($html, true, 0, true, 0);

// reset pointer to the last page
$pdf->lastPage();
*/

// add a page
$pdf->AddPage();

// set JPEG quality
$pdf->setJPEGQuality(75);

// Image method signature:
// Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)

// The '@' character is used to indicate that follows an image data stream and not an image file name

$imgUrl = $_POST['imgUrl'];
$imgUrl = str_replace('data:image/jpeg;base64, ', '', $imgUrl);

$pdf->Image($imgUrl);


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('test.pdf', 'I');
// I 보여주기
// D 다운로드

?>