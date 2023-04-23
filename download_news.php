<?php
require_once('./tcpdf/tcpdf.php');

$items_per_page = 2; 
$page = isset($_GET['page']) ? $_GET['page'] : 1; 
$offset = ($page - 1) * $items_per_page; 

$sql = "SELECT * FROM news_form WHERE status = 1 LIMIT $items_per_page OFFSET $offset";
$result = mysqli_query($conn, $sql);

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator('My News');
$pdf->SetTitle('My News');

$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 009', PDF_HEADER_STRING);

$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$pdf->setPrintHeader(true);
$pdf->setPrintFooter(true);

$pdf->AddPage();

while ($row = mysqli_fetch_assoc($result)) {
    $pdf->SetFont('dejavusans', '', 14, '', true);
    $pdf->Ln();
    $pdf->Write(0, $row['title']);
    $pdf->Ln();
    $pdf->Image($row['image_url'], '', '', '', '', '', '', '', false, 300, '', false, false, 0, false, false, false);
    $pdf->Ln();
    $pdf->Write(0, $row['content']);
    $pdf->Ln();
    $pdf->Write(0, 'Read more: ' . 'http://localhost/news_id.php?news_id=' . $row['id']);
    $pdf->Ln();
    $pdf->Ln();
}

$pdf->Output('mynews.pdf', 'D');
?>
