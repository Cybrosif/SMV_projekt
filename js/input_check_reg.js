$(document).ready(function() {
    const emailInput = $("#email");
    const passwordInput = $("#password");
    const confirmPasswordInput = $("#confirmPassword");
    const errorText = $("#passwordWarning");  // Using this as a general error display
    const registrationForm = $("#registrationForm");
    const submitButton = $(".btn.btn-primary");

    function validateEmail(email) {
        var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        return regex.test(email);
    }

    function validatePassword(password) {
        const hasUppercase = /[A-Z]/.test(password);
        const hasLowercase = /[a-z]/.test(password);
        const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);
        const isLongEnough = password.length >= 8;

        return hasUppercase && hasLowercase && hasSpecialChar && isLongEnough;
    }

    function checkInputs() {
        const inputs = registrationForm.find('input');
        let allFilled = true;

        inputs.each(function() {
            if ($(this).val() === '') {
                allFilled = false;
            }
        });

        if (!allFilled) {
            errorText.text('Vsa polja morajo biti izpolnjena!');
            submitButton.prop("disabled", true);
            return;
        }

        if (!validateEmail(emailInput.val())) {
            errorText.text('Prosimo, vnesite veljaven email naslov.');
            submitButton.prop("disabled", true);
            return;
        }

        if (!validatePassword(passwordInput.val())) {
            errorText.text('Geslo mora biti dolgo vsaj 8 znakov, vsebovati vsaj eno veliko črko, eno malo črko in en poseben znak.');
            submitButton.prop("disabled", true);
            return;
        }

        if (passwordInput.val() !== confirmPasswordInput.val()) {
            errorText.text("Gesla se ne ujemata.");
            submitButton.prop("disabled", true);
            return;
        }

        errorText.text("");  
        submitButton.prop("disabled", false);
    }

    registrationForm.on("input", checkInputs);

    // Disable the submit button initially
    submitButton.prop("disabled", true);
});
