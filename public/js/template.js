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
    
    $('.cart-mobile-content-item').on('click','.cart-mobile-item-remove',function(){
        $(this).closest('.cart-mobile-content-item').remove();
    });


}); //document ready

function templateAlert(type,message){
    //alert
    let doc = document.getElementsByClassName('alert-container')[0];

    let color;
    let text;

    let Item = document.createElement('div');
    Item.classList.add('alert');
    switch (type) {
        case 'red':
            color = 'red';
            text = 'Danger';
            break;
        case 'yellow':
            color = 'yellow';
            text = 'Warning';
            break;
        case 'green':
            color = 'green';
            text = 'Success';
            break;
        default:
            color = 'yellow';
            text = 'Warning';
    }
    Item.classList.add('alert-'.concat(color));
    Item.innerHTML = `
            <a href="#" class="alert-close" onClick="this.parentElement.style.display='none';"><i class="fa fa-times-circle"></i></a>
            <p><strong>${text}!</strong> ${message}</p></div>`;
    doc.appendChild(Item);
    return true;
};
