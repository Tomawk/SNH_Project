document.getElementById("submit_button").addEventListener("click", function(event){
    event.preventDefault();
    const password = document.getElementById('new_password').value;
    // a strong password is asd..lòàù#
    const result = zxcvbn(password);
    var guesses = result.guesses_log10;
    if(guesses < 10){
        var p = document.getElementById("password_strength_validation");
        p.textContent = "scrivi una password più forte";
        p.style.color = "red";
        p.style.fontSize = "0.8em";
        event.preventDefault();
        return;
    }
    document.getElementById("my_form").submit();
});

function controlla_sicurezza_password(){
    const password = document.getElementById('new_password').value;
    const result = zxcvbn(password);
    var guesses = result.guesses_log10;
    var p = document.getElementById("password_strength");
    if(guesses <5 ){
        p.textContent = "password debole";
        p.style.color = "red";
        p.style.fontSize = "0.8em";
    }
    else if (guesses < 10){
        p.textContent = "password non molto forte";
        p.style.color = "#e67014";
        p.style.fontSize = "0.8em";
    }
    else{
        p.textContent = "password forte";
        p.style.color = "green";
        p.style.fontSize = "0.8em";
    }
}