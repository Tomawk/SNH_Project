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

for ($i = 0; $i < $resultCount; $i++) {
    if($i%4 == 0){
        echo '<div class="article_line">
        <div class="article_box">
        <div class="book_image" style="background-image: url('.$rows[$i]['image_url'].');"></div>
        <div class="book_title">'.$rows[$i]['title'].'</div>
        <div class="book_author">Di <p style="display:inline; text-decoration: underline;">'.$rows[$i]['author'].'</div>
        <div class="book_isbn"> ISBN: <p style="display:inline; font-weight: normal;">'.$rows[$i]['ISBN'].'</div>
        <div class="book_genre"> Gendddre: <p style="display:inline; font-weight: normal;">'.$rows[$i]['genre'].'</div>
        <div class="book_date"> Year: <p style="display:inline; font-weight: normal;">'.$rows[$i]['publication_year'].'</p></div>
        <div class="book_price">'.$rows[$i]['price'].'€</div>
        <button type="submit" class="book_button">Add to cart <i class="fa-solid fa-cart-shopping"></i></button>
        </div>';
    } else {
        echo '<div class="article_box">
        <div class="book_image" style="background-image: url('.$rows[$i]['image_url'].');"></div>
        <div class="book_title">'.$rows[$i]['title'].'</div>
        <div class="book_author">Di <p style="display:inline; text-decoration: underline;">'.$rows[$i]['author'].'</div>
        <div class="book_isbn"> ISBN: <p style="display:inline; font-weight: normal;">'.$rows[$i]['ISBN'].'</div>
        <div class="book_genre"> Genre: <p style="display:inline; font-weight: normal;">'.$rows[$i]['genre'].'</div>
        <div class="book_date"> Year: <p style="display:inline; font-weight: normal;">'.$rows[$i]['publication_year'].'</p></div>
        <div class="book_price">'.$rows[$i]['price'].'€</div>
        <button type="submit" class="book_button">Add to cart <i class="fa-solid fa-cart-shopping"></i></button>
        </div>';
        
        $temp = $i+1;
        if($temp%4 == 0){
            echo '</div>';
        }
    }
}

if($resultCount%4 != 0){
    echo '</div>';
}

    // Close the database conection
    $con->close();
?>