/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../scss/app.scss');
require('../scss/nav.scss');
require('../scss/faq.scss');
require('../scss/messages.scss');


// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');

// takes the images in /pictures to put them in build/images
const imagesContext = require.context('../pictures', true, /\.(png|jpg|jpeg|gif|ico|svg|webp)$/);
imagesContext.keys().forEach(imagesContext);

// FAQ scroll through the answers.
const acc = document.getElementsByClassName('accordion');
let i;
function faqList() {
    this.classList.toggle('active');
    const panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
        panel.style.maxHeight = null;
    } else {
        panel.style.maxHeight = `${panel.scrollHeight}px`;
    }
}
for (i = 0; i < acc.length; i += 1) {
    acc[i].addEventListener('click', faqList);
}


// Interact with navbar, swipe effect !
const myArrow = document.querySelector('#arrow-swipe');
const myHeader = document.querySelector('header');


myArrow.addEventListener('click', () => {
    myHeader.classList.toggle('closed');
});
