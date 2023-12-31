import './bootstrap';
import { openPhotosModalButton, closePhotosModalButton, photosModal, showAllPhotos, closeAllPhotos } from './photosModal';
// import '/intlTelInput.js';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Category filter :
// function handleCategoryFilter(category) {
//   const categoryInput = document.querySelector('input[name="category"]');
//   categoryInput.value = category;
//   categoryInput.closest('form').submit();
// }

// Redirect guest after clicking nav link 'List property' :
// const becomeHostRoute = "{{ route('become.host') }}";
// const registerRoute = "{{ route('register') }}";

// if (window.location.search.includes('redirectToBecomeHost=true')) {
//     if (window.Laravel && window.Laravel.auth && window.Laravel.auth.user) {
//         window.location.href = becomeHostRoute;
//     } else {
//         window.location.href = registerRoute;
//     }
// }

// Date Picker for create reservation :
// import flatpickr from 'flatpickr';

// Import Flatpickr styles (choose one of the following options)
// Option 1: Import Flatpickr's default theme
// import 'flatpickr/dist/flatpickr.css';
// Option 2: Import a specific Flatpickr theme (e.g., "material_red")
// import 'flatpickr/dist/themes/material_red.css';

// document.addEventListener("DOMContentLoaded", function () {
//     const startDateInput = document.getElementById("start_date");
//     const endDateInput = document.getElementById("end_date");

//     const options = {
//         dateFormat: "Y-m-d",
//         minDate: "today",
//         disable: JSON.parse(startDateInput.dataset.unavailableDates),
//         onChange: function (selectedDates, dateStr, instance) {
//             if (instance === startDateInput._flatpickr) {
//                 endDateInput._flatpickr.set("minDate", dateStr);
//             } else if (instance === endDateInput._flatpickr) {
//                 startDateInput._flatpickr.set("maxDate", dateStr);
//             }
//         },
//     };

//     const startPicker = flatpickr(startDateInput, options);
//     const endPicker = flatpickr(endDateInput, options);

//     startDateInput.addEventListener("change", function () {
//         endPicker.set("minDate", startDateInput.value);
//     });

//     endDateInput.addEventListener("change", function () {
//         startPicker.set("maxDate", endDateInput.value);
//     });
// });


// function updateDisabledDates(startDateInput, endDateInput, unavailableDates) {
//   const startTimestamp = Date.parse(startDateInput.value);
//   const endTimestamp = Date.parse(endDateInput.value);

//   const disabledDates = unavailableDates.filter(function (date) {
//       const timestamp = Date.parse(date);
//       return timestamp >= startTimestamp && timestamp <= endTimestamp;
//   });

//   startDateInput.disabled = disabledDates.length > 0;
//   endDateInput.disabled = disabledDates.length > 0;
// }

// function getFormattedDate(date) {
//   const year = date.getFullYear();
//   const month = String(date.getMonth() + 1).padStart(2, "0");
//   const day = String(date.getDate()).padStart(2, "0");
//   return `${year}-${month}-${day}`;
// }


// date picker for search bar in explore offers


// document.addEventListener("DOMContentLoaded", function () {
//     const startDateInputOther = document.getElementById("start_date_other");
//     const endDateInputOther = document.getElementById("end_date_other");

//     const options = {
//         dateFormat: "Y-m-d",
//         minDate: "today",
//         disable: JSON.parse(startDateInputOther.dataset.unavailableDates),
//         onChange: function (selectedDates, dateStr, instance) {
//             if (instance === startPickerOther) {
//                 endPickerOther.set("minDate", dateStr);
//             } else if (instance === endPickerOther) {
//                 startPickerOther.set("maxDate", dateStr);
//             }
//         },
//     };

//     const startPickerOther = flatpickr(startDateInputOther, options);
//     const endPickerOther = flatpickr(endDateInputOther, options);

//     startDateInputOther.addEventListener("change", function () {
//         endPickerOther.set("minDate", startDateInputOther.value);
//     });

//     endDateInputOther.addEventListener("change", function () {
//         startPickerOther.set("maxDate", endDateInputOther.value);
//     });
// });


// Reservation Preview (Offer detail page): Total price of number of nights
// document.addEventListener('alpine:init', () => {
//     Alpine.data('reservationPreview', () => ({
//         startDate: '',
//         endDate: '',
//         numberOfNights: 0,
//         totalPrice: 0,

//         calculateTotalPrice() {
//             const startDate = new Date(this.startDate);
//             const endDate = new Date(this.endDate);

//             if (startDate && endDate && startDate <= endDate) {
//                 const diffInDays = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));
//                 this.numberOfNights = diffInDays;
//                 this.totalPrice = {{ $offer->price }} * diffInDays;
//             } else {
//                 this.numberOfNights = 0;
//                 this.totalPrice = 0;
//             }
//         },
//     }));
// });

