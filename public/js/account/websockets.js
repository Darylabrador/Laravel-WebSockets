window.addEventListener("DOMContentLoaded", (event) => {
    let config = { headers: { Authorization: `Bearer ${localStorage.getItem('token')}` } };
    let messagerie      = document.getElementById('messagerie');
    let messageForm     = document.getElementById('messageForm');
    let cancelBtn       = document.getElementById('cancelBtn');
    let contentMessage  = document.getElementById('contentMessage');
    let userConnected   = document.getElementById('userConnected');


    /**
     * retrive all messages
     */
    const getMessages = async() => {
        try {
            let getMessageUrl       = `${location.origin}/api/messages`;
            const getMessageRequest = await axios.get(getMessageUrl, config);
            const messagesData      = getMessageRequest.data.data;
            let contentMessagerie   = "";
            messagesData.forEach(message => {
                contentMessagerie += `
                <div class="card my-2">
                    <div class="card-body">
                        <p class="my-0" style="font-weight: bold !important;"> ${message.from.name} à ${message.created_at} </p>
                        <p class="my-0"> ${message.content} </p>
                    </div>
                </div>`;
            });
            messagerie.innerHTML = contentMessagerie;
        } catch (error) {
            console.log(error);
        }
    }


    /**
     * Listen event and join rooms
     */
    const listenEvent = async () => {
        try {
            let verifyUrl = `${location.origin}/api/verify`;
            const check = await axios.get(verifyUrl, config);
            const checkData = check.data.data;
            let userId = checkData.id;

            let arrayUser = [];
            let leavingArray;

            await Echo.join(`chat`)
                .here((users) => {
                    arrayUser = users;
                    let arrayFiltered = arrayUser.filter(info => info.id != userId);
                    arrayUser = arrayFiltered;
                    userConnected.innerHTML = arrayUser.length;
                })
                .joining((user) => {
                    arrayUser.push(user)
                    userConnected.innerHTML = arrayUser.length;
                })
                .leaving((user) => {
                    leavingArray = arrayUser.filter(userInfo => userInfo.id != user.id);
                    arrayUser = leavingArray;
                    userConnected.innerHTML = arrayUser.length;
                });

            Echo.private("chat")
                .listen('MessageEvent', (e) => {
                    getMessages();
                });
                
        } catch (error) {
            console.log(error)
        }
    }

    listenEvent();
    getMessages();


    cancelBtn.addEventListener('click', evt => {
        messageForm.reset();
    });


    messageForm.addEventListener('submit', async (evt) => {
        evt.preventDefault();
        try {
            let messageUrl = `${location.origin}/api/messages`;
            const sendRequest = await axios.post(messageUrl, { content: contentMessage.value }, config);
            const sendData = sendRequest.data;
            if(sendData.success) {
                messageForm.reset();
            }
        } catch (error) {
            console.log(error)
        }
    });
});