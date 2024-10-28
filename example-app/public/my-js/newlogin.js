
import { checkEmailFormet, emailWarningHide, checkPasswordFormet, passwordWarningHide, showAlert} from './functions.js';

document.getElementById('email').addEventListener('input', checkEmailFormet );

document.getElementById('email').addEventListener('blur', emailWarningHide );

document.getElementById('password').addEventListener('input', checkPasswordFormet );

document.getElementById('password').addEventListener('blur', passwordWarningHide );

document.addEventListener('DOMContentLoaded', showAlert);