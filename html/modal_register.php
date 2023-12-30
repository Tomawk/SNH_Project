
<!-- MODAL REGISTRAZIONE -->

<div id="id02" class="modal1"> <!-- Modal1 -->
  <span onclick="closemodal1()" class="close1" title="Close Modal">&times;</span>
  <form class="modal-content1 animate" method="post" name="register" onsubmit="return validateFormRegister()" action="utility/register.php">
    <div class="container1">
      <h1>Register</h1>
      <p>Please insert data in the following fields to create an account</p>
      <hr id="hrmodal1">
      <label><b>Email</b></label>
      <input type="text" placeholder="Insert email" name="email" id="modal1_email" required>
      <p class="error_register" id="error_email"> Not supported email, insert a valid email. </p>

      <label><b>Name</b></label>
      <input type="text" placeholder="Insert name" name="name" id="modal1_nome" required>
      <p class="error_register" id="error_nome"> Name is too long or too short, insert a valid name. </p>

      <label><b>Surname</b></label>
      <input type="text" placeholder="Insert surname" name="surname" id="modal1_surname" required>
      <p class="error_register" id="error_surname"> Surname is too long or too short, insert a valid surname. </p>

      <label><b>Username</b></label>
      <input type="text" placeholder="Insert username" name="uname" id="modal1_uname" required>
      <p class="error_register" id="error_username"> Username is too long or too short, insert a valid username. </p>

      <label><b>Password</b></label>
      <input type="password" placeholder="Insert password" name="psw" id="modal1_password" required>
      <p class="error_register" id="error_password"> Invalid password. Password should at least contain 8 chars, an uppercase char, a lowercase char and a number.</p>

      <label><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat password" name="psw-repeat" id="modal1_repeat" required>
      <p class="error_register" id="error_repeat"> Password mismatch. </p>

      <label><b>City</b></label>
      <input type="text" placeholder="Insert city" name="city" id="modal1_city" required>
      <p class="error_register" id="error_city"> Invalid City. Only letters and whitespaces allowed.</p>

      <label><b>Address</b></label>
      <input type="text" placeholder="Insert address" name="address" id="modal1_address" required>

      <label><b>Postal Code</b></label>
      <input type="text" placeholder="Insert postal code" name="cap" id="modal1_cap" required>
      <p class="error_register" id="error_cap"> Invalid Postal Code. Remember: the postal code is composed of 5 digits only. </p>

      <p>By creating an account, you are agreeing our <a href="#" style="color:dodgerblue">Terms and Conditions</a>.</p>

      <div class="clearfix">
        <button type="button" onclick="closemodal1()" class="cancelbutn" id="modal1button_cancel">Cancel</button>
        <button type="submit" class="signupbtn" id="modal1button_signup">Sign Up</button>
      </div>
      <?php

        if(isset($_SESSION['emailErr'])){
        echo '<p class="err_register" id="emailErr">'.$_SESSION['emailErr'].'</p>';
        unset($_SESSION['emailErr']);
        }

        if(isset($_SESSION['nameErr'])){
        echo '<p class="err_register" id="nomeErr">'.$_SESSION['nameErr'].'</p>';
        unset($_SESSION['nameErr']);
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

        if(isset($_SESSION['cityErr'])){
        echo '<p class="err_register" id="cittaErr">'.$_SESSION['cityErr'].'</p>';
        unset($_SESSION['cityErr']);
        }

        if(isset($_SESSION['addressErr'])){
        echo '<p class="err_register" id="indirizzoErr">'.$_SESSION['addressErr'].'</p>';
        unset($_SESSION['addressErr']);
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

