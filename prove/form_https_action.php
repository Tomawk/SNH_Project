<?php
    session_start();
    require('../inc/db.php');
?>

<!DOCTYPE HTML>
<html lang="it">

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

    <body>
       

        <form action="https://localhost/BookStore/SNH_Project/prove/submit_form.php" method="post">
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" required>

          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>

          <label for="message">Message:</label>
          <textarea id="message" name="message" rows="4" required></textarea>

          <button type="submit">Submit</button>
      </form>


      <div id="vetrina">

      </div>


        <script>
          function sendRequest() {

            var data = new FormData();
            data.append('Search_filed', document.getElementById("field_search").value);
            data.append('Value', document.getElementById("input_field_search").value);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "process_request.php", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                  //document.getElementById("ciao").value = xhr.responseText;
                  //var vetrina = document.getElementById("vetrina");
                  //vetrina.innerHTML = xhr.responseText;
                  jQuery('#vetrina').html(xhr.responseText);
                }
            };
            xhr.send(data);
          }
        </script>

  </body>


</html>


