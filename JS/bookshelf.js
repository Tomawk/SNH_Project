 function sendRequest() {

        var data = new FormData();
        data.append('Search_filed', document.getElementById("field_search").value);
        data.append('Value', document.getElementById("input_field_search").value);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "utility/filtering_books.php", true);
        
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
              jQuery('#vetrina').html(xhr.responseText);
            }
        };
        xhr.send(data);
    }

    function AddToCart(i){
        var container = document.getElementById(i);
        var ISBN = container.childNodes[7].childNodes[1].textContent;
        //send data

        var data = new FormData();
        data.append('ISBN', ISBN);
        if(document.body.contains(document.getElementById("username")))
            user = document.getElementById("username").textContent;
        else
            user = "";
        console.log(typeof user);
        console.log(user.replaceAll(' ',''));
        //data.append('username',<?php echo "'".$_SESSION['username']."'"?>);
        data.append('username',user.replaceAll(' ',''));


        var xhr = new XMLHttpRequest();
        xhr.open("POST", "utility/add_to_cart.php", true);

        xhr.onreadystatechange = function () {
           if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
            //aggiunto al carrello
            if(xhr.responseText == 0){
                alert("Riprova, qualcosa è andato storto")
            }
            else{
                var button = container.childNodes[15];
                var testo = button.childNodes[0];
                testo.textContent = 'Aggiunto';
                testo.style.color = 'green';

                setInterval(function(){
                    testo.textContent = 'Add to cart';
                    testo.style.color = 'black';
                }, 2000);
            }
           }
       };
       xhr.send(data);

       var item = document.getElementById("item_nel_carrello");
       num = parseInt(item.textContent.substr(1,item.textContent.length))+1;
       item.textContent = "("+num+")";
    }
