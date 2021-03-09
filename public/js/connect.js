import { flash } from './script.js';

window.addEventListener("DOMContentLoaded", (event) => {
    let loginForm = document.getElementById('loginForm');
    let email = document.getElementById('email');
    let password = document.getElementById('password');
    let loginUrl = location.origin;
    let url = `${loginUrl}/api/connexion`;

    const loginAction = async (url, dataSend) => {
        try {
            const requestLogin = await axios.post(url, dataSend);
            const requestData = requestLogin.data;
            if (requestData.success) {
                localStorage.setItem('token', requestData.token);
                loginForm.reset();
                location.href = '/';
            } else {
                flash(requestData.message, false);
            }
        } catch (error) {
            flash("Ressource indisponible", false);
        }
    }

    loginForm.addEventListener('submit', evt => {
        evt.preventDefault();
        let dataSend = {
            email: email.value,
            password: password.value,
        }
        loginAction(url, dataSend);
    })
})