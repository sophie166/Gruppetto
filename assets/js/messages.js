require('../scss/messages.scss');
require('../js/searchBar');
document.head.innerHTML += "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>";
// scrolls the chatbox to the bottom
$(document).ready(() => {
    $('.js-chatbox').animate({ scrollTop: $('.js-chatbox').get(0).scrollHeight }, -2000);
});
