require('../scss/messages.scss');
require('../js/searchBar');

$(document).ready(() => {
    $('.js-chatbox').animate({
        scrollTop: $('.js-chatbox').get(0).scrollHeight
    }, -2000);
});
