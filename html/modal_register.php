
<!-- MODAL REGISTRAZIONE -->

<div id="id02" class="modal1"> <!-- Modal1 -->
  <span onclick="closemodal1()" class="close1" title="Close Modal">&times;</span>
  <form class="modal-content1 animate" method="post" name="register" onsubmit="return validateFormRegister()" action="utility/register.php">
    <div class="container1">
      <h1>Registrati</h1>
      <p>Perfavore inserisci i dati nei seguenti riquadri per creare un account.</p>
      <hr id="hrmodal1">
      <label><b>Email</b></label>
      <input type="text" placeholder="Inserisci Email" name="email" id="modal1_email" required>
      <p class="error_register" id="error_email"> Email non supportata, inserisci una email valida. </p>

      <label><b>Nome</b></label>
      <input type="text" placeholder="Inserisci Nome" name="nome" id="modal1_nome" required>
      <p class="error_register" id="error_nome"> Nome non supportato, inserisci un nome valido. </p>

      <label><b>Cognome</b></label>
      <input type="text" placeholder="Inserisci Cognome" name="surname" id="modal1_surname" required>
      <p class="error_register" id="error_surname"> Cognome non supportato, inserisci un cognome valido. </p>

      <label><b>Username</b></label>
      <input type="text" placeholder="Inserisci Username" name="uname" class="modal1_input" required>

      <label><b>Password</b></label>
      <input type="password" placeholder="Inserisci Password" name="psw" id="modal1_password" required>
      <p class="error_register" id="error_password"> Password non valida. Deve contenere almeno 8 caratteri, una lettera maiuscola, una lettera minuscola e un numero.</p>

      <label><b>Ripeti Password</b></label>
      <input type="password" placeholder="Ripeti Password" name="psw-repeat" id="modal1_repeat" required>
      <p class="error_register" id="error_repeat"> Le due password con coincidono. </p>

      <label><b>Citt&agrave;</b></label>
      <input type="text" placeholder="Inserisci Citt&agrave;" name="citta" class="modal1_input" required>

      <label><b>Indirizzo</b></label>
      <input type="text" placeholder="Inserisci Indirizzo" name="indirizzo" class="modal1_input" required>

      <label><b>CAP</b></label>
      <input type="text" placeholder="Inserisci CAP" name="cap" id="modal1_cap" required>
      <p class="error_register" id="error_cap"> CAP non valido. Ricorda: Il CAP &egrave; formato da 5 cifre numeriche </p>

      <p>Creando un account accetti i nostri <a href="#" style="color:dodgerblue">Termini e Condizioni</a>.</p>

      <div class="clearfix">
        <button type="button" onclick="closemodal1()" class="cancelbutn" id="modal1button_cancel">Cancel</button>
        <button type="submit" class="signupbtn" id="modal1button_signup">Sign Up</button>
      </div>
      <?php

        if(isset($_SESSION['emailErr'])){
        echo '<p class="err_register" id="emailErr">'.$_SESSION['emailErr'].'</p>';
        unset($_SESSION['emailErr']);
        }

        if(isset($_SESSION['nomeErr'])){
        echo '<p class="err_register" id="nomeErr">'.$_SESSION['nomeErr'].'</p>';
        unset($_SESSION['nomeErr']);
        }

        if(isset($_SESSION['surnameErr'])){
        echo '<p class="err_register" id="surnameErr">'.$_SESSION['surnameErr'].'</p>';
        unset($_SESSION['surnameErr']);
        }

        if(isset($_SESSION['usernameErr'])){
        echo '<p class="err_register" id="usernameErr">'.$_SESSION['usernameErr'].'</p>';
        unset($_SESSION['usernameErr']);
        }

        if(isset($_SESSION['pswErr'])){
        echo '<p class="err_register" id="pswErr">'.$_SESSION['pswErr'].'</p>';
        unset($_SESSION['pswErr']);
        }

        if(isset($_SESSION['psw_repeatErr'])){
        echo '<p class="err_register" id="psw_repeatErr">'.$_SESSION['psw_repeatErr'].'</p>';
        unset($_SESSION['psw_repeatErr']);
        }

        if(isset($_SESSION['cittaErr'])){
        echo '<p class="err_register" id="cittaErr">'.$_SESSION['cittaErr'].'</p>';
        unset($_SESSION['cittaErr']);
        }

        if(isset($_SESSION['indirizzoErr'])){
        echo '<p class="err_register" id="indirizzoErr">'.$_SESSION['indirizzoErr'].'</p>';
        unset($_SESSION['indirizzoErr']);
        }

        if(isset($_SESSION['capErr'])){
        echo '<p class="err_register" id="capErr">'.$_SESSION['capErr'].'</p>';
        unset($_SESSION['capErr']);
        }

      ?>
    </div>
  </form>

</div>
<!-- Fine Modal Registrazione -->

