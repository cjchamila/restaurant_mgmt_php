document.addEventListener('DOMContentLoaded', function() {

  var baseUrl = 'http://my-restaurant.com/pages/';  

  const delete_dialog = document.getElementById("deleteDialog");
  const delete_links = document.querySelectorAll('#delete_link');
  const deleteButton=document.getElementById("deleteDetails"); 
  const editButton=document.getElementById("updateDetails");  


  const edit_dialog = document.getElementById("editDialog");
  const cancelEditButton = document.getElementById("cancelEdit");
  
  cancelEditButton.addEventListener('click', function() {
    console.log('cancel clicked');
    edit_dialog.close();
    });

  const edit_links=document.querySelectorAll("#edit_link");

  //Add event listeners to dynamically selected edit links
  edit_links.forEach(link=>{
    link.addEventListener('click',function(event){
    const resIdInput = document.getElementById('resid'); 
    event.preventDefault();
    console.log("edit link clicked");
      
    const resId = this.getAttribute('data-id');
    const resDate = this.getAttribute('data-date');console.log(resDate);
    const guests = this.getAttribute('data-guests');console.log(guests);
    const phone = this.getAttribute('data-phone');console.log();
    const email = this.getAttribute('data-email');console.log();

    
    const resDateInput = document.getElementById('res_dt');
    const guestsInput = document.getElementById('guest');
    const phoneInput = document.getElementById('phone');
    const emailInput = document.getElementById('mail');

    resIdInput.value = resId;
    resDateInput.value = resDate;
    guestsInput.value = guests;
    phoneInput.value = phone;
    emailInput.value = email;

      edit_dialog.show();

    });
  });

 


  //Add event listeners to dynamically selected delete links
  delete_links.forEach(link => {
    link.addEventListener('click', function(event) {
      const resIdInput = document.getElementById('_resid'); 
      event.preventDefault();

      console.log("Dlete link clicked");
      const resId = this.getAttribute('data-id');
      const resDate = this.getAttribute('data-date');
      const guests = this.getAttribute('data-guests');
      const phone = this.getAttribute('data-phone');
      const email = this.getAttribute('data-email');

      
      const resDateInput = document.getElementById('_res_dt');
      const guestsInput = document.getElementById('_guest');
      const phoneInput = document.getElementById('_phone');
      const emailInput = document.getElementById('_mail');

      resIdInput.value = resId;
      resDateInput.value = resDate;
      guestsInput.value = guests;
      phoneInput.value = phone;
      emailInput.value = email;

    
      delete_dialog.show();

      // Optionally, you can also disable the form inputs here
      resIdInput.disabled = true;
      resDateInput.disabled = true;
      guestsInput.disabled = true;
      phoneInput.disabled = true;
      emailInput.disabled = true;


    });
  });

      //Process record deletion asynchronously
    deleteButton.addEventListener('click',function(){    
        const resIdInput = document.getElementById('_resid'); 
        console.log('resIdInput :'+resIdInput);
        var xhr = new XMLHttpRequest();
        var url = baseUrl+'delete.php?action=delete&id=' + resIdInput.value;
        console.log('URL : '+url);
        xhr.open('GET', url, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.open('GET',url , true);
            
        xhr.onreadystatechange = function() {
          if (xhr.readyState == 4) {
          if (xhr.status == 200) {
              // Check if the response URL contains the success parameter
              var successParamIndex = xhr.responseURL.indexOf('success=true');
              if (successParamIndex !== -1) {
                  console.log('Delete successful!'); 
                  delete_dialog.close();
                  setTimeout(function() {
                  window.location.reload();
              }, 100);
                 
              } else {
                  console.log('Delete failed!'); 
                  
              }
          } else {
              console.error('Error: ' + xhr.status); 
          }
      }
  };
        xhr.send();
  
    });


    //Process editing record asynchrounously
    editButton.addEventListener('click',()=>{
          
        const resIdInput = document.getElementById('resid'); 
        const resDateInput = document.getElementById('res_dt');
        const guestsInput = document.getElementById('guest');
        const phoneInput = document.getElementById('phone');
        const emailInput = document.getElementById('mail');
    
       
        var xhr = new XMLHttpRequest();
        var url = baseUrl+'edit.php?action=edit&id=' + resIdInput.value+'&date='+ resDateInput.value+'&email='+emailInput.value+'&guests='+guestsInput.value+'&phone='+phoneInput.value;
        console.log('URL : '+url);
        xhr.open('GET', url, true);
       
        xhr.open('GET',url , true);
            
        xhr.onreadystatechange = function() {
          if (xhr.readyState == 4) {
          if (xhr.status == 200) {
              // Check if the response URL contains the success parameter
              var successParamIndex = xhr.responseURL.indexOf('success=true');
              if (successParamIndex !== -1) {
                  console.log('Edit successful!'); 
                  delete_dialog.close();
                  setTimeout(function() {
                  window.location.reload();
              }, 100);
                 
              } else {
                  console.log('Edit failed!');                   
              }
          } else {
              console.error('Error: ' + xhr.status); 
          }
      }
  };
        xhr.send();
  
    });

 });