document.addEventListener('DOMContentLoaded', function() {
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const submitButton = document.querySelector('button');

    function checkInputs() {
        if(email.value && password.value) {
            submitButton.disabled = false;
        } else {
            submitButton.disabled = true;
        }
    }

    email.addEventListener('input', checkInputs);
    password.addEventListener('input', checkInputs);

    checkInputs();
});
