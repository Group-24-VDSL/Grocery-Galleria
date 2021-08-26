const menu = document.querySelector('#menu-bar');
const navbar = document.querySelector('.navbar');
const header = document.querySelector('.header-2');

menu.addEventListener('click', function(){
  menu.classList.toggle('fa-times');
  navbar.classList.toggle('active');
});
window.onscroll = () =>{
  menu.classList.remove('fa-times');
  navbar.classList.remove('active');

  if(window.scrollY > 100){
      header.classList.add('active');
  }else{
      header.classList.remove('active');
  }

}