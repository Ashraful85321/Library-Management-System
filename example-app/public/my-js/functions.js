
export function checkEmailFormet() {
    const email = this.value;
    const warning = document.getElementById('email-warning');

    // Simple email validation (you can make it more complex)
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(email)) {
        warning.textContent = 'Please enter a valid email address';
    } else {
        warning.textContent = '';
    }
}

export function emailWarningHide() {
    const email = this.value;
    const warning = document.getElementById('email-warning');

    // Clear the warning if the input field is empty or valid
    if (email === '' || warning.textContent === 'Please enter a valid email address') {
           warning.textContent = '';
             }
}

export function checkPasswordFormet(){
    const password = this.value;
    const warning = document.getElementById('password-warning');

    if (password.length < 8) {
        warning.textContent = 'Password must be at least 8 characters long';
    } else {
        warning.textContent = '';
    }
}

export function passwordWarningHide() {
    const password = this.value;
    const warning = document.getElementById('password-warning');

    // Clear the warning if the input field is empty or valid
    if (password === '' || warning.textContent === 'Password must be at least 8 characters long') {
           warning.textContent = '';
             }
}

export function showAlert() {
    const errorAlert = document.getElementById('errorAlert');
    if (errorAlert) {
        setTimeout(() => {
            errorAlert.style.display = 'none';
        }, 3000); // 3000 milliseconds = 3 seconds
    }
}