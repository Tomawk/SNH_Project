
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
    echo '<td><a onclick="openmodal2()"><strong>'.' '. $_SESSION["username"] . '</strong></a></td>';
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
          echo "(".$resultCount.")";
        }
        ?>
      
    </a>
  </td>
  </tr>
</table>
</nav>