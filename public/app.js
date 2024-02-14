const registerSwitch = document.querySelector('#register-switch');
const passengerForm = document.querySelector('#passenger-form');
const driverForm = document.querySelector('#driver-form');

if(registerSwitch !== null) {
    registerSwitch.addEventListener('click', () => {
        passengerForm.classList.toggle('hidden');
        driverForm.classList.toggle('hidden');
    })
}

// profile

const profilePicture = document.getElementById('profile-picture');
const profileMenu = document.getElementById('profile-menu');

if(profilePicture !== null) {
    profilePicture.addEventListener('click', () => {
        profileMenu.classList.toggle('hidden');
    })
}

// driver

const departure = document.getElementById('departure');
const destination = document.getElementById('destination');
let prevOptionDep = 'afourar';
let prevOptionDes = 'zinat';

if(departure !== null || destination !== null) {
    departure.addEventListener('change', () => {
        if (prevOptionDep.length > 0){
            destination.querySelector(`#${prevOptionDep}`).classList.remove('hidden');
        }
        prevOptionDep = departure.value.replaceAll(' ', '-').toLowerCase();
        console.log(prevOptionDep);
        destination.querySelector(`#${prevOptionDep}`).classList.add('hidden');
    })

    destination.addEventListener('change', () => {
        if (prevOptionDes.length > 0){
            departure.querySelector(`#${prevOptionDes}`).classList.remove('hidden');
        }
        prevOptionDes = destination.value.replaceAll(' ', '-').toLowerCase();
        console.log(prevOptionDes);
        departure.querySelector(`#${prevOptionDes}`).classList.add('hidden');
    })
}
