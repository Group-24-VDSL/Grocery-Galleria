function togglePassword() { 
    $('#showpw').toggleClass('fa-eye fa-eye-slash');
    var type = $('#showpw').hasClass("fa-eye-slash") ? "text" : "password";
    $('#txtPassword').attr("type", type);
}

$('.ps-toggle--sidebar').on('click', function(e) {
    e.preventDefault();
    var url = $(this).attr('href');
    $(this).toggleClass('active');
    $(this)
        .siblings('a')
        .removeClass('active');
    $(url).toggleClass('active');
    $(url)
        .siblings('.ps-panel--sidebar')
        .removeClass('active');
    $('.ps-site-overlay').toggleClass('active');
    console.log("activated");
});
