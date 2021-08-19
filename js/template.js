$( function(){
    function togglePassword() { 
        $('#showpw').toggleClass('fa-eye fa-eye-slash');
        var type = $('#showpw').hasClass("fa-eye-slash") ? "text" : "password";
        $('#txtPassword').attr("type", type);
    }
    
    $('.navigation-toggle').on('click', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $(this).toggleClass('active');
        $(this)
            .siblings('a')
            .removeClass('active');
        $(url).toggleClass('active');
        $(url)
            .siblings('.navigation-toggle')
            .removeClass('active');
        $('.navigation-back-overlay').toggleClass('active');
    });
    
    $('.navigation-back-overlay').on('click', function(e) {
        e.preventDefault();
        $('navigation-back-overlay').toggleClass('active');
        $('.navigation-toggle')
            .siblings('a')
            .removeClass('active');
        $('.navigation-back-overlay').toggleClass('active');
        $('#menu-mobile').toggleClass('active');
    
    });
    


}); //document ready
