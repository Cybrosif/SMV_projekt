document.addEventListener('DOMContentLoaded', function() {
    const username = document.getElementById('username');
    const password = document.getElementById('password');
    const submitButton = document.getElementById('submitButton');

    function checkInputs() {
        if(username.value && password.value) {
            submitButton.disabled = false;
        } else {
            submitButton.disabled = true;
        }
    }

    username.addEventListener('input', checkInputs);
    password.addEventListener('input', checkInputs);

    checkInputs();
});