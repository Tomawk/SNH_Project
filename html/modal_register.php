
<!-- MODAL REGISTRAZIONE -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>


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
      <p class="error_register" id="error_nome"> Name is too long or too short or invalid, insert a valid name. </p>

      <label><b>Surname</b></label>
      <input type="text" placeholder="Insert surname" name="surname" id="modal1_surname" required>
      <p class="error_register" id="error_surname"> Surname is too long or too short or invalid, insert a valid surname. </p>

      <label><b>Username</b></label>
      <input type="text" placeholder="Insert username" name="uname" id="modal1_uname" required>
      <p class="error_register" id="error_username"> Username is too long or too short or invalid, insert a valid username. </p>

      <label><b>Password </b></label>
      <label id="error_password_zxcvbn"></label>
      <input type="password" placeholder="Insert password" name="psw" id="modal1_password" oninput="controlla_sicurezza_password_register_form()" required>
      <p class="error_register" id="error_password"> Invalid password. Password should at least contain 8 chars, an uppercase char, a lowercase char and a number.</p>
     

      <label><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat password" name="psw-repeat" id="modal1_repeat" required>
      <p class="error_register" id="error_repeat"> Password mismatch. </p>

      <label><b>City</b></label>
      <input type="text" placeholder="Insert city" name="city" id="modal1_city" required>
      <p class="error_register" id="error_city"> Invalid City. Only letters allowed.</p>

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
            $emailErr_data = $_SESSION["emailErr"];
            $trimmed_emailErr = trim($emailErr_data);
            $unescaped_emailErr = stripcslashes($trimmed_emailErr);
            $emailErr_sanitized = htmlspecialchars($unescaped_emailErr , ENT_QUOTES, 'UTF-8'); //Convert special characters to HTML entities
            echo '<p class="err_register" id="emailErr">'.$emailErr_sanitized.'</p>';
            unset($_SESSION['emailErr']);
        }

        if(isset($_SESSION['nameErr'])){
            $nameErr_data = $_SESSION["nameErr"];
            $trimmed_nameErr = trim($nameErr_data);
            $unescaped_nameErr = stripcslashes($trimmed_nameErr);
            $nameErr_sanitized = htmlspecialchars($unescaped_nameErr , ENT_QUOTES, 'UTF-8');
            echo '<p class="err_register" id="nomeErr">'.$nameErr_sanitized.'</p>';
            unset($_SESSION['nameErr']);
        }

        if(isset($_SESSION['surnameErr'])){
            $surnameErr_data = $_SESSION["surnameErr"];
            $trimmed_surnameErr = trim($surnameErr_data);
            $unescaped_surnameErr = stripcslashes($trimmed_surnameErr);
            $surnameErr_sanitized = htmlspecialchars($unescaped_surnameErr , ENT_QUOTES, 'UTF-8');
            echo '<p class="err_register" id="surnameErr">'.$surnameErr_sanitized.'</p>';
            unset($_SESSION['surnameErr']);
        }

        if(isset($_SESSION['usernameErr'])){
            $usernameErr_data = $_SESSION["usernameErr"];
            $trimmed_usernameErr = trim($usernameErr_data);
            $unescaped_usernameErr = stripcslashes($trimmed_usernameErr);
            $usernameErr_sanitized = htmlspecialchars($unescaped_usernameErr , ENT_QUOTES, 'UTF-8');
            echo '<p class="err_register" id="usernameErr">'.$usernameErr_sanitized.'</p>';
            unset($_SESSION['usernameErr']);
        }

        if(isset($_SESSION['pswErr'])){
            $pswErr_data = $_SESSION["pswErr"];
            $trimmed_pswErr = trim($pswErr_data);
            $unescaped_pswErr = stripcslashes($trimmed_pswErr);
            $pswErr_sanitized = htmlspecialchars($unescaped_pswErr , ENT_QUOTES, 'UTF-8');
            echo '<p class="err_register" id="pswErr">'.$pswErr_sanitized.'</p>';
            unset($_SESSION['pswErr']);
        }

        if(isset($_SESSION['psw_repeatErr'])){
            $psw_repeatErr_data = $_SESSION["psw_repeatErr"];
            $trimmed_psw_repeatErr = trim($psw_repeatErr_data);
            $unescaped_psw_repeatErr = stripcslashes($trimmed_psw_repeatErr);
            $psw_repeatErr_sanitized = htmlspecialchars($unescaped_psw_repeatErr , ENT_QUOTES, 'UTF-8');
            echo '<p class="err_register" id="psw_repeatErr">'.$psw_repeatErr_sanitized.'</p>';
            unset($_SESSION['psw_repeatErr']);
        }

        if(isset($_SESSION['cityErr'])){
            $cityErr_data = $_SESSION["cityErr"];
            $trimmed_cityErr = trim($cityErr_data);
            $unescaped_cityErr = stripcslashes($trimmed_cityErr);
            $cityErr_sanitized = htmlspecialchars($unescaped_cityErr , ENT_QUOTES, 'UTF-8');
            echo '<p class="err_register" id="cittaErr">'.$cityErr_sanitized.'</p>';
            unset($_SESSION['cityErr']);
        }

        if(isset($_SESSION['addressErr'])){
            $addressErr_data = $_SESSION["addressErr"];
            $trimmed_addressErr = trim($addressErr_data);
            $unescaped_addressErr = stripcslashes($trimmed_addressErr);
            $addressErr_sanitized = htmlspecialchars($unescaped_addressErr , ENT_QUOTES, 'UTF-8');
            echo '<p class="err_register" id="indirizzoErr">'.$addressErr_sanitized.'</p>';
            unset($_SESSION['addressErr']);
        }

        if(isset($_SESSION['capErr'])){
            $capErr_data = $_SESSION["capErr"];
            $trimmed_capErr = trim($capErr_data);
            $unescaped_capErr = stripcslashes($trimmed_capErr);
            $capErr_sanitized = htmlspecialchars($unescaped_capErr , ENT_QUOTES, 'UTF-8');
            echo '<p class="err_register" id="capErr">'.$capErr_sanitized.'</p>';
            unset($_SESSION['capErr']);
        }

        if(isset($_SESSION['signup_error'])){
            $signup_error_data = $_SESSION["signup_error"];
            $trimmed_signup_error = trim($signup_error_data);
            $unescaped_signup_error = stripcslashes($trimmed_signup_error);
            $signup_error_sanitized = htmlspecialchars($unescaped_signup_error , ENT_QUOTES, 'UTF-8');
            echo '<p class="err_register" id="signupErr">'.$signup_error_sanitized.'</p>';
            unset($_SESSION['signup_error']);
        }

      ?>
    </div>
  </form>

</div>

<!-- Fine Modal Registrazione -->

