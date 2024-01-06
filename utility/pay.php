<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Message Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f4f4f4;
    }

    .message-container {
      text-align: center;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: #fff;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      background: green;
      width: 32%;
      height: 40%;
      /* text-align: right; */
      padding-top: 8%;
    }
  </style>
</head>
<body>

    <?php
    session_start();
    require('../inc/db.php');
    require('log.php');
    if(!isset($_SERVER['HTTPS'])){
            header("HTTPS 404 nosecure");
            exit();
        }

    if($_SESSION["state"]!="summary")
    {
      header("location: ".$_SESSION["state"].".php") ;
      exit();
    }
    else{
        $_SESSION["state"]!="outside";
    }


    $id_ordine = $_SESSION["id_ordine"];
    $totale = $_SESSION["totale"];

    if(isset($_SESSION["username"])){
        $username = "";
    }else{
        $username = $_SESSION["username"];
    }


    $sql = "UPDATE `ordini` 
        SET `totale` = ? ,`stato_ordine` = 'shipped', 
        `indirizzo` = ?,`citta`=?,`paese`=?      
        WHERE `ordini`.`id` = ? ";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("dsssi",$totale,$_SESSION["payment_info"]["address"],$_SESSION["payment_info"]["city"],$_SESSION["payment_info"]["country"],$id_ordine);
    $stmt->execute();

    unset($_SESSION["payment_info"]);
    if ($stmt !== false) {
        //user present
        echo"<div class='message-container' style='background: green'>";
        echo"<h1>Operation result</h1>";
        echo "<p>Payment went ok</p>";
        echo "<a href='../order_history.php'>Go to the history page</a>";
        $log_msg = "SUCCESSFUL PAYMENT: username: ".$username." order_id: ".$id_ordine;
        log_message($log_msg);
    }else{
        echo"<div class='message-container' style='background: #de6666'>";
        echo"<h1>Operation result</h1>";
        echo "<p>Something went wrong, retry</p>";
        $log_msg = "FAILED PAYMENT: username: ".$username." order_id: ".$id_ordine;
        log_message($log_msg);
    }
    ?>
 </div>
</body>
</html>
