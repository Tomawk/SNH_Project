
function validateEmail(email) { /* Funzione per validare email */
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function validateUsername(username){
    var regex = /^[a-zA-Z0-9!?£$èòàù_.,]+$/;
    return regex.test(username)
}

function handleRecoverPassword(){
    event.preventDefault();

    var error = 0;

    var email = document.getElementById('email').value;
    var username = document.getElementById('username').value;
    //Client-side validation

    if(!validateEmail(email)){
        document.getElementById("email").style.webkitAnimation = "shake .5s"; /*animazione keyframe shake sull'input*/
        document.getElementById("email").style.backgroundColor = "#f44336"; /* setta colore input a red */
        document.getElementById("email").focus();
        document.getElementById("error_email_input").style.display='block';
        error = 1;
        event.preventDefault(); /* impedisce il refresh della pagina */
    }else {
        document.getElementById("email").style.backgroundColor = "white"; /* setta colore input a red */
        document.getElementById("error_email_input").style.display='none';
    }

    if (username.length <= 2 || username.length > 10 || !validateUsername(username)) {
        document.getElementById("username").style.webkitAnimation = "shake .5s"; /*animazione keyframe shake sull'input*/
        document.getElementById("username").style.backgroundColor = "#f44336"; /* setta colore input a red */
        document.getElementById("username").focus();
        document.getElementById("error_username_input").style.display='block';
        error = 1;
        event.preventDefault(); /* impedisce il refresh della pagina */
    }else {
        document.getElementById("username").style.backgroundColor = "white"; /* setta colore input a red */
        document.getElementById("error_username_input").style.display='none';
    }

    if (error == 0){

            var data = new FormData();
                data.append('username', username);
                data.append('email', email);

                var xhr = new XMLHttpRequest();
                xhr.open("POST", "utility/send_request_password_change.php", true);

                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {

                        if(parseInt(xhr.responseText) == 1){
                            jQuery('#result').html("Email sent");
                            jQuery("#result").css("color", "green");
                        }else{
                            jQuery('#result').html("An error occurred");
                            jQuery("#result").css("color", "red");
                        }
                    }
                };
                xhr.send(data);

    }
}