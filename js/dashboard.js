$(document).ready(function () {
    function sidebartoggle() {
        $(".sidebar").toggleClass("collapsed expand");
        $(".fa-bars").toggleClass("fa-rotate-90");
        $(".menu-expand").toggleClass("display-none");
        $(".menu-expand-icon").toggleClass("display-none");
        
    }

    $("#menu").click(function () {
        sidebartoggle();
    });

    // $(".menu-expand-icon").on('click',function(){
    //     dropdowntoggle();
    // });

    // function dropdowntoggle(){
    //     $(this).siblings(".menu-dropdown-container").toggleClass("display-none");
    //     $(".fa-menu-expand-icon").toggleClass("fa-caret-right fa-caret-down");
    //     // content.toggleClass("display-none");
    // }
    $(".menu-expand-icon").on('click',function(){
        $(this).parent().nextAll(".menu-dropdown-container").toggleClass("display-none")
        $(this).children("i").toggleClass("fa-caret-right fa-caret-down");
   });

});
