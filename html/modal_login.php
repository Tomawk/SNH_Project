<!-- MODAL PER IL LOGIN --> 
<div id="id01" class="modal">

  <form class="modal-content animate" method="post" name="login" action="utility/login.php">
    <div class="imgcontainer">
      <span onclick="closemodal()" class="close" title="Close Modal">&times;</span> <!-- Span chiusura modal -->
      <img src="immagini/avatar.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label><b>Username</b></label>
      <input type="text" placeholder="Inserisci Username" name="username" class="inputmodal" required>

      <label><b>Password</b></label>
      <input type="password" placeholder="Inserisci Password" name="password" class="inputmodal" required>
      <div>
        <input type="checkbox" id="rememberme" name="rememberme" />
        <label for="rememberme">Remember me</label>
      </div>
      <br><br>
      <button type="submit" class="modalbutton">Login</button>

      <?php
      if(isset($_SESSION["error"])){

      echo '<p id="errore_login">'.' '.$_SESSION['error'].'<p>';
      unset($_SESSION['error']);
      }

      ?>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="closemodal()" class="cancelbtn">Cancel</button>
      <span class="psw"><a href="request_recover_password.php">Forgot Password? </a> <a href="usernameRecovery.php">Forgot username?</a></span>
      <span class="psw"></span>
    </div>
  </form>



</div>


<!-- FINE MODAL LOGIN-->
<script src="JS/modal.js" ></script>

</script>