<?php
session_start();
require('inc/db.php');

if(!isset($_SESSION['username'])){
    header('location: index.php');
    die();
    //This prevents bots and savy users who know how to ignore browser headers from
    // getting into the page and causing problems. It also allows the page to
    //  stop executing the rest of the page and to save resources.
}
?>

<!DOCTYPE HTML>
<html lang="eng">
<head>
    <title>Order History</title>


    <link href="CSS/history_style.css" rel="stylesheet" type="text/css">
    <link href="CSS/modals.css" rel="stylesheet" type="text/css">
    <link href="CSS/topnav.css" rel="stylesheet" type="text/css">
    <link href="CSS/rightnav.css" rel="stylesheet" type="text/css"


    <link rel="icon" href="immagini/icon.png" sizes="32x32">

    <!-- Font Awesome Import -->
    <script src="https://kit.fontawesome.com/a30f811c28.js" crossorigin="anonymous"></script>

    <!-- Google font include -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

    <!-- Modal js include -->
    <script src="JS/modal.js" ></script>

</head>
<body>
<?php include 'html/topnav.php';?>
<?php include 'html/aside.php'; ?>
<div id="center_div">
    <h1> Order History </h1>
    <hr>
    <?php
    $stmt = mysqli_prepare($con,"SELECT id FROM contenutoordini WHERE username = ? ORDER BY id DESC");
    $stmt->bind_param("s", $_SESSION['username']);
    $stmt->execute();
    $result = $stmt->get_result();
    $resultCount=mysqli_num_rows($result);

    if($resultCount == 0) { /* Se lo storico è vuoto */
        echo '<h2 id="h2_empty"> Ops! There is nothing here.. </h2>
    			  <img src="immagini/storico_empty.jpg" alt="nessun ordine" id="empty_history">
    			  <a href="bookshelf.php" id="a_empty"> Start shopping now! </a>';

    }

    $rows_orders = array();
    $orders_ids_with_duplicates = array();
    while($row = mysqli_fetch_assoc($result)){
        $rows_orders[] = $row;
        $orders_ids_with_duplicates[] = $row['id'];

    }

    //get all unique ids
    $orders_ids = array_values(array_unique($orders_ids_with_duplicates));
    // get id $rows_orders[i]['id]

    $total_orders = count($orders_ids);
    $null_orders = 0;

    for($i= 0; $i<$total_orders; $i++){ //get how many

        $stmt2 = mysqli_prepare($con,"SELECT * FROM ordini WHERE id = ? AND stato_ordine IS NOT NULL");
        $stmt2->bind_param("i", $orders_ids[$i]);
        $stmt2->execute();
        $result2= $stmt2->get_result(); //only one row
        $result2Count=mysqli_num_rows($result2);
        if($result2Count != 0){

            $row_order_details = mysqli_fetch_assoc($result2);

            $stmt3 = mysqli_prepare($con,"SELECT * FROM contenutoordini WHERE id = ?");
            $stmt3->bind_param("i", $orders_ids[$i]);
            $stmt3->execute();
            $result_num_item= $stmt3->get_result();
            $rows_num_items = mysqli_fetch_assoc($result_num_item);
            $num_items = $rows_num_items['numero_item'];

            echo '
   			<section>
			<div class="image">
				<img src="immagini/book_shipping.jpg" alt="book_shipping">
			</div>
			<h3> Order - #' .$row_order_details['id'].' </h3>
			<p class="quantity"> Number of items: <strong>'.$num_items.'</strong> </p>
			<p class="shipping"> Order State:';

            switch ($row_order_details['stato_ordine']) {
                case "pending":
                    echo '
                <strong class="pending">'.$row_order_details['stato_ordine'].'</strong></p>
                ';
                    break;
                case "shipped":
                    echo '
                <strong class="shipped">'.$row_order_details['stato_ordine'].'</strong></p>
                ';
                    break;
                case "delivered":
                    echo '
                <strong class="delivered">'.$row_order_details['stato_ordine'].'</strong></p>
                ';
                    break;
                case "refound":
                    echo '
                <strong class="refound">'.$row_order_details['stato_ordine'].'</strong></p>
                ';
                    break;
            }

            echo '
			<p class="data"> Date of the payment: <strong>'.$row_order_details['data'].'</strong> </p>
			<p class="total"> Total <br> &nbsp;&nbsp;<strong>'.$row_order_details['totale'].'&euro; </strong></p>
			';


            $stmt4 = mysqli_prepare($con,"SELECT * FROM contenutoordini WHERE id = ?");
            $stmt4->bind_param("i", $row_order_details['id']);
            $stmt4->execute();
            $result3= $stmt4->get_result();

            while($article_row = mysqli_fetch_assoc($result3)){

                $stmt5 = mysqli_prepare($con,"SELECT * FROM books WHERE ISBN = ?");
                $stmt5->bind_param("s", $article_row['ISBN']);
                $stmt5->execute();
                $result4= $stmt5->get_result();
                $row_article_details = mysqli_fetch_assoc($result4);

                echo '
            <div class="article_box">
            <div class="book_image" style="background-image: url('.$row_article_details['image_url'].');"></div>
            <div class="book_title">'.$row_article_details['title'].'</div>
            <div class="book_author">Di <p style="display:inline; text-decoration: underline;">'.$row_article_details['author'].'</div>
            <div class="book_isbn"> ISBN: <p style="display:inline; font-weight: normal;">'.$row_article_details['ISBN'].'</div>
            <div class="book_genre"> Genre: <p style="display:inline; font-weight: normal;">'.$row_article_details['genre'].'</div>
            <div class="book_date"> Year: <p style="display:inline; font-weight: normal;">'.$row_article_details['publication_year'].'</p></div>
            <div class="book_price"> Bought at: '.$row_article_details['price'].'€</div>
            <button type="submit" class="book_button">Download <i class="fa-solid fa-download"></i></button>
            </div>
            <hr>
            ';
            }

            echo '</section><hr>';

        } else{
            $null_orders++;
            if($null_orders == $total_orders){ //ha tutti ordini a null
                echo '<h2 id="h2_empty"> Ops! There is nothing here.. </h2>
    			  <img src="immagini/storico_empty.jpg" alt="nessun ordine" id="empty_history">
    			  <a href="bookshelf.php" id="a_empty"> Start shopping now! </a>';
            }
        }


    }

    ?>

</div>
<?php
    include "html/modal_user.php";
?>
</body>
</html>