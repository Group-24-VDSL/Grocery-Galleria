const url = window.location.href;

const userIDInput = document.getElementById('UserID');
let userID = url.split('=')[1];
userID = parseInt(userID);
userIDInput.setAttribute('value',userID);
console.log(url);
