// document.getElementById('complete').onclick = function() {
//     var button = document.getElementById('complete');
//     document.getElementById('status').innerHTML = 'Order Completed !!!';
//     //document.getElementById('status').style.color = "Green";
//
//     button.style.color = "Green" ;
//     button.style.backgroundColor = "White";
// }
//
// function hide(id1) {
//     document.getElementById(id1).style.display = "none";
// }
// function show(id2){
//     document.getElementById(id2).style.display = "block";
//
// }

function buttonStatus() {
    var x = document.getElementById("not-complete");
    var y = document.getElementById("completed");

    x.style.display = "none";
    y.style.display = "block";
}
