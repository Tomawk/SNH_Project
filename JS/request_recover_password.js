function handleRecoverPassword(){
    event.preventDefault();
    var data = new FormData();
      data.append('username', document.getElementById("username").value);
      data.append('email', document.getElementById("email").value);

      var xhr = new XMLHttpRequest();
      xhr.open("POST", "utility/send_request_password_change.php", true);
      
      xhr.onreadystatechange = function () {
          if (xhr.readyState == 4 && xhr.status == 200) {

            if(parseInt(xhr.responseText) == 1){
              jQuery('#result').html("Email sent, the link will expire in 5 minuts");
              jQuery("#result").css("color", "green");
            }else{
              jQuery('#result').html("Recovery problem");
              jQuery("#result").css("color", "red");
            }
          }
      };
      xhr.send(data);
  }