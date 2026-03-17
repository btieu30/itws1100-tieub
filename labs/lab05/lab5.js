/* Lab 5 JavaScript File 
   Place variables and functions in this file */

function validate(formObj) {
   // put your validation code here
   // it will be a series of if statements


   // for comments box do not use placeholder
   var alertMsg = "";
   var focusSet = 0;

   if (formObj.firstName.value == "") {
      alertMsg += "You must enter a first name\n";
      formObj.firstName.focus();
      focusSet = 1;
   }

   if (formObj.lastName.value == "") {
      alertMsg += "You must enter a last name\n";
      if (focusSet == 0) {
         formObj.lastName.focus();
         focusSet = 1;
      }
   }

   if (formObj.title.value == "") {
      alertMsg += "You must enter a title\n";
      if (focusSet == 0) {
         formObj.title.focus();
         focusSet = 1;
      }
   }

   if (formObj.org.value == "") {
      alertMsg += "You must enter an organization\n";
      if (focusSet == 0) {
         formObj.org.focus();
         focusSet = 1;
      }
   }

   if (formObj.pseudonym.value == "") {
      alertMsg += "You must enter a pseudonym\n";
      if (focusSet == 0) {
         formObj.pseudonym.focus();
         focusSet = 1;
      }
   }
   
   if (formObj.comments.value == "" || formObj.comments.value == "Please enter your comments") {
      alertMsg += "You must enter comments\n";
      if (focusSet == 0) {
         formObj.comments.focus();
         focusSet = 1;
      }
   }

   if (alertMsg != "") {
      alert(alertMsg);
      return false;
   } else {
      alert("Success! Form submitted.");
      return true;
   }
}

function clearComments() {
   var text = document.getElementById("comments");
   if (text.value == "Please enter your comments") {
      text.value = "";
   }
}

function populateComments() {
   var text = document.getElementById("comments");
   if (text.value == "") {
      text.value = "Please enter your comments";
   }
}

function buttonClick() {
   var firstName = document.getElementById("firstName");
   var lastName = document.getElementById("lastName");
   var pseudonym = document.getElementById("pseudonym");
   if (firstName.value == "" || lastName.value == "" || pseudonym.value == "") {
      alert("Fill out the first name, last name, and pseudonym fields to display info.");
      return;
   } else {
      alert(firstName.value + " " + lastName.value + " is " + pseudonym.value);
   }
}

window.onload = function () {
   document.getElementById("firstName").focus();
}