<?php
    session_start();
    require('../inc/db.php');
?>

<!DOCTYPE HTML>
<html lang="it">
    <body>
        <h2>Recover_password</h2>
        <div class="recover_password_div">
            <form action="elaborate_forgotten_password.php" method="post">
                
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <button type="submit">Submit</button>
                
            </form>
        </div>
        
    </body>
</html>
