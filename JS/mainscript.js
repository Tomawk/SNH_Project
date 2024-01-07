/* funzione scroll verso l'alto */

	function scrollup(){
		window.scrollTo(0,0);
	}

	function validateEmail(email) { /* Funzione per validare email */
  	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  	return re.test(email);
	}


	function validateNameInput(nameinput){
		var reex = /^[a-zA-Z]{2,10}$/;
		return reex.test(nameinput);
	}

	function validatePassword(password){
		var rex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;
		return rex.test(password);
	}

	function validateCAP(cap){
		var regex = /^\d{5,5}$/;
		return regex.test(cap);
	}

	function validateUsername(username){
		var regex = /^[a-zA-Z0-9!?£$èòàù_.,]+$/;
		return regex.test(username)
	}

	function resetAnimations(){

		document.getElementById('modal1_email').style.animation = 'none';
		document.getElementById('modal1_email').offsetHeight; /* trigger reflow */
		document.getElementById('modal1_email').style.animation = null;

		document.getElementById('modal1_uname').style.animation = 'none';
		document.getElementById('modal1_uname').offsetHeight; /* trigger reflow */
		document.getElementById('modal1_uname').style.animation = null;

		document.getElementById('modal1_nome').style.animation = 'none';
		document.getElementById('modal1_nome').offsetHeight; /* trigger reflow */
		document.getElementById('modal1_nome').style.animation = null;

		document.getElementById('modal1_surname').style.animation = 'none';
		document.getElementById('modal1_surname').offsetHeight; /* trigger reflow */
		document.getElementById('modal1_surname').style.animation = null;

		document.getElementById('modal1_password').style.animation = 'none';
		document.getElementById('modal1_password').offsetHeight; /* trigger reflow */
		document.getElementById('modal1_password').style.animation = null;

		document.getElementById('modal1_repeat').style.animation = 'none';
		document.getElementById('modal1_repeat').offsetHeight; /* trigger reflow */
		document.getElementById('modal1_repeat').style.animation = null;

		document.getElementById('modal1_cap').style.animation = 'none';
		document.getElementById('modal1_cap').offsetHeight; /* trigger reflow */
		document.getElementById('modal1_cap').style.animation = null;
	}

	function validateFormRegister(){

	resetAnimations();

	var errore_ = true;

	var _email = document.forms["register"]["email"].value; /* email inserita */

	if(!validateEmail(_email)){
		document.getElementById("modal1_email").style.webkitAnimation = "shake .5s"; /*animazione keyframe shake sull'input*/
		document.getElementById("modal1_email").style.backgroundColor = "#f44336"; /* setta colore input a red */
		element_email.focus();
		document.getElementById("error_email").style.display='block';
		event.preventDefault(); /* impedisce il refresh della pagina */
		errore_=false;
	}
		else {
			document.getElementById("error_email").style.display='none';
			document.getElementById("modal1_email").style.backgroundColor='white';
		}

	var _nameform = document.forms["register"]["name"].value; /* Nome inserito */

	if(!validateNameInput(_nameform)){ /* Controlla nome dai 2 ai 10 caratteri composto solo da caratteri alfanumerici */
		document.getElementById("modal1_nome").style.webkitAnimation = "shake .5s"; /*animazione keyframe shake sull'input*/
		document.getElementById("modal1_nome").style.backgroundColor = "#f44336"; /* setta colore input a red */
		document.getElementById("modal1_nome").focus();
		document.getElementById("error_nome").style.display='block';
		event.preventDefault();
		errore_=false;
	}
		else {
			document.getElementById("error_nome").style.display='none';
			document.getElementById("modal1_nome").style.backgroundColor='white';
		}

	var _surname = document.forms["register"]["surname"].value; /* Cognome inserito */

	if(!validateNameInput(_surname)){ /* Controlla cognome dai 2 ai 10 caratteri composto solo da caratteri alfanumerici */
		document.getElementById("modal1_surname").style.webkitAnimation = "shake .5s"; /*animazione keyframe shake sull'input*/
		document.getElementById("modal1_surname").style.backgroundColor = "#f44336"; /* setta colore input a red */
		document.getElementById("modal1_surname").focus();
		document.getElementById("error_surname").style.display='block';
		event.preventDefault();
		errore_=false;
	}
		else {
			document.getElementById("error_surname").style.display='none';
			document.getElementById("modal1_surname").style.backgroundColor='white';
		}

	var _uname = document.forms["register"]["uname"].value;

	if (_uname.length <= 2 || _uname.length > 10 || !validateUsername(_uname)){
		document.getElementById("modal1_uname").style.webkitAnimation = "shake .5s"; /*animazione keyframe shake sull'input*/
		document.getElementById("modal1_uname").style.backgroundColor = "#f44336"; /* setta colore input a red */
		document.getElementById("modal1_uname").focus();
		document.getElementById("error_username").style.display='block';
		event.preventDefault();
		errore_=false;
	} else{
		document.getElementById("error_username").style.display='none';
		document.getElementById("modal1_uname").style.backgroundColor='white';
	}

	var _password = document.forms["register"]["psw"].value; /* Password inserita */

	if(!validatePassword(_password) || _password.length > 255){ /* Controlla password, almeno 8 caratteri di cui una lettera maiuscola, una minuscola e un numero*/
		document.getElementById("modal1_password").style.webkitAnimation = "shake .5s"; /*animazione keyframe shake sull'input*/
		document.getElementById("modal1_password").style.backgroundColor = "#f44336"; /* setta colore input a red */
		document.getElementById("modal1_password").focus();
		document.getElementById("error_password").style.display='block';
		event.preventDefault();
		errore_=false;
	}
		else {
			document.getElementById("error_password").style.display='none';
			document.getElementById("modal1_password").style.backgroundColor='white';
		}

	var psw_repeat = document.forms["register"]["psw-repeat"].value; /* Password Ripetuta inserita */

	if(psw_repeat != _password){
		document.getElementById("modal1_repeat").style.webkitAnimation = "shake .5s"; /*animazione keyframe shake sull'input*/
		document.getElementById("modal1_repeat").style.backgroundColor = "#f44336"; /* setta colore input a red */
		document.getElementById("modal1_repeat").focus();
		document.getElementById("error_repeat").style.display='block';
		event.preventDefault();
		errore_=false;
	}
		else {
			document.getElementById("error_repeat").style.display='none';
			document.getElementById("modal1_repeat").style.backgroundColor='white';
		}

	var _cap = document.forms["register"]["cap"].value; /* CAP inserito */

	if(!validateCAP(_cap)){
		document.getElementById("modal1_cap").style.webkitAnimation = "shake .5s"; /*animazione keyframe shake sull'input*/
		document.getElementById("modal1_cap").style.backgroundColor = "#f44336"; /* setta colore input a red */
		document.getElementById("modal1_cap").focus();
		document.getElementById("error_cap").style.display='block';
		event.preventDefault();
		errore_=false;
	}
		else {
			document.getElementById("error_cap").style.display='none';
			document.getElementById("modal1_cap").style.backgroundColor='white';
		}

	var _city = document.forms["register"]["city"].value; /* city inserita */

	if(!validateNameInput(_city)){
		document.getElementById("modal1_city").style.webkitAnimation = "shake .5s"; /*animazione keyframe shake sull'input*/
		document.getElementById("modal1_city").style.backgroundColor = "#f44336"; /* setta colore input a red */
		document.getElementById("modal1_city").focus();
		document.getElementById("error_city").style.display='block';
		event.preventDefault();
		errore_=false;
	} else{
		document.getElementById("error_city").style.display='none';
		document.getElementById("modal1_city").style.backgroundColor='white';
	}

	if(errore_ == false) return false;
		else return true;
	}


