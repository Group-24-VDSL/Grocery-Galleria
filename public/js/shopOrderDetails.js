const host = window.location.origin; //http://domainname
const URLMarkCompleted= host + "/api/shopOrderStatus";

function markCompleted() {
    let x = document.getElementById("not-complete");
    let y = document.getElementById("completed");

    x.style.display = "none";
    y.style.display = "block";

    //  window.history.back();
}

