
<nav class="topnav">
 <table>
  <tr>
    <td><a href="index.php"><i class="fa-solid fa-house"></i></a></td>
    <td><a href="bookshelf.php">Bookshelf</a></td>
	<?php /* Verifica se l'utente è loggato e nel caso mostra il bottone con il nome */

	if(!isset($_SESSION["username"])){

echo '
    <td> <a onclick="openmodal()">Login</a></td>
    <td> <a onclick="openmodal1()">Registrati</a></td>';

}else{
    echo '<td><a onclick="openmodal3()"><strong>'.' '. $_SESSION["username"] . '</strong></a></td>';
}
?>
	<td>
    <a href="carrello.php"><i class="fa-solid fa-cart-shopping"></i> 
      Shop Now 
        <?php 
	      if(isset($_SESSION["username"])){
          $query = "SELECT b.*, o.stato_ordine, o.id,c.numero_item FROM `ContenutoOrdini` as c join `ordini` as o on c.id = o.id join books b on b.ISBN = c.ISBN 
            where c.username = '".$_SESSION['username']."'"."  and o.stato_ordine is null;";
    
          $result=mysqli_query($con,$query);
          $resultCount = 0;
          while($row = mysqli_fetch_assoc($result)){
            $resultCount += $row['numero_item'];
          }
          echo "<u id='item_nel_carrello'>(".$resultCount.")</u>";

          //gestione coockie
         //if(!isset($_COOKIE["user"])){
         //  //set the coockie
         //  $cookie_name = "user";
         //  $cookie_value = "1";
         //  setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
         //  $_COOKIE["logged_in"] = false;
         //}
        }
        else{
          if(!isset($_SESSION['not_logged_in'])){
            $_SESSION['not_logged_in'] = array();
          };
          echo "<u id='item_nel_carrello'>(".sizeof($_SESSION['not_logged_in']).")</u>";
        }
        ?>
    </a>
  </td>
  </tr>
</table>
</nav>