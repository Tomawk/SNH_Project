
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

    var email_input = document.getElementById("email");
    var email = document.getElementById("email").value;

    var username_input = document.getElementById("username");
    var username = document.getElementById("username").value;

    //remove animation if present

    email_input.addEventListener('webkitAnimationEnd', function(){
        this.style.webkitAnimationName = '';
    }, false);

    email_input.addEventListener('animationend', function(){
        this.style.animationName = '';
    }, false);

    email_input.style.backgroundColor = "white"; /* setta colore input a red */
    document.getElementById("error_email_input").style.display='none';

    username_input.addEventListener('webkitAnimationEnd', function(){
        this.style.webkitAnimationName = '';
    }, false);

    username_input.addEventListener('animationend', function(){
        this.style.animationName = '';
    }, false);

    username_input.style.backgroundColor = "white"; /* setta colore input a red */
    document.getElementById("error_username_input").style.display='none';

    //Client-side validation

    if(!validateEmail(email)){
        email_input.style.webkitAnimation = "shake .5s"; /*animazione keyframe shake sull'input*/
        email_input.style.backgroundColor = "#f44336"; /* setta colore input a red */
        email_input.focus();
        document.getElementById("error_email_input").style.display='block';
        event.preventDefault(); /* impedisce il refresh della pagina */
    } else if (username.length < 2 || username.length > 10 || !validateUsername(username)) {
        username_input.style.webkitAnimation = "shake .5s"; /*animazione keyframe shake sull'input*/
        username_input.style.backgroundColor = "#f44336"; /* setta colore input a red */
        username_input.focus();
        document.getElementById("error_username_input").style.display='block';
        event.preventDefault(); /* impedisce il refresh della pagina */
    } else {

            var data = new FormData();
                data.append('username', username);
                data.append('email', email);

                var xhr = new XMLHttpRequest();
                xhr.open("POST", "utility/send_request_password_change.php", true);

                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {

                        if(parseInt(xhr.responseText) == 1){
                            jQuery('#result').html("Email sent, the link will expire in 5 minutes");
                            jQuery("#result").css("color", "green");
                        }else{
                            jQuery('#result').html("Error Recovery");
                            jQuery("#result").css("color", "red");
                        }
                    }
                };
                xhr.send(data);

    }
}