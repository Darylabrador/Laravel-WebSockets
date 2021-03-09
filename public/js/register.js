import { flash } from './script.js';

window.addEventListener("DOMContentLoaded", (event) => {
    let inscriptionForm = document.getElementById('inscriptionForm');
    let identity = document.getElementById('identity');
    let email = document.getElementById('email');
    let password = document.getElementById('password');
    let passwordConfirm = document.getElementById('passwordConfirm');
    let registerUrl = location.origin;
    let url = `${registerUrl}/api/inscription`;

    const registerAction = async (url, dataSend) => {
        try {
            const requestRegister = await axios.post(url, dataSend);
            const requestData = requestRegister.data;
            if (requestData.success) {
                flash(requestData.message)
                inscriptionForm.reset();
            } else {
                flash(requestData.message, false)

            }
        } catch (error) {
            flash("Ressource indisponible", false);
        }
    }


    inscriptionForm.addEventListener('submit', evt => {
        evt.preventDefault();
        let dataSend = {
            name: identity.value,
            email: email.value,
            password: password.value,
            passwordConfirm: passwordConfirm.value,
        }
        registerAction(url, dataSend);
    })
});