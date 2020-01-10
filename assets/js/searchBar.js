const mySearchIcon = document.querySelector('.js-search-icon');
const mySearchInput = document.querySelector('.searchType');
// eslint-disable-next-line no-console
mySearchIcon.addEventListener('click', () => {
    mySearchInput.classList.toggle('visible');
});
