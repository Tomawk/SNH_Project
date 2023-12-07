<?php
    session_start();
    require('../inc/db.php');
?>

<!DOCTYPE HTML>
<html lang="it">

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<style>
        .product {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 16px;
            margin: 16px;
            width: 200px;
            text-align: center;
        }

        .product img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
            margin-bottom: 8px;
        }

        .product h2 {
            font-size: 1.2em;
            margin-bottom: 8px;
        }

        .product p {
            color: #555;
            font-size: 0.9em;
        }

        .product button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .product button:hover {
            background-color: #45a049;
        }
    </style>

    <body>
        <input type="text" placeholder="inserisci qui" id="input_field_search">
        <input type="button" onclick="sendRequest()">invia</button>
        <select id="field_search">
          <option value="none"></option>
          <option value="ISBN">ISBN</option>
          <option value="author">author</option>
          <option value="name">name</option>
        </select>
        

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


