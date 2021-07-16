function togglePassword() { 
    $('#showpw').toggleClass('fa-eye fa-eye-slash');
    var type = $('#showpw').hasClass("fa-eye-slash") ? "text" : "password";
    $('#txtPassword').attr("type", type);
}
