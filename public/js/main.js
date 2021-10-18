const menu = document.querySelector('#menu-bar');
const navbar = document.querySelector('.navbar');
const header = document.querySelector('.header-2');
const tabBtns = document.querySelectorAll(".tab-btn");
const infoDivs = document.querySelectorAll(".info-div");

menu.addEventListener('click', function(){
  menu.classList.toggle('fa-times');
  navbar.classList.toggle('active');
});
window.onscroll = () =>{
  menu.classList.remove('fa-times');
  navbar.classList.remove('active');

  if(window.scrollY > 10){
      header.classList.add('active');
  }else{
      header.classList.remove('active');
  }
}

let currentTab = tabBtns[0]; // initial state
let currentInfo = infoDivs[0]; // initial state

tabBtns[0].classList.toggle("show-text");
infoDivs[0].classList.toggle("show-text");

tabBtns.forEach(function (tabBtn) {
    tabBtn.addEventListener("click", function () {
        if (currentTab !== tabBtn) {
            currentTab.classList.remove("show-text");
            currentInfo.classList.remove("show-text");
        } else {
            currentTab.classList.toggle("show-text");
            currentInfo.classList.toggle("show-text");
        }

        infoDivs.forEach(function (infoDiv) {
            if (infoDiv.id == tabBtn.parentNode.className) {
                currentTab = tabBtn;
                currentInfo = infoDiv;
                currentTab.classList.toggle("show-text");
                currentInfo.classList.toggle("show-text");
            }
            // infoDiv.classList.toggle("show-text");
        });
    });
});