/* setta la data corrente nella date form */

	var date = new Date();

	var day = date.getDate();
	var month = date.getMonth() + 1;
	var year = date.getFullYear();

	if (month < 10) month = "0" + month;
	if (day < 10) day = "0" + day;

	var today = year + "-" + month + "-" + day; 
    document.getElementById("theDate").defaultValue = today;
    document.getElementById("theDate").min = today;


/* funzione scroll verso l'alto */

	function scrollup(){
		window.scrollTo(0,0);
	}

	function scrollpromozioni(){
		window.scrollTo(0,1020);
	}

	function scrollprenotazione(){
		window.scrollTo(0,2200);
	}

	function scrollcontatti(){
		window.scrollTo(0,2590);
	}


	function closeAlert(){
		var node = document.getElementById('alertbox');
		while (node.hasChildNodes()) {
    	node.removeChild(node.firstChild);
		}
		var alert_x = document.getElementById("alertbox");
		alert_x.style.display = "none";
	}

	function validatedate(date) { /* Funzione per validare email */
  	var regex_date = /^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$/;
  	return regex_date.test(date);
	}


	var element = document.getElementById('firstname');
	var element_date = document.getElementById('theDate')

	element.addEventListener('webkitAnimationEnd', function(){ 
   	 this.style.webkitAnimationName = '';
	}, false);

	element.addEventListener('animationend', function(){ 
   	 this.style.animationName = '';
	}, false);

	element_date.addEventListener('webkitAnimationEnd', function(){ 
   	 this.style.webkitAnimationName = '';
	}, false);

	element_date.addEventListener('animationend', function(){ 
   	 this.style.animationName = '';
	}, false);

	function validateForm(){
	var _name = document.forms["myForm"]["firstname"].value; /* nome inserito */
	var _date = document.forms["myForm"]["theDate"].value;
	var withoutSpace = _name.replace(/ /g,""); /* rimuovo gli spazi bianchi */
	var _length = withoutSpace.length; /* conta i caratteri */
	var alert_x = document.getElementById("alertbox"); /* variabile supporto alertbox */
	if(!validatedate(_date)) {
		closeAlert(); /* svuota l'alert box */
		alert_x.style.display = "block"; /* fa apparire l'alert */
		alert_x.style.backgroundColor = "#ff9741";
		document.getElementById('alertbox').innerHTML += 'Warning: La data inserita non &egrave; nel formato corretto (yyyy-mm-dd)'; /* scrive nell'alert */
		document.getElementById("theDate").style.webkitAnimation = "shake .5s"; /*animazione keyframe shake sull'input*/
		document.getElementById("theDate").style.animation = "shake .5s"; /*animazione keyframe shake sull'input*/
		document.getElementById("theDate").style.backgroundColor = "#f44336"; /* setta colore input a red */
		return false;
	}
	else if (today > _date){
		closeAlert(); /* svuota l'alert box */
		alert_x.style.display = "block"; /* fa apparire l'alert */
		alert_x.style.backgroundColor = "#ff9741";
		document.getElementById('alertbox').innerHTML += 'Warning: Non puoi inserire una data gi&agrave; passata'; /* scrive nell'alert */
		document.getElementById("theDate").style.webkitAnimation = "shake .5s"; /*animazione keyframe shake sull'input*/
		document.getElementById("theDate").style.animation = "shake .5s"; /*animazione keyframe shake sull'input*/
		document.getElementById("theDate").style.backgroundColor = "#f44336"; /* setta colore input a red */
		return false;
	}
	else if ( _length < 3 || _length > 10) {
		document.getElementById("theDate").style.backgroundColor = "white";
		closeAlert(); /* svuota l'alert box */
		alert_x.style.display = "block"; /* fa apparire l'alert */
		alert_x.style.backgroundColor = "#ff9741"; 
		document.getElementById('alertbox').innerHTML += 'Warning: Impossibile inserire un nome con meno di 3 caratteri o con pi&ugrave; di 10!'; /* scrive nell'alert */
		document.getElementById("firstname").style.webkitAnimation = "shake .5s"; /*animazione keyframe shake sull'input*/
		document.getElementById("firstname").style.animation = "shake .5s"; /*animazione keyframe shake sull'input*/
		document.getElementById("firstname").style.backgroundColor = "#f44336"; /* setta colore input a red */
		return false;
	}
		else {
		 return true;
		}

	}

