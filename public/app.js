const registerSwitch = document.querySelector('#register-switch');
const passengerForm = document.querySelector('#passenger-form');
const driverForm = document.querySelector('#driver-form');

registerSwitch.addEventListener('click', () => {
    passengerForm.classList.toggle('hidden');
    driverForm.classList.toggle('hidden');
})
