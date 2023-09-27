document.addEventListener('DOMContentLoaded', function() {
    const email = document.getElementsByName('email')[0];
    const password = document.getElementsByName('password')[0];
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
