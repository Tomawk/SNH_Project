function get_info_user(){
    var array;
    var data = new FormData();
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const id = urlParams.get('userid');

        data.append('id', id);
        
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "utility/get_info_user.php", true);
        xhr.onreadystatechange = function () {

            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.responseText.replace("\n","");
                array = response.split("|");
                var p = document.getElementById("password_strength");
                const password = document.getElementById('new_password').value;
                for (var a in array){
                    var element = array[a].toLowerCase();
                    var pwd = password.toLowerCase();
                    if(pwd.includes(element)){p.textContent = "password doesn't have to be equal to the username/name/surname/email";  p.style.color = "red"; p.style.fontSize = "0.8em"}
                }
            }
        }
        xhr.send(data);
}



document.getElementById("submit_button").addEventListener("click", function(event){
    event.preventDefault();
    const new_password = document.getElementById('new_password').value;
    const password = document.getElementById('confirm_password').value;
    const password_old = document.getElementById('old_password').value;

	if(new_password.includes(password_old)) {p.textContent = "password doesn't have to be equal to the old password";  p.style.color = "red"; p.style.fontSize = "0.8em"; return false}
    
    const result = zxcvbn(new_password);
    var guesses = result.guesses_log10;
    if(guesses < 10){
        var p = document.getElementById("password_strength_validation");
        p.textContent = "scrivi una password più forte";
        p.style.color = "red";
        p.style.fontSize = "0.8em";
        event.preventDefault();
        return;
    }
    
    if(new_password.localeCompare(password) != 0){
        //stringhe diverse;
        return;
    }
    document.getElementById("my_form").submit();
});

function controlla_sicurezza_password(){
    const password = document.getElementById('new_password').value;
    const result = zxcvbn(password);
    var guesses = result.guesses_log10;
    var p = document.getElementById("password_strength");

    get_info_user();

    const password_old = document.getElementById('old_password').value;

	if(password.includes(password_old)) {p.textContent = "password doesn't have to be equal to the old password";  p.style.color = "red"; p.style.fontSize = "0.8em"; return false}

    
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


