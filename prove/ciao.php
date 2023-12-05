<?php
    session_start();
    require('inc/db.php');
?>


<!DOCTYPE HTML>
<html lang="it">
    <body>
        <input type="text" placeholder="inserisci qui">
        <input type="button" onclick="sendRequest()">invia</button>

     <script>
        function sendRequest() {
          // You can use AJAX to send a request to the server
          var xhr = new XMLHttpRequest();
          xhr.open("GET", "process_request.php", true);
          xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
              alert(xhr.responseText);
            }
          };
          xhr.send();
    }
  </script>

    </body>
</html>