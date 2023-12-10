
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

function openmodal3(){
	var modal3 = document.getElementById('id03');
	modal3.style.display='block';
}

function closemodal3(){
	var modal3 = document.getElementById('id03');
	modal3.style.display='none';
}

// Chiudi modal1 quando clicchi al di fuori del modal
window.onclick = function(event) {
	var modal1 = document.getElementById('id02');
    var modal2 = document.getElementById('id01');
    var modal3 = document.getElementById('id03');
    if (event.target == modal1 || event.target == modal2
		|| event.target == modal3) {
        if(modal1 != null)
			modal1.style.display = 'none';
        if(modal2 != null)
        	modal2.style.display = "none";
        if(modal3 != null)
        	modal3.style.display = "none";
    }
}