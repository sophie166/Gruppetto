require('../scss/messages.scss');
require('../js/searchBar');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');

// scrolls the chatbox to the bottom
$(document).ready(() => {
    $('.js-chatbox').animate({ scrollTop: $('.js-chatbox').get(0).scrollHeight }, -2000);
});
