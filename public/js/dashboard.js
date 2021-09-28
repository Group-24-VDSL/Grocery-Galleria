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
        $(this).parent().nextAll(".menu-dropdown-container").eq(0).toggleClass("display-none")
        $(this).children("i").toggleClass("fa-caret-right fa-caret-down");
   });

    $(".image-input").on('change',function (){
        const preview = document.querySelector(".image-preview");
        const input = document.querySelector(".image-input");
        const [file] = input.files;
        if(file){
            preview.src = URL.createObjectURL(file);
        }

    })

});
