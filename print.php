<?php
require('tcpdf/tcpdf.php');
$db = new PDO('mysql:host=localhost;dbname=user_db', 'root', '');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
  die('Invalid ID parameter');
}
$stmt = $db->prepare('SELECT * FROM news_form WHERE id = ?');
$stmt->execute([$id]);
$row = $stmt->fetch();


$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('dejavusans', '', 14, '', true);
$pdf->Cell(50,10,'Date:'.date('d-m-Y').'',0,"R");
$pdf->Ln(14);
$pdf->SetFont('dejavusans', '', 14, '', true);
$pdf->Cell(50,10,'Title:',0,0);
$pdf->Cell(50,10,$row['title'],0,1);

$pdf->SetFont('dejavusans', '', 14, '', true);
$pdf->Cell(50,10,'Body:',0,0);
$pdf->writeHTML($row['body']);
$pdf->Ln();

$pdf->Output();
?>


