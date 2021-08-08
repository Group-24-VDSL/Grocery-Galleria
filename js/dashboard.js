$(document).ready(function () {
    function sidebartoggle() {
        $(".sidebar").toggleClass("collapsed expand");
        $(".fa-bars").toggleClass("fa-rotate-90");
        $(".menu-expand").toggleClass("display-none");
    }

    $("#menu").click(function () {
        sidebartoggle();
    });
});
