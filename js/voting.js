function votePost(elem, post_id, vote_type) {
    const request = new XMLHttpRequest();
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200) {
            const htmldoc = request.responseXML;
            elem.innerText = htmldoc.querySelector('p').textContent;
            elem.textContent = htmldoc.querySelector('p').textContent;
        }
    }
    url = `http://localhost/beTogether/action/vote?post_id=${post_id}&votetype=${vote_type}`;
    request.open('GET', url, true);
    request.responseType = 'document';
    request.overrideMimeType('text/xml');
    request.send();
}