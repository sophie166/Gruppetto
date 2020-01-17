/* eslint-disable import/no-extraneous-dependencies */
/* eslint-disable import/no-multi-spaces */
/* eslint-disable import/no-shadow */
/* eslint-disable import/semi */
/* eslint-disable import/no-console */
/* eslint-disable import/func-names */
/* eslint-disable import/no-use-before-define */
require('../scss/messages.scss');
require('../js/searchBar');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');

const Routing = require('../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router');
const Routes = require('./js_routes.json');

Routing.setRoutingData(Routes);

let messagesList = document.getElementById('messages-list');
let newMessageForm = document.getElementById('new-message-form');

// send a message
newMessageForm.addEventListener('submit',  (event) => {
    event.preventDefault();
    new Promise( (resolve, reject) => {
        let url = Routing.generate('club_chat_general');
        let xhr = new XMLHttpRequest();
        let formData = new FormData(newMessageForm);

        xhr.open("POST", url);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.addEventListener('load', function (event) {

            if (this.readyState===4) {
                if (this.status === 200 && this.statusText==="OK") {
                    resolve(JSON.parse(this.responseText))
                } else {
                    reject(JSON.parse(this.responseText))
                }
            }
        });
        console.log(formData);
        xhr.send(formData)


    })

        .then((response) => {
            $('#general_chat_contentMessage').val('');
        })
        .catch((error) => {
            console.log(error)
        })

});

// get all club messages
window.setInterval(function () {
    let url = Routing.generate('club_chat_get_messages');
    new Promise(function (resolve, reject) {
        let xhr = new XMLHttpRequest();

        xhr.open("GET", url);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.addEventListener('load', function (event) {

            if (this.readyState===4) {
                if (this.status === 200 && this.statusText==="OK") {
                    resolve(JSON.parse(this.responseText))
                } else {
                    reject(JSON.parse(this.responseText))
                }
            }
        });

        xhr.send()
    })
        .then((response)=> {
            // display the messages for the user of this club
            document.getElementById('messages-list').innerHTML = "";
            for (let index = 0; index <= response.length-1; index++) {
                insertToDOM(response[index])
            }
            $('.js-chatbox').animate({ scrollTop: $('.js-chatbox').get(0).scrollHeight })
        })
        .catch((error) => {
            // show error message
            console.log(error)
        })
}, 1000);

function insertToDOM(data)
{
    let li = createElement('li');
    li.className = "general-chat-message";

    // data
    let pMessageNode = data.content;
    let sentBy = (data.soloName ? data.soloName : data.clubName);
    let dateNode = data.dateMessage;

    // add all the elements to the message-list in the right order
    let li_message = messagesList.appendChild(li);
    li_message.innerHTML =
        '<span class="sentBy">' + sentBy + '</span>' +
        '<p class="message">' + pMessageNode + '</p>' +
        '<span class="sentAt">' + dateNode +'</span>';
}

function createElement(name)
{
    return document.createElement(name)
}
