const mobileNumberInput = document.getElementById("mobileNumber");

mobileNumberInput.addEventListener("input", function () {
    // Remove any non-numeric characters from the input
    const cleanedInput = this.value.replace(/[^0-9]/g, '');

    // Limit the input to a maximum of 10 digits
    const maxLength = 10;
    const truncatedInput = cleanedInput.slice(0, maxLength);

    // Update the input value with the cleaned and truncated value
    this.value = truncatedInput;
});
const emailInput = document.getElementById("email");

emailInput.addEventListener("blur", function () {
    const email = this.value.trim();

    // Regular expression for validating email addresses
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        this.value = ''; // Clear the input field
        this.focus();   // Set focus back to the input field
    }
});
const availableInput = document.getElementById("availableInput");
const numberDropdown = document.getElementById("numberDropdown");

numberDropdown.addEventListener("change", function () {
    const selectedValue = parseInt(this.value);

    // Ensure the selected value is between 0 and 5
    if (selectedValue >= 0 && selectedValue <= 5) {
        availableInput.value = selectedValue.toString();
    } else {
        alert("Please select a number between 0 and 5.");
        this.value = "0"; // Reset the dropdown to 0
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const ageInput = document.querySelector("input[type='number']");

    ageInput.addEventListener("input", function () {
        const age = parseInt(ageInput.value);
        const ageLabel = document.querySelector("label[for='ageInput']");

        if (age < 19) {
            ageLabel.style.color = "red";
            ageInput.setCustomValidity("Age must be 18 or older.");
        } else {
            ageLabel.style.color = "";
            ageInput.setCustomValidity("");
        }
    });
});

