// Toggle show/hide password
function togglePassword(inputId, eyeOpenId, eyeClosedId) {
    const input = document.getElementById(inputId);
    const eyeOpen = document.getElementById(eyeOpenId);
    const eyeClosed = document.getElementById(eyeClosedId);

    if (input.type === "password") {
        input.type = "text";
        eyeOpen.style.display = "none";
        eyeClosed.style.display = "inline";
    } else {
        input.type = "password";
        eyeOpen.style.display = "inline";
        eyeClosed.style.display = "none";
    }
}

// Validasi password
function validatePassword() {
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirm_password").value;

    if (password !== confirmPassword) {
        alert("Password dan Confirm Password tidak sama!");
        return false;
    }
    return true;
}