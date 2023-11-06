$(document).ready(function() {
    const usernameInput = $("#username");
    const passwordInput = $("#password");
    const confirmPasswordInput = $("#password-confirm");
    const saveButton = $("#saveButton");
    const errorDisplay = $("#passwordWarning");

    function validatePassword(password) {
        const hasUppercase = /[A-Z]/.test(password);
        const hasLowercase = /[a-z]/.test(password);
        const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);
        const isLongEnough = password.length >= 8;
        return {
            valid: hasUppercase && hasLowercase && hasSpecialChar && isLongEnough,
            message: `Geslo mora biti dolgo vsaj 8 znakov, vsebovati vsaj eno veliko črko, eno malo črko in en poseben znak.`
        };
    }

    function checkInputs() {
        errorDisplay.hide();

        if (usernameInput.length && !usernameInput.val()) {
            errorDisplay.text('Vnesite uporabniško ime.').show();
            saveButton.prop("disabled", true);
            return;
        }

        if (!passwordInput.val()) {
            errorDisplay.text('Vnesite geslo.').show();
            saveButton.prop("disabled", true);
            return;
        }

        const passwordValidation = validatePassword(passwordInput.val());
        if (!passwordValidation.valid) {
            errorDisplay.text(passwordValidation.message).show();
            saveButton.prop("disabled", true);
            return;
        }

        if (passwordInput.val() !== confirmPasswordInput.val()) {
            errorDisplay.text("Gesla se ne ujemata.").show();
            saveButton.prop("disabled", true);
            return;
        }

        saveButton.prop("disabled", false);
    }

    $("#settingsForm input").on("input", checkInputs);

    checkInputs(); // Check inputs on document ready
});
