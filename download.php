<?php
    session_start();
    require('inc/db.php');
    require("utility/sessionManager.php");
    checkSession($con);
    if(!isset($_SERVER['HTTPS'])){
            header("HTTPS 404 nosecure");
            exit();
        }
    $file = null;
    if(isset($_POST["book"])){
        $file = stripslashes($_POST['book']);
        $file = mysqli_real_escape_string($con,$file);
        $file = $file.".pdf";
    }else{
        echo "error ".$file;
        exit();
    }
    $stmt = mysqli_prepare($con,"SELECT * FROM contenutoordini WHERE ISBN = ? AND username = ?");
    $stmt->bind_param("is", $file,$_SESSION["username"]);
    $stmt->execute();
    $result= $stmt->get_result(); //only one row
    $resultCount=mysqli_num_rows($result);
    if($resultCount != 0){
        # $file contains the name of the book
        # directory in which book is in
        $pathUnder = '../books2/';
        #$pathUnder = 'books2/';
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
        else{
            echo "no file:".$file;
            exit();
        }
    }else{
        echo "no file in db".$_SESSION["username"].",".$file;
        exit();
    }
?>
<?php
/*
function send_book($file){
    # $file contains the name of the book
    #$file = 'pdf.pdf';
    # directory in which book is in
    $pathUnder = '../books/';
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
?>