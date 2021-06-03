window.addEventListener('DOMContentLoaded', () => {
    if (localStorage.getItem('darktheme') == 'y') {
        document.body.classList.add('accessibility--darktheme');
    }
    if (localStorage.getItem('nonserif') == 'y') {
        document.body.classList.add('accessibility--nonserif');
    }

    document.querySelector('button#darktheme').addEventListener('click', toggleDarkMode)
    document.querySelector('button#serif').addEventListener('click', toggleSerif);

    function toggleDarkMode() {
        document.body.classList.toggle('accessibility--darktheme');
        if (document.body.classList.contains('accessibility--darktheme')) {
            localStorage.setItem('darktheme', 'y');
        } else {
            localStorage.setItem('darktheme', null);
        }
    }

    function toggleSerif() {
        document.body.classList.toggle('accessibility--nonserif');
        if (document.body.classList.contains('accessibility--nonserif')) {
            localStorage.setItem('nonserif', 'y');
        } else {
            localStorage.setItem('nonserif', null);
        }
    }
})