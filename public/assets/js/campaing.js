   // for add groube cards 
function addGroubs(){

    var box =  document.getElementById('groubs-selected');
    $('#the-select').select2();
    var selectedOptions = [];
    var selectedValues = $('#the-select').val();
    var selectedTexts = $('#the-select').find('option:selected').map(function() {return $(this).html(); }).get();

    // Create an array of objects containing value and text
    for (var i = 0; i < selectedValues.length; i++) {
        selectedOptions.push({
            value: selectedValues[i],
            text: selectedTexts[i]
        });
          }
    // call addEmails() function for sending the email groubs and getting the emails array 
    addEmails(selectedOptions);
      }


function addEmails(groubs){
      
    var emails = [];
    for (var i = 0; i < groubs.length; i++) {
        emails.push({
            id: groubs[i].value,
            name: groubs[i].text
        });
        }
   
 
    var myRequest = new XMLHttpRequest();
    var container = document.getElementById('checklist');
    myRequest.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
             var data = this.responseText ;
            container.innerHTML ='';
             data =  JSON.parse(data);
             data.forEach(groub => {
                groub.forEach(email => {
                    console.log(email);
                    var html = '<label><input type="checkbox" name="emails[]" value="' + email.email + '" checked > ' + email.email+'</label>';     
                    container.innerHTML += html;   
              })});
    }
};
    myRequest.open("POST", "/getContacts", true);
    myRequest.setRequestHeader("Content-Type", "application/json");
    var jsonData = JSON.stringify(emails);
    myRequest.send(jsonData); 
}

// Accordion
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}