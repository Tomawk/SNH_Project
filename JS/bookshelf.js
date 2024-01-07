function encodeHTML(s) {
    return s.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/"/g, '&quot;');
}
 
 function sendRequest() {

        var data = new FormData();
        data.append('Search_filed', document.getElementById("field_search").value);
        data.append('Value', document.getElementById("input_field_search").value);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "utility/filtering_books.php", true);
        xhr.onreadystatechange = function () {

            if (xhr.readyState == 4 && xhr.status == 200) {
                jQuery('#vetrina').html("");
                var elementi = "";
                var response = xhr.responseText.replace("\n","");
                const array = response.split("|");

            for(var i in array){
                
                if(array[i] == "<div class='article_line'>"){
                    var div = "<div class='article_line'>";
                    elementi = elementi.concat(div);
                    continue;
                }
                if(array[i] == '</div>' || array[i] == '</div>\n'){
                    var div = '</div>';
                    elementi = elementi.concat(div);
                    continue;
                }
                if(array[i] == 'end_end'){
                    continue;
                }
                if(array[i].includes("start_start")){
                    var text0 = "<div class='article_box'>";
                    var text1 = text0.concat("<div class='book_image' style='background-image: url(",encodeHTML(array[++i]),");'></div>");
                    var text2 = text1.concat("<div class='book_title'>",encodeHTML(array[++i]),"</div>");
                    var text3 = text2.concat("<div class='book_author'>Di <p style='display:inline; text-decoration: underline'>",encodeHTML(array[++i]),"</div>");
                    var text4 = text3.concat("<div class='book_isbn'> ISBN: <p style='display:inline; font-weight: normal;'>",encodeHTML(array[++i]),"</div>");
                    var text5 = text4.concat("<div class='book_genre'> Genre: <p style='display:inline; font-weight: normal;'>",encodeHTML(array[++i]),"</div>");
                    var text6 = text5.concat("<div class='book_date'> Year: <p style='display:inline; font-weight: normal;'>",encodeHTML(array[++i]),"</p></div>");
                    var text7 = text6.concat("<div class='book_price'>",encodeHTML(array[++i]),"€</div>");
                    var text8 = text7.concat("<button type='submit' class='book_button'>Add to cart <i class='fa-solid fa-cart-shopping'></i></button>");
                    var text9 = text8.concat("</div>");

                    elementi = elementi.concat(text9);
                    i += 9;
                    
                }
            }
            jQuery('#vetrina').append(elementi);
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
        data.append('username',user.replaceAll(' ',''));


        var xhr = new XMLHttpRequest();
        xhr.open("POST", "utility/add_to_cart.php", true);

        xhr.onreadystatechange = function () {
           if (xhr.readyState == 4 && xhr.status == 200) {
            if(xhr.responseText == 0){
                alert("Retry something went wrong");
            }
            else{
                var button = container.childNodes[15];
                var testo = button.childNodes[0];
                testo.textContent = 'Aggiunto';
                testo.style.color = 'green';

                setInterval(function(){
                    testo.textContent = 'Add to cart';
                    testo.style.color = 'black';
                }, 1000);
            }
           }
       };
       xhr.send(data);

       var item = document.getElementById("item_nel_carrello");
       num = parseInt(item.textContent.substr(1,item.textContent.length))+1;
       item.textContent = "("+num+")";
    }