// Photos Modal :
if (openPhotosModalButton) {
    openPhotosModalButton.addEventListener('click', showAllPhotos);
  }
  
  if (closePhotosModalButton) {
    closePhotosModalButton.addEventListener('click', closeAllPhotos);
  }

// Real time update for total price, event listener : 
document.addEventListener('DOMContentLoaded', function() {
  const startDateInput = document.getElementById('start_date');
  const endDateInput = document.getElementById('end_date');
  const totalPriceElement = document.getElementById('total_price');
  const numberOfNightsElement = document.getElementById('number_of_nights');

  function calculateTotalPrice() {
      const startDate = new Date(startDateInput.value);
      const endDate = new Date(endDateInput.value);
      const pricePerNight = parseFloat(totalPriceElement.dataset.pricePerNight);
      const numberOfNights = (endDate - startDate) / (1000 * 60 * 60 * 24);
      const totalPrice = pricePerNight * numberOfNights;

      totalPriceElement.textContent = totalPrice.toFixed(2);
      numberOfNightsElement.textContent = numberOfNights;

      // Update the text based on the number of nights
      const nightsText = numberOfNights === 1 ? 'night' : 'nights';
      document.getElementById('nights_text').textContent = nightsText;
  }

  // Initialize the values on page load
  calculateTotalPrice();

  startDateInput.addEventListener('input', calculateTotalPrice);
  endDateInput.addEventListener('input', calculateTotalPrice);
});




// Messaging system :
class ChatComponent {
  constructor() {
    this.users = [];
    this.selectedUser = null;
    this.messages = [];
    this.newMessage = '';

    this.userSelect = document.getElementById('userSelect');
    this.messageList = document.getElementById('messageList');
    this.newMessageInput = document.getElementById('newMessage');
    this.sendMessageButton = document.getElementById('sendMessage');

    this.loadUsers();
    this.init();
  }

  init() {
    this.sendMessageButton.addEventListener('click', this.sendMessage.bind(this));
    this.userSelect.addEventListener('change', this.loadMessages.bind(this));
  }

  loadUsers() {
    fetch('/users')
        .then(response => response.json())
        .then(data => {
            this.users = data;
            this.renderUserSelect();
            this.userSelect.value = this.selectedUser;
        })
        .catch(error => {
            console.log(error);
        });
}


  renderUserSelect() {
    this.userSelect.innerHTML = '';

    this.users.forEach(user => {
      const option = document.createElement('option');
      option.value = user.id;
      option.textContent = user.name;
      this.userSelect.appendChild(option);
    });
  }

  loadMessages() {
    this.selectedUser = this.userSelect.value;

    fetch(`/messages/${this.selectedUser}`)
      .then(response => response.json())
      .then(data => {
        this.messages = data.messages.map(message => ({
          ...message,
          timestamp: this.formatTimestamp(message.created_at),
          position: message.sender_id === this.selectedUser ? 'left' : 'right'
        }));
        this.renderMessageList();
      })
      .catch(error => {
        console.log(error);
      });
  }

  formatTimestamp(timestamp) {
    const date = new Date(timestamp);
    const today = new Date();

    if (date.toDateString() === today.toDateString()) {
      // Message is from today
      return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    } else if (date.getFullYear() === today.getFullYear()) {
      // Message is from this year
      return date.toLocaleDateString([], { day: '2-digit', month: '2-digit', hour: '2-digit', minute: '2-digit' });
    } else {
      // Message is from a different year
      return date.toLocaleDateString([], { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit' });
    }
  }

  renderMessageList() {
    this.messageList.innerHTML = '';

    this.messages.forEach(message => {
      const li = document.createElement('li');
      li.className = `message ${message.position === 'left' ? 'message-left' : 'message-right'}`;
      li.innerHTML = `
        <div class="message-content bg-neutral-100 rounded-lg px-4 py-2">
          <div class="message-text text-sm">${message.content}</div>
          <div class="message-timestamp text-xs text-neutral-500 mt-1">${message.timestamp}</div>
        </div>
      `;
      this.messageList.appendChild(li);
    });
  }

  sendMessage() {
    const newMessage = this.newMessageInput.value.trim();
    if (newMessage === '') {
      return;
    }

    const data = {
      content: newMessage,
      receiver_id: this.selectedUser
    };

    fetch('/messages/store', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: JSON.stringify(data)
    })
      .then(response => response.json())
      .then(data => {
        console.log(data.message);
        this.newMessageInput.value = '';
        this.loadMessages();
      })
      .catch(error => {
        console.log(error);
      });
  }
}

const chatComponent = new ChatComponent('{{ $user->id }}');
