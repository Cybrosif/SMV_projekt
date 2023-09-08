const passwordInput = document.getElementById("password");
const confirmPasswordInput = document.getElementById("confirmPassword");
const passwordWarning = document.getElementById("passwordWarning");

passwordInput.addEventListener("input", checkPasswords);
confirmPasswordInput.addEventListener("input", checkPasswords);

function checkPasswords() {
  if (passwordInput.value !== confirmPasswordInput.value) {
    passwordWarning.textContent = "Gesla se ne ujemata.";
  } else {
    passwordWarning.textContent = "";
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("registrationForm");
  const password = document.getElementById("password");
  const confirmPassword = document.getElementById("confirmPassword");
  const passwordWarning = document.getElementById("passwordWarning");
  const submitButton = document.querySelector(".btn.btn-primary");

  form.addEventListener("input", function () {
    if (password.value !== confirmPassword.value) {
      passwordWarning.innerText = "Gesla se ne ujemata.";
      submitButton.disabled = true;
    } else {
      passwordWarning.innerText = "";
      submitButton.disabled = false;
    }
  });
});
