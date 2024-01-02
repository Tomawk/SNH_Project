
function validateEmail(email) { /* Funzione per validare email */
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}


function handleRecoverPassword(){
    event.preventDefault();

    var email_input = document.getElementById("email");

    var _email = document.getElementById("email").value;

    //remove animation if present

    email_input.addEventListener('webkitAnimationEnd', function(){
        this.style.webkitAnimationName = '';
    }, false);

    email_input.addEventListener('animationend', function(){
        this.style.animationName = '';
    }, false);

    email_input.style.backgroundColor = "white"; /* setta colore input a red */
    document.getElementById("error_email_input").style.display='none';

    //Client-side validation

    if(!validateEmail(_email)){
        email_input.style.webkitAnimation = "shake .5s"; /*animazione keyframe shake sull'input*/
        email_input.style.backgroundColor = "#f44336"; /* setta colore input a red */
        email_input.focus();
        document.getElementById("error_email_input").style.display='block';
        event.preventDefault(); /* impedisce il refresh della pagina */
        return;
    } else{
        var data = new FormData();
        data.append('email', _email);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "utility/elaborateAccountRecovery.php", true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                if(parseInt(xhr.responseText) == 1){
                    jQuery('#result').html("Email sent");
                    jQuery("#result").css("color", "green");
                }else{
                    jQuery('#result').html("Recovery problem");
                    jQuery("#result").css("color", "red");
                }
            }
        };
        xhr.send(data);
    }

  }