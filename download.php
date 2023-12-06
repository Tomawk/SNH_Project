<?php
$file = 'pdf.pdf';
$file = 'vbox.iso';
$pathUnder = './books/';
echo $pathUnder;
echo basename($pathUnder.$file);
#exit;
/*
if (file_exists($pathUnder.$file)) {
    $ToProtectedFile=$pathUnder.$file;
    $handle = fopen($ToProtectedFile, "rb");

    header("Cache-Control: no-cache, must-revalidate"); 
    header('Content-Description: File Transfer');
    header("Pragma: no-cache"); //keeps ie happy
    header("Content-Disposition: attachment; filename= ".basename($pathUnder.$file).'"');
    header("Content-type: application/octet-stream");
    header('Content-Length: ' . filesize($pathUnder.$file));
    header('Content-Transfer-Encoding: binary');

    ob_end_clean();//required here or large files will not work
    fpassthru($handle);//works fine now
    exit;
}
*/
if (file_exists($pathUnder.$file)) {
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($pathUnder.$file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($pathUnder.$file));
    readfile($pathUnder.$file);
    exit;
}
?>