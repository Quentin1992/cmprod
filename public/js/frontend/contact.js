const sendEmail = function(name, phoneNumber, email, message){
    var query = new FormData();
    query.append("action", "sendEmail");
    query.append("name", name);
    query.append("phoneNumber", phoneNumber);
    query.append("email", email);
    query.append("message", message);
    query.append("consent", "consent");
    ajaxPost("index.php", query, function(response){
        console.log(response);
    });
};



$(document).ready(function(){
    let form = $("form");
    form[0].addEventListener("submit", function(e){
        sendEmail(form[0].name.value, form[0].phoneNumber.value, form[0].email.value, form[0].message.value);
        e.preventDefault();
    });
});