function validateFormChangePsw(){

	var errore_ = true;

	var _password = document.forms["change_psw"]["new_password"].value; /* Nuova Password inserita */

	if(!validatePassword(_password) || _password.length > 255){ /* Controlla password, almeno 8 caratteri di cui una lettera maiuscola, una minuscola e un numero*/
		document.getElementById("new_password").style.webkitAnimation = "shake .5s"; /*animazione keyframe shake sull'input*/
		document.getElementById("new_password").style.backgroundColor = "#f44336"; /* setta colore input a red */
		document.getElementById("new_password").focus();
		document.getElementById("error_password").style.display='block';
		event.preventDefault();
		errore_=false;
	}
	else {
		document.getElementById("error_password").style.display='none';
		document.getElementById("new_password").style.backgroundColor='white';
	}

	if(errore_ == false) return false;
	else return true;
}

function validateDynamicChangePSW(){
	// a strong password for debug purposes is -> Asdfghjk1lkgtyio
	var errore_ = true;

	var _password = document.forms["dynamic_psw_form"]["new_password"].value; /* Nuova Password inserita */
	var _rep_password = document.forms["dynamic_psw_form"]["confirm_password"].value; /* Nuova Password inserita */

	if(!validatePassword(_password) || _password.length > 255){ /* Controlla password, almeno 8 caratteri di cui una lettera maiuscola, una minuscola e un numero*/
		document.getElementById("new_password").style.webkitAnimation = "shake .5s"; /*animazione keyframe shake sull'input*/
		document.getElementById("new_password").style.backgroundColor = "#f44336"; /* setta colore input a red */
		document.getElementById("new_password").focus();
		document.getElementById("error_password").style.display='block';
		event.preventDefault();
		errore_=false;
	}
	else {
		document.getElementById("error_password").style.display='none';
		document.getElementById("new_password").style.backgroundColor='white';
	}

	if(_password != _rep_password){
		document.getElementById("confirm_password").style.webkitAnimation = "shake .5s"; /*animazione keyframe shake sull'input*/
		document.getElementById("confirm_password").style.backgroundColor = "#f44336"; /* setta colore input a red */
		document.getElementById("confirm_password").focus();
		document.getElementById("error_confirm_password").style.display='block';
		event.preventDefault();
		errore_=false;
	}

	const new_password = document.getElementById('new_password').value;
	const result = zxcvbn(new_password);
	var guesses = result.guesses_log10;
    if(guesses < 10){
		console.log("no");
		document.getElementById("new_password").style.webkitAnimation = "shake .5s"; /*animazione keyframe shake sull'input*/
		document.getElementById("new_password").style.backgroundColor = "#f44336"; /* setta colore input a red */
		document.getElementById("new_password").focus();
		document.getElementById("error_password").style.display='block';
		event.preventDefault();
		errore_=false;
	}


	if(errore_ == false) return false;
	else return true;
}


function controlla_sicurezza_password_register_form(){
    const password = document.getElementById('modal1_password').value;
    const result = zxcvbn(password);
    var guesses = result.guesses_log10;
    var p = document.getElementById("error_password_zxcvbn");
    if(guesses <5 ){
        p.textContent = "password is weak";
        p.style.color = "red";
        p.style.fontSize = "0.8em";
    }
    else if (guesses < 10){
        p.textContent = "password not very strong";
        p.style.color = "#e67014";
        p.style.fontSize = "0.8em";
    }
    else{
        p.textContent = "password strong";
        p.style.color = "green";
        p.style.fontSize = "0.8em";
    }
}