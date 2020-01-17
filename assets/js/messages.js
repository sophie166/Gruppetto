/* eslint-disable import/no-extraneous-dependencies */

require('../scss/messages.scss');
require('../js/searchBar');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');

const Routing = require('../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router');
const Routes = require('./js_routes.json');

Routing.setRoutingData(Routes);

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

function createElement(name) {
    return document.createElement(name);
}

function insertToDOM(data) {
    const li = createElement('li');
    li.className = 'general-chat-message';

    // data
    const pMessageNode = data.content;
    const sentBy = (data.soloName ? data.soloName : data.clubName);
    const dateNode = data.dateMessage;

    // add all the elements to the message-list in the right order
    const liMessage = messagesList.appendChild(li);
    liMessage.innerHTML = `<span class="sentBy">${sentBy}</span>`
        + `<p class="message">${pMessageNode}</p>`
        + `<span class="sentAt">${dateNode}</span>`;
}

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
