<?php

if(!file_exists($_FILES['my_file']['tmp_name']) || !is_uploaded_file($_FILES['my_file']['tmp_name'])) {

    echo 'Nu ai incarcat niciun fisier';

  }else{

if(move_uploaded_file($_FILES["my_file"]["tmp_name"], 'xml2pdf.xml')){

  $string = file_get_contents("xml2pdf.xml");

  $regex = '/\s\b/';

  $string = preg_replace($regex,'<br>',$string);
  $string = preg_replace($regex,'\r\n',$string);

  $xml = htmlentities($string);

require_once('TCPDF-main/tcpdf.php');

$pdf = new Tcpdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Șerbănescu Mircea');
$pdf->SetTitle('XML2PDF');
$pdf->SetSubject('FF ANAF');

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->SetFont('dejavusans', '', 14, '', true);

$pdf->AddPage();


$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));


$pdf->writeHTMLCell(0, 0, '', '', $xml, 0, 1, 0, true, '', true);

$pdf->Output('xml2pdf.pdf', 'I');

}
}
?>
