function removePost(post_id) {
    let reason = ''
    if (reason = prompt('Jaki podać powód usunięcia?')) {
        let elem = document.querySelector('div#admin-msg');
        const request = new XMLHttpRequest();
        request.onreadystatechange = () => {
            if (request.readyState == 4 && request.status == 200) {
                const text = request.responseText;
                elem.innerText = text;
                elem.textContent = text;
            }
        }
        url = `http://localhost/beTogether/action/remove_post?post_id=${post_id}&reason=${reason}`;
        request.open('GET', url, true);
        request.overrideMimeType('text/xml');
        request.send();
    }
}

function removeUser(user_id) {
    let reason = ''
    if (reason = prompt('Jaki podać powód usunięcia?')) {
        let elem = document.querySelector('div#admin-msg');
        const request = new XMLHttpRequest();
        request.onreadystatechange = () => {
            if (request.readyState == 4 && request.status == 200) {
                const text = request.responseText;
                elem.innerText = text;
                elem.textContent = text;
            }
        }
        url = `http://localhost/beTogether/action/remove_user?user_id=${user_id}&reason=${reason}`;
        request.open('GET', url, true);
        request.overrideMimeType('text/xml');
        request.send();
    }
}