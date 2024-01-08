
<!-- MODAL PULSANTE UTENTE -->

<div id="id03" class="modal">

  <div class="modal-content animate">
    <div class="imgcontainer">
      <span onclick="closemodal3()" class="close" title="Close Modal">&times;</span> <!-- Span chiusura modal -->
      <img src="immagini/user.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
		 <p> <strong>
                 <?php
                 $username_data = $_SESSION["username"];
                 $trimmed_username = trim($username_data); //Remove whitespaces
                 $unescaped_username = stripcslashes($trimmed_username);
                 $username_sanitized = htmlspecialchars($unescaped_username , ENT_QUOTES, 'UTF-8'); //Convert special characters to HTML entities
                 echo $username_sanitized;
                 ?>
             </strong>
         </p>
<br>
<br>
      <button type="button" onclick="location.href = 'info.php';" class="modalbutton">My information</button>
      <button type="button" onclick="location.href = 'order_history.php';" class="modalbutton">Order History</button>
      <button type="button" onclick="location.href = 'utility/logout.php';" class="modalbutton">Logout</button>
    </div>
    <div class="container" style="background-color:#f1f1f1">
    </div>
  </div>
</div>

<!-- FINE MODAL UTENTE -->
