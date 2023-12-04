

function ApriModal(){
	var modal = document.getElementById('myModal');
	modal.style.display = "block";
}

function ChiudiModal(){
	var modal = document.getElementById('myModal');
	modal.style.display = "none";
}

/* gestione impasti */

var ch = document.getElementsByName("impasto");

var sum=3;

var prezzopizza = 3;

var classico = document.getElementById("iclassico");
var integrale = document.getElementById("iintegrale");
var curcuma = document.getElementById("icurcuma");
var grano = document.getElementById("igrano");
 
for( var i = 0; i < ch.length; i++){
    ch[i].onchange = function(){
    	classico.style.display = "none";
    	integrale.style.display = "none";
    	curcuma.style.display = "none";
    	grano.style.display = "none";
        if ( this.checked ) {
        sum = sum - prezzopizza;
        if (this.value == "Classico")  { prezzopizza = 3; classico.style.display = "block"; }
        if (this.value == "Integrale") { prezzopizza = 4; integrale.style.display = "block"; }
        if (this.value == "Senza Glutine")  { prezzopizza = 3; classico.style.display = "block"; }
        if (this.value == "Curcuma")  { prezzopizza = 3.5; curcuma.style.display = "block"; }
        if (this.value == "Grano Saraceno")  { prezzopizza = 3.5;  grano.style.display = "block"; }
        sum += prezzopizza;
        document.getElementById("result").innerHTML = "Prezzo:" + ' ' + sum + '&euro;';

    }
}
}

/* gestione salsa */

var dh = document.getElementsByName("tomato");

var prezzotomato = 0;

var salsa = document.getElementById("tpomodoro");

for( var i = 0; i < dh.length; i++){
    dh[i].onchange = function(){
    	salsa.style.display = "none";
        if(this.checked) { 
       	sum = sum - prezzotomato;
       	if (this.value == "Nessuno")  { prezzotomato = 0; }
        if (this.value == "Pomodoro") { prezzotomato = 1; salsa.style.display = "block"; }
       	sum += prezzotomato;
        document.getElementById("result").innerHTML = "Prezzo:" + ' ' + sum + '&euro;';
    	}
    }
}
/* gestione formaggio */

var eh = document.getElementsByName("cheese");

var prezzocheese = 0;

var mozzarella = document.getElementById("cmozzarella");

for( var i = 0; i < eh.length; i++){
    eh[i].onchange = function(){
    	mozzarella.style.display = "none";
        if(this.checked) {  
        sum = sum - prezzocheese;
        if (this.value == "Nessuno") { prezzocheese= 0;}
       	if (this.value == "Mozzarella") { prezzocheese= 2; mozzarella.style.display = "block"; }
       	if (this.value == "Bufala") { prezzocheese= 3; mozzarella.style.display = "block"; }
       	if (this.value == "Mozzarella (- grassi)") { prezzocheese= 2.5; mozzarella.style.display = "block"; }
       	sum += prezzocheese;
        document.getElementById("result").innerHTML = "Prezzo:" + ' ' + sum + '&euro;';
   	   }
    }
}

/* gestione ingredienti */

var fh = document.getElementsByClassName("ingredients");

var capperi = document.getElementById("icapperi");
var pomodorini = document.getElementById("ipomodorini");
var peperoni = document.getElementById("ipeperoni");
var funghi = document.getElementById("ifunghi");
var rucola = document.getElementById("irucola");
var salamino = document.getElementById("isalamino");
var patatine = document.getElementById("ipatatine");
var cipolla = document.getElementById("icipolla");
var bacon = document.getElementById("ibacon");
var acciughe = document.getElementById("iacciughe");
var pcotto = document.getElementById("ipcotto");
var olive = document.getElementById("iolive");
var wurstel = document.getElementById("iwurstel");
var origano = document.getElementById("iorigano");
var basilico = document.getElementById("ibasilico");

for( var i=0; i < fh.length; i++){
	fh[i].onclick = function(){
		if(this.checked){
			if (this.value == "capperi")  { sum += 0.5; capperi.style.display = "block";}
			if (this.value == "pomodorini") { sum += 0.5; pomodorini.style.display = "block";}
			if (this.value == "peperoni") { sum += 1; peperoni.style.display = "block";}
			if (this.value == "funghi") { sum += 1; funghi.style.display = "block";}
			if (this.value == "rucola") { sum += 0.5; rucola.style.display = "block";}
			if (this.value == "salamino") { sum += 1; salamino.style.display = "block";}
			if (this.value == "patatine") { sum += 1; patatine.style.display = "block";}
			if (this.value == "cipolla") { sum += 0.5; cipolla.style.display = "block";}
			if (this.value == "bacon") { sum += 1.5; bacon.style.display = "block";}
			if (this.value == "acciughe") { sum += 1.5; acciughe.style.display = "block";}
			if (this.value == "pcotto") { sum += 1.5; pcotto.style.display = "block";}
			if (this.value == "olive") { sum += 0.5; olive.style.display = "block";}
			if (this.value == "wurstel") { sum += 1.5; wurstel.style.display = "block";}
			if (this.value == "origano") { sum += 0.5; origano.style.display = "block";}
			if (this.value == "basilico")  { sum += 0.5; basilico.style.display = "block";}
			document.getElementById("result").innerHTML = "Prezzo:" + ' ' + sum + '&euro;';
		}
		else{
			if (this.value == "capperi")  { sum -= 0.5; capperi.style.display = "none";}
			if (this.value == "pomodorini") { sum -= 0.5; pomodorini.style.display = "none";}
			if (this.value == "peperoni") { sum -= 1; peperoni.style.display = "none";}
			if (this.value == "funghi") { sum -= 1; funghi.style.display = "none";}
			if (this.value == "rucola") { sum -= 0.5; rucola.style.display = "none";}
			if (this.value == "salamino") { sum -= 1; salamino.style.display = "none";}
			if (this.value == "patatine") { sum -= 1; patatine.style.display = "none";}
			if (this.value == "cipolla") { sum -= 0.5; cipolla.style.display = "none";}
			if (this.value == "bacon") { sum -= 1.5; bacon.style.display = "none";}
			if (this.value == "acciughe") { sum -= 1.5; acciughe.style.display = "none";}
			if (this.value == "pcotto") { sum -= 1.5; pcotto.style.display = "none";}
			if (this.value == "olive") { sum -= 0.5; olive.style.display = "none";}
			if (this.value == "wurstel") { sum -= 1.5; wurstel.style.display = "none";}
			if (this.value == "origano") { sum -= 0.5; origano.style.display = "none";}
			if (this.value == "basilico")  { sum -= 0.5; basilico.style.display = "none";}
			document.getElementById("result").innerHTML = "Prezzo:" + ' ' + sum + '&euro;';
		}
	}
}

function submitForms(){  /* unico submit per 4 forms */
    document.getElementById("form1").submit();
    document.getElementById("form2").submit();
    document.getElementById("form3").submit();
    document.getElementById("form4").submit();
}

function scrollup(){
    window.scrollTo(0,0);
  }


/* Funzioni per apertura modal utente */

var modal2 = document.getElementById('id03');

function openmodal2(){
  modal2.style.display='block';
}

function closemodal2(){
  modal2.style.display='none';
}
/* ----------------------------------- */
  
/*  per le checkbox (validation)
var checkedValue = null; 
var inputElements = document.getElementsByName('q6');
for(var i=0; inputElements[i]; ++i){
  if(inputElements[i].checked){
    checkedValue = inputElements[i].value;
    break;
  }
}

per i radio button (validation)
 var q5 = document.forms["quizForm"]["q5"].value;
*/
