<?php
session_start();
require('inc/db.php');
?>
<!DOCTYPE html>
<html lang="it">
<head>

    <title> Bookshelf </title>
    <link href="CSS/bookshelf_style.css" rel="stylesheet" type="text/css">
	<link href="CSS/stilemain.css" rel="stylesheet" type="text/css">
    <script src="JS/modal.js" ></script>
    <script src="JS/bookshelf.js" ></script>
    <link rel="icon" href="immagini/icon.png" sizes="32x32">

    <!-- Font Awesome Import -->
    <script src="https://kit.fontawesome.com/a30f811c28.js" crossorigin="anonymous"></script>

    <!-- Google font include -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

</head>
<body>
<?php 
    include 'html/topnav.php';
    if(isset($_SESSION["username"])){
		include "html/modal_user.php";
	}else{
		include 'html/modal_login.php';
		include 'html/modal_register.php';
	}

?>
<div id="intestazione">
    <h1> BOOKWORM </h1>
</div>
<?php include 'html/aside.php';?>
    <div id="seach_div">
        <input type="text" placeholder="inserisci qui" id="input_field_search">
        <select id="field_search">
          <option value="none">Select a filter</option>
          <option value="ISBN">ISBN</option>
          <option value="author">author</option>
          <option value="title">title</option>
          <option value="genre">genre</option>
        </select>
        <input type="button" onclick="sendRequest()" id="search_button" value="invia">

    </div>
<?php
 

$query = "SELECT * FROM books";
$result=mysqli_query($con,$query);
$resultCount=mysqli_num_rows($result);

$rows = [];

while($row = mysqli_fetch_assoc($result)){
    $rows[] = $row;
}
echo '<div id="vetrina">';
for ($i = 0; $i < $resultCount; $i++) {
    if($i%4 == 0){
        echo '<div class="article_line"  >
        <div class="article_box" id ='.$i.'>
        <div class="book_image" style="background-image: url('.$rows[$i]['image_url'].');"></div>
        <div class="book_title">'.$rows[$i]['title'].'</div>
        <div class="book_author">Di <p style="display:inline; text-decoration: underline;">'.$rows[$i]['author'].'</div>
        <div class="book_isbn"> ISBN: <p style="display:inline; font-weight: normal;">'.$rows[$i]['ISBN'].'</div>
        <div class="book_genre"> Genre: <p style="display:inline; font-weight: normal;">'.$rows[$i]['genre'].'</div>
        <div class="book_date"> Year: <p style="display:inline; font-weight: normal;">'.$rows[$i]['publication_year'].'</p></div>
        <div class="book_price">'.$rows[$i]['price'].'€</div>
        <button type="submit" class="book_button"  onclick="AddToCart('.$i.')" ><a>Add to cart </a><i class="fa-solid fa-cart-shopping" ></i></button>
        </div>';
    } else {
        echo '<div class="article_box" id ='.$i.'>
        <div class="book_image" style="background-image: url('.$rows[$i]['image_url'].');"></div>
        <div class="book_title">'.$rows[$i]['title'].'</div>
        <div class="book_author">Di <p style="display:inline; text-decoration: underline;">'.$rows[$i]['author'].'</div>
        <div class="book_isbn"> ISBN: <p style="display:inline; font-weight: normal;">'.$rows[$i]['ISBN'].'</div>
        <div class="book_genre"> Genre: <p style="display:inline; font-weight: normal;">'.$rows[$i]['genre'].'</div>
        <div class="book_date"> Year: <p style="display:inline; font-weight: normal;">'.$rows[$i]['publication_year'].'</p></div>
        <div class="book_price">'.$rows[$i]['price'].'€</div>
        <button type="submit" class="book_button" onclick="AddToCart('.$i.')" ><a>Add to cart </a> <i class="fa-solid fa-cart-shopping" ></i></button>
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
echo '</div>';

?>


    
   

<!-- TODO: Non è stata impostata una immagine di default se non è presente o non carica una dei link nel db per le copertine dei libri-->
</body>