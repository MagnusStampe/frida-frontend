const switchButton = document.querySelector('.change_form');
const switchText = document.querySelector('.no_user');
const submitButton = document.querySelector('.submit');
const form = document.querySelector('#login_form');
switchButton.addEventListener('click', changeForm);

function changeForm(e) {
    e.preventDefault();
    if (form.classList.contains('sign_up')) {
        switchToLogin();
    } else {
        switchToSignUp();
    }
}

function switchToLogin() {
    switchButton.textContent = 'Sign up';
    form.classList.remove('sign_up');
    switchText.textContent = "Don't have a user? ";
    submitButton.textContent = 'Login';
}

function switchToSignUp() {
    switchButton.textContent = 'Login';
    form.classList.add('sign_up');
    switchText.textContent = "Have a user? Go to ";
    submitButton.textContent = 'Sign up';
}