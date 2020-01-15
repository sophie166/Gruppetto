/* eslint-disable import/no-extraneous-dependencies */
require('../scss/messages.scss');
require('../js/searchBar');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');

// scrolls the chatbox to the bottom
$(document).ready(() => {
    $('.js-chatbox').animate({ scrollTop: $('.js-chatbox').get(0).scrollHeight }, -2000);
});


// chat AJAX

$(document).ready(function () {
    $('#js-send-club-message').click(function () {
        sendChatText();
        $('#general_chat_contentMessage').val("");
    });
    startChat();
});

function startChat()
{
    setInterval(function () {
        getChatText(); }, 2000);
}

function getChatText()
{
    $.ajax({
        type: "GET",
        url: "/club/chat/general",
        dataType: 'xml',
        success: function (result) {
            $(this).html(result);
        },
        error: function () {
            alert('attention');
        }
    })
}

function sendChatText()
{
    let message = $('#general_chat_contentMessage').val();
    if (message !== "") {
        $.ajax({
            type: "POST",
            data: {
                'contentMessage' : message
            },
            url: "/club/chat/general",

        });
    }
}
