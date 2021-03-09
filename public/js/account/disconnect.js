window.addEventListener("DOMContentLoaded", (event) => {
    let generalUrl      = location.origin;
    let disconnectUrl   = `${generalUrl}/api/logout`;
    let config          = { headers: { Authorization: `Bearer ${localStorage.getItem('token')}` } };
    let logout          = document.getElementById('logout');

    const logoutAction = async () => {
        try {
            const disconnect = await axios.get(disconnectUrl, config);
            if (disconnect.data.success) {
                Echo.leave(`chat`);
                localStorage.clear();
                location.href = "/connexion";
            }
        } catch (error) {
            Echo.leave(`chat`);
            localStorage.clear();
            location.href = '/connexion';
        }
    }

    logout.addEventListener('click', evt => {
        evt.stopPropagation();
        logoutAction();
    });
});