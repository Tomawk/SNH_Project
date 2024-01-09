function get_info_user(){
    var array;
    var data = new FormData();
        data.append('username', document.getElementById('username').text.trim());

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

function check(){
    const password = document.getElementById('new_password').value;
    const password_old = document.getElementById('old_password').value;
    const username = document.getElementById('username').text.trim();
    

    const result = zxcvbn(password);
    var guesses = result.guesses_log10;
    var p = document.getElementById("password_strength");
	if(password.includes(password_old)) {p.textContent = "password doesn't have to be equal to the old password";  p.style.color = "red"; p.style.fontSize = "0.8em"; return false}
	if(password.includes(username)) {p.textContent = "password doesn't have to be equal to the username";  p.style.color = "red"; p.style.fontSize = "0.8em"; return false}

    var info = get_info_user();
    
    if(guesses <5 ){
        p.textContent = "password debole";
        p.style.color = "red";
        p.style.fontSize = "0.8em";
        return false;
    }
    else if (guesses < 10){
        p.textContent = "password non molto forte";
        p.style.color = "#e67014";
        p.style.fontSize = "0.8em";
        return false;
    }
    else{
        p.textContent = "password forte";
        p.style.color = "green";
        p.style.fontSize = "0.8em";
        return true;
    }
}

document.getElementById("submit_button").addEventListener("click", function(){

    if(!check()){
        return;
    }
    document.getElementById("my_form").submit();
});

function controlla_sicurezza_password(){
    check();
}

