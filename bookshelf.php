<?php
session_start();
require('inc/db.php');
?>
<!DOCTYPE html>
<html lang="it">
<head>

    <title> Bookshelf </title>
    <link href="CSS/bookshelf_style.css" rel="stylesheet" type="text/css">
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
<?php include 'html/topnav.php';?>
<div id="intestazione">
    <h1> BOOKWORM </h1>
</div>
<aside class="rightnav">
    <table>
        <tr>
            <td id="facebook"></td>
        </tr>
        <tr>
            <td id="instagram"></td>
        </tr>
        <tr>
            <td id="google"></td>
        </tr>
    </table>
</aside>
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


<script>
    
    function sendRequest() {

        var data = new FormData();
        data.append('Search_filed', document.getElementById("field_search").value);
        data.append('Value', document.getElementById("input_field_search").value);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "utility/filtering_books.php", true);
        
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
              jQuery('#vetrina').html(xhr.responseText);
            }
        };
        xhr.send(data);
    }

    function AddToCart(i){
        var container = document.getElementById(i);
        var ISBN = container.childNodes[7].childNodes[1].textContent;
        //send data

        var data = new FormData();
        data.append('ISBN', ISBN);
        data.append('username',<?php echo "'".$_SESSION['username']."'"?>)

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "utility/add_to_cart.php", true);

        xhr.onreadystatechange = function () {
           if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
            //aggiunto al carrello
            if(xhr.responseText == 0){
                alert("Riprova, qualcosa è andato storto")
            }
            else{
                var button = container.childNodes[15];
                var testo = button.childNodes[0];
                testo.textContent = 'Aggiunto';
                testo.style.color = 'green';

                setInterval(function(){
                    testo.textContent = 'Add to cart';
                    testo.style.color = 'black';
                }, 2000);
            }
           }
       };
       xhr.send(data);


       
    }

</script>

<!-- TODO: Non è stata impostata una immagine di default se non è presente o non carica una dei link nel db per le copertine dei libri-->
</body>