// document.addEventListener('DOMContentLoaded', function() {
//     const phoneInputField = document.querySelector("#phone");
//     const phoneInput = window.intlTelInput(phoneInputField, {
//       utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
//     });
  
//     const info = document.querySelector(".alert-info");
  
//     function process(event) {
//       event.preventDefault();
  
//       const phoneNumber = phoneInput.getNumber();
  
//       info.style.display = "";
//       info.innerHTML = `Phone number in E.164 format: <strong>${phoneNumber}</strong>`;
//     }
  
//     // Attach event listener to the form submit event
//     // Replace "form" with your actual form ID or class
//     const form = document.querySelector("form");
//     form.addEventListener("submit", process);
//   });
  


// const phoneInputField = document.querySelector("#phone");
//         const phoneInput = window.intlTelInput(phoneInputField, {
//           utilsScript:
//             "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
//         });

//         const info = document.querySelector(".alert-info");

//         function process(event) {
//         event.preventDefault();

//         const phoneNumber = phoneInput.getNumber();

//         info.style.display = "";
//         info.innerHTML = `Phone number in E.164 format: <strong>${phoneNumber}</strong>`;
// }