/**
 * Affichage du toast message
 * @param {String} message 
 * @param {String} success 
 */
export const flash = (message, success = true) => {
    var messageFlash = new bootstrap.Toast(document.getElementById('messageFlash'));
    let toastContainer = document.getElementById('messageFlash');
    let bodyToast = document.getElementById('bodyToast');
    if (success) {
        toastContainer.classList.add('bg-success');
        toastContainer.classList.remove('bg-danger');
        bodyToast.textContent = message;
    } else {
        toastContainer.classList.add('bg-danger');
        toastContainer.classList.remove('bg-success');
        bodyToast.textContent = message;
    }
    bodyToast.classList.add('text-white');
    messageFlash.show()
}
