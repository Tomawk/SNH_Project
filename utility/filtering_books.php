<?php
   
    session_start();
    require('../inc/db.php');
 
    $sql = "";
    $search_field = $_POST['Search_filed'];
    $value = $_POST['Value'];

    if($search_field == "none" or !isset($value) or $value==" "){
        $sql = "SELECT * FROM books";
        $stmt = $con->prepare($sql);
    }
    else{

        if($search_field == "ISBN") $sql = "SELECT * FROM books WHERE ISBN like ? ";
        else if($search_field == "title") $sql = "SELECT * FROM books WHERE title like ? ";
        else if($search_field == "author") $sql = "SELECT * FROM books WHERE author like ? ";
        else if($search_field == "genre") $sql = "SELECT * FROM books WHERE genre like ? ";
        else exit();
        
        $stmt = $con->prepare($sql);
        $where_condition = "%".$value."%";
        $stmt->bind_param("s",$where_condition);
    }
    $stmt->execute();

    $result = $stmt->get_result();

    $resultCount=mysqli_num_rows($result);

    while($row = mysqli_fetch_assoc($result)){
    $rows[] = $row;
}

$stinga = "";
for ($i = 0; $i < $resultCount; $i++) {
        
        if($i%4 == 0){
            $stinga = $stinga."<div class='article_line'>|";
        }else{
            $temp = $i+1;
        }
        $stinga =$stinga. 
            "start_start|".
            $rows[$i]['image_url']."|".
            $rows[$i]['title']."|".
            $rows[$i]['author']."|".
            $rows[$i]['ISBN']."|".
            $rows[$i]['genre']."|".
            $rows[$i]['publication_year']."|".
            $rows[$i]['price']."|".
            "end_end|";
    
        if($i%4 != 0){
            if($temp%4 == 0){
                $stinga =$stinga.'</div>|';
            }
        }
}

if($resultCount%4 != 0){
    $stinga =$stinga.'</div>';
}
    echo $stinga; // send string over XML
    // Close the database conection
    $con->close();
?>

<?php
    
    
   
?>
