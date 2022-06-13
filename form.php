<?
$errors=null;
if(isset($_POST['save'])){
    include 'VaildationForm.php';
    $rules =[
        'names_set' => 'name',
        'emails_set' => 'email',
        'phones_set' => 'phone',
        ];
    $vaildationForm = new VaildationForm($_POST,$rules);
    if(!$vaildationForm->isValid()) $errors=$vaildationForm->result;
    else{
        $contacts=[];
        for($i=0;$i<count($_POST['names_set']);$i++)
            $contacts[] = array($_POST['names_set'][$i], $_POST['emails_set'][$i] , $_POST['phones_set'][$i]);
        
        
        $file = fopen("contacts.csv","a");
        
        foreach ($contacts as $contact) {
          fputcsv($file, $contact);
        }
        
        fclose($file);
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Multi Contact Form</title>
</head>

<body>
<form id="contactsForm" name="contactsForm" method="post" action="">
<table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td width="70%">Multi Contact Form</td>
    <td width="10%"><input type="button" value="Add Contact" onclick="addContact()" /></td>
    <td width="10%"><input type="button" value="Validate" onclick="validateForm('contactsForm')" /></td>
    <td width="10%"><input type="submit" name="save" id="save" value="Save" /></td>
  </tr>
</table>
<hr >
<div id="contacts">
<div id="main_contact" style="width:50%; float:left">
  <table width="100%" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td colspan="2"><table width="100%" border="0" cellpadding="2" cellspacing="2">
        <tr>
          <td width="80%">Contact</td>
          <td width="20%"><input type="button" class="remove-btn" value="Remove" style="display:none" onclick="removeContact(this)" /></td>
        </tr>
      </table><hr></td>
    </tr>
  <tr>
    <td width="40%">Name</td>
    <td width="60%" class="validate-container">
      <input class="validate-name" type="text" name="names_set[]" value="<?=$_POST['names_set'][0]?>"/>
      <div  class="validate-message" style="color:red;display:<?=(isset($errors['names_set']) && !$errors['names_set'][0])?'block':'none'?>">Invalid Name</div>
    </td>
  </tr>
  <tr>
    <td>Email</td>
    <td class="validate-container">
      <input class="validate-email" type="text" name="emails_set[]" value="<?=$_POST['emails_set'][0]?>" />
      <div  class="validate-message" style="color:red;display:<?=(isset($errors['emails_set']) && !$errors['emails_set'][0])?'block':'none'?>">Invalid Email</div>
    </td>
  </tr>
  <tr>
    <td>Phone Number</td>
    <td class="validate-container">
      <input class="validate-phone" type="text" name="phones_set[]" value="<?=$_POST['phones_set'][0]?>" />
      <div  class="validate-message" style="color:red;display:<?=(isset($errors['phones_set']) && !$errors['phones_set'][0])?'block':'none'?>">Invalid Phone</div>
    </td>
  </tr>
</table>
</div>

<?php 
if(isset($_POST['save'])){
    for($i=1;$i<count($_POST['names_set']);$i++){
?>
<div class="contact-item" style="width:50%; float:left">
  <table width="100%" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td colspan="2"><table width="100%" border="0" cellpadding="2" cellspacing="2">
        <tr>
          <td width="80%">Contact</td>
          <td width="20%"><input type="button" class="remove-btn" value="Remove" style="display:block" onclick="removeContact(this)" /></td>
        </tr>
      </table><hr></td>
    </tr>
  <tr>
    <td width="40%">Name</td>
    <td width="60%" class="validate-container">
      <input class="validate-name" type="text" name="names_set[]" value="<?=$_POST['names_set'][$i]?>"/>
      <div  class="validate-message" style="color:red;display:<?=(isset($errors['names_set']) && !$errors['names_set'][$i])?'block':'none'?>">Invalid Name</div>
    </td>
  </tr>
  <tr>
    <td>Email</td>
    <td class="validate-container">
      <input class="validate-email" type="text" name="emails_set[]" value="<?=$_POST['emails_set'][$i]?>" />
      <div  class="validate-message" style="color:red;display:<?=(isset($errors['emails_set']) && !$errors['emails_set'][$i])?'block':'none'?>">Invalid Email</div>
    </td>
  </tr>
  <tr>
    <td>Phone Number</td>
    <td class="validate-container">
      <input class="validate-phone" type="text" name="phones_set[]" value="<?=$_POST['phones_set'][$i]?>" />
      <div  class="validate-message" style="color:red;display:<?=(isset($errors['phones_set']) && !$errors['phones_set'][$i])?'block':'none'?>">Invalid Phone</div>
    </td>
  </tr>
</table>
</div>
<?
    }
}
?>
</div>
</form>
<script src="VaildationForm.js" ></script>
<script>
var contacts = document.getElementById('contacts');
var main_contact = document.getElementById('main_contact');
    function addContact(){
        contacts.insertAdjacentHTML("afterend",'<div class="contact-item" style="width:50%; float:left">'+main_contact.innerHTML+'</div>');
        var contact_items = document.getElementsByClassName("contact-item");
        for (var i = 0; i < contact_items.length; i++) {
           var current_contact = contact_items.item(i).getElementsByClassName("remove-btn");
           var validate_message = contact_items.item(i).getElementsByClassName("validate-message");
           current_contact[0].style.display = "block";
           
           for (var j = 0; j < validate_message.length; j++) validate_message[j].style.display = "none";
        }
    }
    
    function removeContact(el){
        var contact_item = parentClass(el, "contact-item");
        if(contact_item) contact_item.remove();
    }
    
    function parentClass(el, className) {
    
      while (el && el.parentNode) {
        el = el.parentNode;
        if (el.className == className) {
          return el;
        }
      }
    
      return null;
    }
//==================================================

function validateForm(formId){
    const validatForm = new ValidationForm(formId);
    validatForm.isValid();
}
</script>
</body>
</html>