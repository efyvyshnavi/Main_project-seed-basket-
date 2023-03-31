// Email field validation
const emailField = document.getElementById("yourEmail");
emailField.oninput = function() {
  if (emailField.validity.valid) {
    emailField.classList.remove("is-invalid");
    emailField.classList.add("is-valid");
  } else {
    emailField.classList.remove("is-valid");
    emailField.classList.add("is-invalid");
  }
};


const passwordField = document.getElementById("yourPassword");
const passwordError = document.getElementById("passwordError");

// Define the regular expression pattern
const passwordPattern = /^(?=.*[A-Z])[a-zA-Z0-9!@#$%^&*()-_+={}[\]\\|:;"'<>,.?/]{5,}$/;

// Function to validate the password
function validatePassword() {
  if (passwordField.value.match(passwordPattern)) {
    passwordField.classList.remove("is-invalid");
    passwordField.classList.add("is-valid");
    passwordError.innerHTML = "";
  } else {
    passwordField.classList.remove("is-valid");
    passwordField.classList.add("is-invalid");
    passwordError.innerHTML = "Password must start with a capital letter and have at least 5 characters.";
  }
}

// Validate the password on input
passwordField.oninput = validatePassword;

