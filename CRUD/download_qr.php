<?php
if (isset($_GET['file'])) {
    $file = '../qrcodes/' . basename($_GET['file']);

    if (file_exists($file)) {
        // Send appropriate headers
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));

        // Clean (flush) output buffer
        flush();

        // Read the file
        readfile($file);
        exit;
    } else {
        echo "File not found.";
    }
}
?>