// MODAL SCRIPT //

// Get the modal
var modal = document.getElementById('id01');
var modal1 = document.getElementById('id02');
var modal2 = document.getElementById('id03');
var modal3 = document.getElementById('id04');

function openmodal(){
	modal.style.display='block';
}

function closemodal(){
	modal.style.display='none';
}

// Chiudi modal quando clicchi al di fuori del modal
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function openmodal1(){
	modal1.style.display='block';
}

function closemodal1(){
	modal1.style.display='none';
}

function openmodal2(){
	modal2.style.display='block';
}

function closemodal2(){
	modal2.style.display='none';
}

// Chiudi modal1 quando clicchi al di fuori del modal
window.onclick = function(event) {
    if (event.target == modal1) {
        modal1.style.display = "none";
    }
}


	function validateEmail(email) { /* Funzione per validare email */
  	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  	return re.test(email);
	}


	function validateNameInput(nomeinput){
		var reex = /^[a-zA-Z0-9]{2,10}$/;
		return reex.test(nomeinput);
	}

	function validatePassword(password){
		var rex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;
		return rex.test(password);
	}

	function validateCAP(cap){
		var regex = /^\d{5,5}$/;
		return regex.test(cap);
	}


	var element_email = document.getElementById('modal1_email');

	element_email.addEventListener('webkitAnimationEnd', function(){ 
   	 this.style.webkitAnimationName = '';
	}, false);

	element_email.addEventListener('animationend', function(){ 
   	 this.style.animationName = '';
	}, false);

	document.getElementById('modal1_nome').addEventListener('webkitAnimationEnd', function(){ 
   	 this.style.webkitAnimationName = '';
	}, false);

	document.getElementById('modal1_nome').addEventListener('animationend', function(){ 
   	 this.style.animationName = '';
	}, false);

	document.getElementById('modal1_surname').addEventListener('webkitAnimationEnd', function(){ 
   	 this.style.webkitAnimationName = '';
	}, false);

	document.getElementById('modal1_surname').addEventListener('animationend', function(){ 
   	 this.style.animationName = '';
	}, false);

	document.getElementById('modal1_password').addEventListener('webkitAnimationEnd', function(){ 
   	 this.style.webkitAnimationName = '';
	}, false);

	document.getElementById('modal1_password').addEventListener('animationend', function(){ 
   	 this.style.animationName = '';
	}, false);

	document.getElementById('modal1_repeat').addEventListener('webkitAnimationEnd', function(){ 
   	 this.style.webkitAnimationName = '';
	}, false);

	document.getElementById('modal1_repeat').addEventListener('animationend', function(){ 
   	 this.style.animationName = '';
	}, false);

	document.getElementById('modal1_cap').addEventListener('webkitAnimationEnd', function(){ 
   	 this.style.webkitAnimationName = '';
	}, false);

	document.getElementById('modal1_cap').addEventListener('animationend', function(){ 
   	 this.style.animationName = '';
	}, false);


	function validateFormRegister(){

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

	var _nomeform = document.forms["register"]["nome"].value; /* Nome inserito */

	if(!validateNameInput(_nomeform)){ /* Controlla nome dai 4 ai 10 caratteri composto solo da caratteri alfanumerici */
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

	var _cognome = document.forms["register"]["surname"].value; /* Cognome inserito */

	if(!validateNameInput(_cognome)){ /* Controlla cognome dai 4 ai 10 caratteri composto solo da caratteri alfanumerici */
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

	var _password = document.forms["register"]["psw"].value; /* Password inserita */

	if(!validatePassword(_password)){ /* Controlla password, almeno 8 caratteri di cui una lettera, un numero e un carattere speciale*/
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

	if(errore_ == false) return false;
		else return true;
	

	}

