require('../scss/profil.scss');



const myPens = document.querySelectorAll('.btn-modify');
const myForms = document.querySelectorAll('.box-form-update');
const myTexts = document.querySelectorAll('.box-text');

for (let i=0; i<= myForms.length; i++) {
    myPens[i].addEventListener('click',() => {
        myForms[i].classList.toggle('displayed');
        myTexts[i].classList.toggle('hidden');

    })}

/* myPen1.addEventListener('click', () => {
    myForm1.classList.toggle('displayed');
    myText1.classList.toggle('hidden');
}); */
// 1 je veux que tous mes input soient en display none quand j'arrive sur la page
// 2 je veux qu'une fois que je clique mon text box disparaisse et on input apparaisse

