
  document.addEventListener("DOMContentLoaded", function(){
    const contact_form = document.getElementById("contact_form");  
    contact_form.noValidate=true;
    
    // custom form validation
    contact_form.addEventListener('submit', validateForm);
   
    function validateForm(e) {
    
      const form = e.target;
      const field = Array.from(form.elements);
      
      // reset fields
      field.forEach(i => {
        i.setCustomValidity('');
        i.parentElement.classList.remove('invalid');
      });

 
      
      
      if (!form.checkValidity()) {
    
        e.preventDefault();
        e.stopImmediatePropagation();
    
        field.forEach(i => {    
          if (!i.checkValidity()) {    
            i.parentElement.classList.add('invalid');    
          }    
        });
    
      }
    }
    });