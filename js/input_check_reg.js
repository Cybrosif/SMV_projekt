$(document).ready(function() {
    const emailInput = $("#email");
    const passwordInput = $("#password");
    const confirmPasswordInput = $("#confirmPassword");
    const passwordWarning = $("#passwordWarning");
    const registrationForm = $("#registrationForm");
    const submitButton = $(".btn.btn-primary");

    emailInput.blur(function() {
        const email = $(this).val();
    
        if (!email) {
            console.log("Email input is empty.");
            return;
        }
    
        $.ajax({
            type: "POST",
            url: "../controllers/check_email.php",
            data: { email: email },
            success: function(response) {
                console.log("Response from server:", response.trim());
                if (response.trim() === "exists") {
                    passwordWarning.text("Email already exists.");
                    submitButton.prop("disabled", true);
                } else {
                    checkInputs();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("AJAX error:", textStatus, errorThrown);
            }
        });
    });
    

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
