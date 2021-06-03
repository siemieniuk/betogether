document.addEventListener('DOMContentLoaded', () => {
    let nav = document.querySelector('nav');

    function hamburgerPressed() {
        if (nav.classList.contains('menu--show') || nav.classList.contains('menu--hide')) {
            nav.classList.toggle('menu--show');
            nav.classList.toggle('menu--hide');
        } else {
            nav.classList.add('menu--show');
        }
    }
    
    document.querySelector('#hamburger').addEventListener('click', hamburgerPressed);
})