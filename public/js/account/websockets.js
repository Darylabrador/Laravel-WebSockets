import { flash } from '../script.js';

window.addEventListener("DOMContentLoaded", (event) => {
    let config       = { headers: { Authorization: `Bearer ${localStorage.getItem('token')}` } };



    const listenEvent = async () => {
        try {
            let verifyUrl = `${location.origin}/api/verify`;
            const check = await axios.get(verifyUrl, config);
            const checkData = check.data.data;
            let userId = checkData.id;

            let messagerie = document.getElementById('messagerie');
            let arrayUser = [];
            let leavingArray;
            
            await Echo.join(`chat`)
                .here((users) => {
                    arrayUser = users;
                    let arrayFiltered = arrayUser.filter(info => info.id != userId);
                    arrayUser = arrayFiltered;
                    console.log('liste utilisateur connecté : ', arrayUser)
                })
                .joining((user) => {
                    console.log(`${user.name} a rejoint le salon`);
                    arrayUser.push(user)
                    console.log(arrayUser)
                })
                .leaving((user) => {
                    console.log(`${user.name} a quitté le salon`);
                    leavingArray = arrayUser.filter(userInfo => userInfo.id != user.id);
                    arrayUser = leavingArray;
                    console.log(arrayUser);
                });
        } catch (error) {
            flash('Websockets error', false);
        }
    }
    listenEvent();
});