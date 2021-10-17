// const Regform = document.getElementById("Regform");
// const Name = document.getElementById("name");
// const Username = document.getElementById("username");
// const Address = document.getElementById("address");
// const Email = document.getElementById("email");
// const Contact = document.getElementById("contact");
// const Location = document.getElementById("location");
// const Password = document.getElementById("password");
// const PasswordR = document.getElementById("passwordR");

// Regform.addEventListener("submit", (e) => {
//   e.preventDefault();

//   validateInputs();
// });

// function validateInputs() {
//   const regform_value = Regform.value;
//   const name_value = Name.value;
//   const username_value = Username.value;
//   const address_value = Address.value;
//   const contact_value = Contact.value;
//   const email_value = Email.value;
//   const location_value = Location.value;
//   const password_value = Password.value;
//   const passwordR_value = PasswordR.value;

//   if (name_value === "") {
//     setErrorFor(Name, "Name field cannot be empty.");
//   } else {
//     setSuccessFor(Name);
//   }
//   if (username_value === "") {
//     //add error class
//     setErrorFor(Username, "Username cannot be blank.");
//   } else {
//     //add success class
//     setSuccessFor(Username);
//   }
//   if (address_value === "") {
//     setErrorFor(Address, "Address field cannot be empty.");
//   } else {
//     setSuccessFor(Address);
//   }
//   if (contact_value === "") {
//     setErrorFor(Contact, "Contact field cannot be empty.");
//   } else {
//     setSuccessFor(Contact);
//   }
//   if (location_value === "") {
//     setErrorFor(Location, "Location field cannot be empty.");
//   } else {
//     setSuccessFor(Location);
//   }

//   if (email_value === "") {
//     setErrorFor(Email, "Email cannot be blank");
//   } else if (!isEmail(email_value)) {
//     setErrorFor(Email, "Email is not valid");
//   } else {
//     setSuccessFor(Email);
//   }

//   if (password_value === "") {
//     setErrorFor(Password, "Password cannot be blank");
//   } else {
//     //add success class
//     setSuccessFor(Password);
//   }
//   if (passwordR_value === "") {
//     setErrorFor(PasswordR, "Password cannot be blank");
//   } else if (password_value !== passwordR_value) {
//     //add error class
//     setErrorFor(PasswordR, "Password does not match");
//   } else {
//     setSuccessFor(PasswordR);
//   }
// }

// function setErrorFor(input, message) {
//   const inputBox = input.parentElement; // .inputBox
//   console.log(inputBox);
//   const small = inputBox.querySelector("small");

//   //add error message inside small
//   small.innerText = message;

//   //add error class
//   inputBox.className = "inputBox error";
// }

// function setSuccessFor(input) {
//   const inputBox = input.parentElement;
//   inputBox.className = "inputBox success";
// }

// function isEmail(email) {
//   return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
//     email
//   );
// }
const menu = document.querySelector("#menu-bar");
const navbar = document.querySelector(".navbar");
const header = document.querySelector(".header-2");

const tabBtns = document.querySelectorAll(".tab-btn");
const infoDivs = document.querySelectorAll(".info-div");

menu.addEventListener("click", function () {
  menu.classList.toggle("fa-times");
  navbar.classList.toggle("active");
});
window.onscroll = () => {
  menu.classList.remove("fa-times");
  navbar.classList.remove("active");

  if (window.scrollY > 10) {
    header.classList.add("active");
  } else {
    header.classList.remove("active");
  }
};
var currentTab = tabBtns[0]; // initial state
var currentInfo = infoDivs[0]; // initial state

tabBtns[0].classList.toggle("show-text");
infoDivs[0].classList.toggle("show-text");

tabBtns.forEach(function (tabBtn) {
  tabBtn.addEventListener("click", function () {
    if (currentTab != tabBtn) {
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

// infoDivs.forEach(function (infoDiv) {
//   // console.log(tabBtn);
//   const tabBtn = document.querySelectorAll(".tab-btn");
//   // console.log(btn);
//   tabBtn.addEventListener("click", function () {
//     infoDivs.forEach(function (infoDiv) {
//       console.log(tabBtn);
//       // if (item !== question) {
//       //   item.classList.remove("show-text");
//       // }
//     });

//     // question.classList.toggle("show-text");
//   });
// });
