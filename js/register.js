window.addEventListener('DOMContentLoaded', () => {
    const first_name = document.getElementById('first_name');
    const last_name = document.getElementById('last_name');
    const nickname = document.getElementById('nickname');
    const password1 = document.getElementById('password');
    const password2 = document.getElementById('password2');
    const errorBlock = document.getElementById('error_register');

    document.querySelector('form[name=register]').addEventListener('submit', submitHandler)
    
    function submitHandler(e) {
        e.preventDefault();
        removeServerMsg();
        clear();
        errors = 0;
        if (!nameCheck(first_name, 'Imię'))         errors += 1;
        if (!nameCheck(last_name, 'Nazwisko'))      errors += 1;
        if (!passwordCheck())                       errors += 1;
        if (!nickCheck())                           errors += 1;
        if (!termsCheck())                          errors += 1;
        if (!samePasswordCheck())                   errors += 1;
        if (!errors) {
            document.querySelector("form[name='register']").submit();
        }
    }

    function clear() {
        errorBlock.innerText = '';
    }

    function removeServerMsg() {
        let blocks = document.querySelectorAll('div.error--server');
        for (let i of blocks) {
            i.classList.add('hidden');
        }
    }

    function nameCheck(a, s='To pole') {
        let name = a.value.toLowerCase()
        const reg = /^[a-ząęóśłżźćń]*$/i;
        if (!reg.test(name)) {
            writemsg(s + ' nie może zawierać innych znaków niż litery!')
            return false;
        }
        return true;
    }

    function nickCheck() {
        const reg = /^[A-Za-z\d\-ĄĘŚĆŹŻÓŃŁąęóśłżźćń]{5,30}$/;
        if (!reg.test(nickname.value)) {
            writemsg ('Nazwa użytkownika musi mieć od 5 do 30 znaków i składać się wyłącznie z liter, cyfr i myślnika');
            return false;
        }
        return true;
    }

    function passwordCheck() {
        const reg = /^(?=.*?[A-ZĄĘŚĆŹŻÓŃŁ])(?=(.*[a-ząęóśłżźćń]){1,})(?=(.*[\d]){1,})(?=(.*[\W]){1,})(?!.*\s).{8,}$/;
        if (!reg.test(password1.value)) {
            writemsg('Hasło musi zawierać: \u22651 wielką literę, \u22651 małą literę, \u22651 znak specjalny oraz od 8 do 30 znaków');
            return false;
        }
        return true;
    }

    function samePasswordCheck() {
        if (password1.value != password2.value) {
            writemsg('Hasła muszą być identyczne!');
            return false;
        }
        return true;
    }

    function termsCheck() {
        if (!document.getElementById('terms').checked) {
            writemsg('Należy zaakceptować regulamin');
            return false;
        }
        return true;
    }

    function writemsg(s) {
        errorBlock.innerText += s + '\n';
    }
});