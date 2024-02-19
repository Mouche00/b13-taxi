

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

// register

const pictureWrapper = document.querySelector('#picture-wrapper');

if(pictureWrapper !== null){
    pictureWrapper.classList.add('border-white');
}

const passengerSwitch = document.querySelector('#passenger-switch');
const driverSwitch = document.querySelector('#driver-switch');
const passengerFormWrapper = document.querySelector('#passenger-form-wrapper');
const driverFormWrapper = document.querySelector('#driver-form-wrapper');
const registerBackground = document.querySelector('#register-background');


if(driverSwitch !== null) {
    driverSwitch.addEventListener('click', () => {
        passengerFormWrapper.classList.toggle('translate-x-[-100%]');
        driverFormWrapper.classList.toggle('translate-x-[100%]');
        registerBackground.classList.toggle('bg-white');
        passengerSwitch.classList.toggle('bg-white');
        driverSwitch.classList.toggle('bg-white');
    })
}

if(passengerSwitch !== null) {
    passengerSwitch.addEventListener('click', () => {
        passengerFormWrapper.classList.toggle('translate-x-[-100%]');
        driverFormWrapper.classList.toggle('translate-x-[100%]');
        registerBackground.classList.toggle('bg-white');
        passengerSwitch.classList.toggle('bg-white');
        driverSwitch.classList.toggle('bg-white');
    })
}