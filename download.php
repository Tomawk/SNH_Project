<?php
function send_book($file){
    # $file contains the name of the book
    #$file = 'pdf.pdf';
    # directory in which book is in
    $pathUnder = './books/';
    #i check if the file exist, then i prepare the header of the response
    #then i send the file with readfile()
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
    /*

    test function:

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
}
?>