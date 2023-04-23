<?php

if(isset($_GET['pdf_file'])){
    $pdf_file = $_GET['pdf_file'];
    $filepath = "uploads/" . $pdf_file;
    if(file_exists($filepath)){
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
        header('Content-Length: ' . filesize($filepath));
        readfile($filepath);
        exit;
    }
}

?>
