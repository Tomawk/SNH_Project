<?php
    session_start();
    require('../inc/db.php');
?>

<!DOCTYPE HTML>
<html lang="it">
    <body>
        <h2>Recover_password</h2>
        <div class="change_password_div">
            <form action="elaborate_change_password.php" method="post">
                
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="old_password">Old password:</label>
                <input type="text" id="old_password" name="old_password" required>

                <label for="new_password">New password:</label>
                <input type="text" id="new_password" name="new_password" required>

                <button type="submit">Submit</button>
                
            </form>
        </div>
        

        <script>

        </script>

    </body>
</html>
