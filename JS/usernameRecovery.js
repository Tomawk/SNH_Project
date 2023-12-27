function handleRecoverPassword(){
    event.preventDefault();
    var data = new FormData();
      data.append('email', document.getElementById("email").value);

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