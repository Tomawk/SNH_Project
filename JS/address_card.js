function handleParameter(){
    event.preventDefault();
    
    var address = document.getElementById("address");
    var city = document.getElementById("city");
    var country = document.getElementById("country");
    var cardnumber = document.getElementById("cardnumber");
    var expiration = document.getElementById("expiration");
    var cvv = document.getElementById("cvv");
  
    var error = 0;
    var value = address.value;
    if(value.trimStart() == ""){
      address.style.border ="2px solid red";
      error = 1;
    }
    else{
      address.style.border ="2px solid green";
    }
  
    value = city.value;
    if(value.trimStart() == ""){
      city.style.border ="2px solid red";
      error = 1;
    }else{
      city.style.border ="2px solid green";
    }
  
    value = country.value;
    if(value.trimStart() == ""){
      country.style.border ="2px solid red";
      error = 1;
    }else{
      country.style.border ="2px solid green";
    }
  
    value = cardnumber.value;
    if(value.trimStart() == "" || value.trimStart().length != 16){
      cardnumber.style.border ="2px solid red";
      error = 1;
    }else{
      cardnumber.style.border ="2px solid green";
    }
  
    value = cvv.value;
    if(value.trimStart() == "" || value.trimStart().length != 3){
      cvv.style.border ="2px solid red";
      error = 1;
    }else{
      cvv.style.border ="2px solid green";
    }
  
      var date = new Date(expiration.value);
    var actualDate = new Date();
      if(date < actualDate || expiration.value=="") {
      expiration.style.border = "2px solid red";
      }else{
      expiration.style.border ="2px solid green";
    }
  
    if(error != 1){
      //submit the form
      document.getElementById("form_id").submit();
    }
  }
  