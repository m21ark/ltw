function notification() {
    
    const id = document.querySelector('.user_id');
    if (id === null)
        return;
    fetch(`../../apis/api_notification.php?id=${parseInt(id.getAttribute('data-id'))}`, {
        method: "GET",
        headers: new Headers({'Content-Type': 'application/json'}
    )})
    .then(function(res) {
        return res.json();
    }).then (function (res) {
        if (res !== null) {
            const audio = new Audio('../audio/notification.wav');
            audio.play();
            const myNotification = document.createElement('section');
            myNotification.setAttribute('id', 'session_messages');
            const art = document.createElement('article')
            const p = document.createElement('p')
            art.classList.add('info');
            p.textContent = "Order State: " + res;
            art.appendChild(p)
            myNotification.appendChild(art);
            document.querySelector('main').insertBefore(myNotification, document.querySelector('main').firstChild);

            setTimeout(function() {
                art.parentNode.removeChild(art);
            }, 5000);
        }
    })    
}

setInterval(function() {notification();}, 5000);