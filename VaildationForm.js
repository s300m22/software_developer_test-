class ValidationForm {
  form;
  vaild;
  rules
  
  constructor(formId) {
     this.form = document.getElementById(formId); 
     this.vaild=true;
     this.rules = ['validate-name','validate-email','validate-phone'];
  }
  
  isValid(){
     var inputs = this.form.getElementsByTagName("input"); 
     for (var i = 0; i < inputs.length; i++) {
       var current_input = inputs.item(i);
       
       if(this.rules.includes(current_input.className))
           if(!this.validateField(current_input,current_input.className)) 
                this.showInvalidMessage(current_input); 
           else this.hideInvalidMessage(current_input);
           
     }
     
     return this.vaild;
  }

  validateField(el,role) {
      switch(role){
        case 'validate-name':
            return String(el.value).toLowerCase().match(/^[a-zA-Z\s]+$/);
        case 'validate-email':
            return String(el.value).toLowerCase().match(  /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
        case 'validate-phone':
            return String(el.value).toLowerCase().match( /^\d+$/);
      }
  }
  
  
  showInvalidMessage(el){
      this.vaild=false;
      var container = this.parentClass(el, "validate-container");
      var msg = container.getElementsByClassName("validate-message");
      msg[0].style.display = "block";
      
  }
  
  hideInvalidMessage(el){
      var container = this.parentClass(el, "validate-container");
      var msg = container.getElementsByClassName("validate-message");
      msg[0].style.display = "none";
      
  }
  
  parentClass(el, className) {
    
      while (el && el.parentNode) {
        el = el.parentNode;
        if (el.className == className) {
          return el;
        }
      }
    
      return null;
  }

}