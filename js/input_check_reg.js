$(document).ready(function() {
    const emailInput = $("#email");
    const passwordInput = $("#password");
    const confirmPasswordInput = $("#confirmPassword");
    const passwordWarning = $("#passwordWarning");
    const registrationForm = $("#registrationForm");
    const submitButton = $(".btn.btn-primary");
    

    function checkInputs() {
        const inputs = registrationForm.find('input');
        let allFilled = true;

        inputs.each(function() {
            if ($(this).val() === '') {
                allFilled = false;
            }
        });

        if (!allFilled) {
            passwordWarning.text('Vsa polja morajo biti izpolnjena!');
            submitButton.prop("disabled", true);
            return;
        }

        passwordWarning.text('');

        if (passwordInput.val() !== confirmPasswordInput.val()) {
            passwordWarning.text("Gesla se ne ujemata.");
            submitButton.prop("disabled", true);
        } else {
            passwordWarning.text("");
            submitButton.prop("disabled", false);
        }
    }

    registrationForm.on("input", checkInputs);

    // Disable the submit button initially
    submitButton.prop("disabled", true);
});
