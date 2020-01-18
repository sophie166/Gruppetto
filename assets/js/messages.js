/* eslint-disable import/no-extraneous-dependencies */

require('../scss/messages.scss');
require('../js/searchBar');
// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');

const Routing = require('../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router');
const Routes = require('./js_routes.json');

Routing.setRoutingData(Routes);

const section = document.getElementById('messages-section');
const messagesList = document.getElementById('messages-list');
const newMessageForm = document.getElementById('new-message-form');

// send a message
newMessageForm.addEventListener('submit', (event) => {
    event.preventDefault();
    new Promise((resolve, reject) => {
        const url = Routing.generate('club_chat_general');
        const xhr = new XMLHttpRequest();
        const formData = new FormData(newMessageForm);

        xhr.open('POST', url);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.addEventListener('load', function () {
            if (this.readyState === 4) {
                if (this.status === 200 && this.statusText === 'OK') {
                    resolve(JSON.parse(this.responseText));
                } else {
                    reject(JSON.parse(this.responseText));
                }
            }
        });
        xhr.send(formData);
    })

        .then((response) => {
            $('#general_chat_contentMessage').val('');
        })
        .catch((error) => {
        });
});

function createElement(name)
{
    return document.createElement(name);
}

function insertToDOM(data)
{
    const li = createElement('li');
    li.className = 'general-chat-message';

    // data
    const messageId = data.messageID;
    const pMessageNode = data.content;
    const sentBy = (data.soloName ? data.soloName : data.clubName);
    const dateNode = data.dateMessage;



    // add all the elements to the message-list in the right order
    const liMessage = messagesList.appendChild(li);
    liMessage.innerHTML = `<span class="sentBy" id="`+messageId+`">${sentBy}</span>`
        + `<p class="message">${pMessageNode}</p>`
        + `<span class="sentAt">${dateNode}</span>`;

    // get user infos
/*    function getUserInfos(clickedId)
    {*/
        document.getElementById(messageId).addEventListener('click', (event) => {
            const url = Routing.generate('club_chat_getUserInfos', { messageId: messageId });
            new Promise(((resolve, reject) => {
                const xhr = new XMLHttpRequest();

                xhr.open('GET', url);
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xhr.addEventListener('load', function (event) {
                    if (this.readyState === 4) {
                        console.log(this);
                        if (this.status === 200 && this.statusText === 'OK') {
                            resolve(JSON.parse(this.responseText));
                        } else {
                            reject(JSON.parse(this.responseText));
                        }
                    }
                });

                xhr.send();
            }))
                .then((response) => {
                    // display the infos of this user
                    if (data.soloName) {
                        const data = response[0];
                        const lastnameSolo = data.lastnameSolo;
                        const firstnameSolo = data.firstnameSolo;
                        const userCard = document.createElement("div");
                        userCard.innerHTML =
                            `<div class="user-card" id="js-user-card">
                                 <img src="data.logo" alt="">
                                 <div id="text-info">
                                    <p>`+firstnameSolo+` `+lastnameSolo+`</p>
                                    <p>lorem lorem lorem loremloremlorem lorem lorem lorem lorem lorem lorem lorem </p>
                                 </div>
                                 <button id="close-btn">Fermer</button>
                            </div>`;
                        section.appendChild(userCard);

                        function closeCard()
                        {
                            const textInfos = document.getElementById('text-info');
                            textInfos.parentNode.removeChild(textInfos);
                        }

                    } else {
                        alert('club');
                    }

                    if (document.getElementById('close-btn')) {
                        document.getElementById('close-btn').addEventListener('click', () => {
                            document.getElementById('js-user-card').style.display = 'none';
                            console.log('ok');
                        });
                    }
                })
                .catch((error) => {
                    // show error message
                });
        });
}
//}

// get all club messages
window.setInterval(() => {
    const url = Routing.generate('club_chat_get_messages');
    new Promise(((resolve, reject) => {
        const xhr = new XMLHttpRequest();

        xhr.open('GET', url);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.addEventListener('load', function (event) {
            if (this.readyState === 4) {
                if (this.status === 200 && this.statusText === 'OK') {
                    resolve(JSON.parse(this.responseText));
                } else {
                    reject(JSON.parse(this.responseText));
                }
            }
        });

        xhr.send();
    }))
        .then((response) => {
            // display the messages for the user of this club
            document.getElementById('messages-list').innerHTML = '';
            for (let index = 0; index <= response.length - 1; index += 1) {
                insertToDOM(response[index]);
            }
            $('.js-chatbox').animate({ scrollTop: $('.js-chatbox').get(0).scrollHeight });
        })
        .catch((error) => {
            // show error message
        });

}, 1000);





