require('../scss/messages.scss');
require('../js/searchBar');
var sc = document.createElement("script");
sc.setAttribute("src", "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js");
sc.setAttribute("type", "text/javascript");
document.head.appendChild(sc);
// scrolls the chatbox to the bottom
$(document).ready(() => {
    $('.js-chatbox').animate({ scrollTop: $('.js-chatbox').get(0).scrollHeight }, -2000);
});
