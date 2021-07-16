function togglePassword() {
    var element = document.getElementById("showpw"); 
    element.classList.toggle("fa-eye fa-eye-slash");
    var type = element.hasClass("fa-eye-slash") ? "text" : "password";
    element.attr("type", type);
}
