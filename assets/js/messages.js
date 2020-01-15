/* eslint-disable import/no-extraneous-dependencies */
require('../scss/messages.scss');
require('../js/searchBar');

let Routing = require('../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router');
let Routes = require('./js_routes.json');

Routing.setRoutingData(Routes);

 // let message_id = document.getElementsByClassName('general-chat-message');
let messages_list = document.getElementById('messages-list');

document.addEventListener('DOMContentLoaded', function (event) {
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
            console.log(response);
            // display the messages for the user of this club
            console.log(response.length);
            for (let index = 0; index < response.length; index++) {
                insertToDOM(response[index])
            }
        })
        .catch((error) => {
            // show error message
            console.log(error)
        })
});

function insertToDOM(data)
{

    let date = new Date(data.dateMessage.timestamp*1000);
    console.log(date);
    //message paragraph
    let li = createElement('li');
    let pTextNode = document.createTextNode(data.contentMessage);
    let dateTextNode = document.createTextNode(date);
    li.appendChild(pTextNode);
    //li.appendChild(dateTextNode);

    // add all the elements to the message-list in the right order
    messages_list.appendChild(li);
}

function createElement(name)
{
    return document.createElement(name)
}










// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');

// scrolls the chatbox to the bottom
$(document).ready(() => {
    $('.js-chatbox').animate({ scrollTop: $('.js-chatbox').get(0).scrollHeight }, -2000);
});

