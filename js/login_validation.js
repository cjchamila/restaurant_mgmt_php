document.addEventListener("DOMContentLoaded", function(){
    const userName = document.getElementById("user_name");
    const password = document.getElementById("password");
    
    userName.addEventListener("invalid", (event) => {
    if (userName.validity.valueMissing) {
        userName.setCustomValidity("User name is empty!");
    } 
    else  {
        userName.setCustomValidity("");
    }
  
  });

  password.addEventListener("invalid", (event) => {
    if (password.validity.valueMissing) {
        password.setCustomValidity("Password is empty!");
    } 
    else  {
        password.setCustomValidity("");
    }
  
  });

  });


  