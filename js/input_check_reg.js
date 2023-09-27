const passwordInput = document.getElementById("password");
const confirmPasswordInput = document.getElementById("confirmPassword");
const passwordWarning = document.getElementById("passwordWarning");
const registrationForm = document.getElementById("registrationForm");
const submitButton = document.querySelector(".btn.btn-primary");

passwordInput.addEventListener("input", checkInputs);
confirmPasswordInput.addEventListener("input", checkInputs);
registrationForm.addEventListener("input", checkInputs);

function checkInputs() {
    const inputs = registrationForm.querySelectorAll('input');
    let allFilled = true;

    inputs.forEach(input => {
        if (input.value === '') {
            allFilled = false;
        }
    });

    if (!allFilled) {
        passwordWarning.textContent = 'Vsa polja morajo biti izpolnjena!';
        submitButton.disabled = true;
        return;
    }

    passwordWarning.textContent = '';

    if (passwordInput.value !== confirmPasswordInput.value) {
        passwordWarning.textContent = "Gesla se ne ujemata.";
        submitButton.disabled = true;
    } else {
        passwordWarning.textContent = "";
        submitButton.disabled = false;
    }
}

document.addEventListener("DOMContentLoaded", function () {
  submitButton.disabled = true;
});
