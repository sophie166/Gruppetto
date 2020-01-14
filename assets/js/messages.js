require('../scss/messages.scss');
require('../js/searchBar');

// scrolls the chatbox to the bottom
$(document).ready(() => {
    $('.js-chatbox').animate({ scrollTop: $('.js-chatbox').get(0).scrollHeight }, -2000);
});
