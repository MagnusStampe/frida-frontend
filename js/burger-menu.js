document.querySelector('#burger_button').addEventListener('click', toggleMenu);

function toggleMenu() {
    document.querySelector('#page_header').classList.toggle('open');
}
