var modal2 = document.getElementById('id03');
var modal3 = document.getElementById('id04');

function openmodal(){
	var modal = document.getElementById('id01');
	modal.style.display='block';
}

function closemodal(){
	var modal = document.getElementById('id01');
	modal.style.display='none';
}

function openmodal1(){
	var modal1 = document.getElementById('id02');
	modal1.style.display='block';
}

function closemodal1(){
	var modal1 = document.getElementById('id02');
	modal1.style.display='none';
}

function openmodal2(){
	var modal1 = document.getElementById('id02');
	modal2.style.display='block';
}

function closemodal2(){
	var modal1 = document.getElementById('id02');
	modal2.style.display='none';
}

// Chiudi modal1 quando clicchi al di fuori del modal
window.onclick = function(event) {
	var modal1 = document.getElementById('id02');
    var modal2 = document.getElementById('id01');
    if (event.target == modal1 || event.target == modal2) {
        modal1.style.display = 'none';
        modal2.style.display = "none";
    }
}

