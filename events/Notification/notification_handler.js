function notification() {
    // const request = new XMLHttpRequest();
    // request.withCredentials = true;
    // request.open("GET", "events/Notification/test.php", true);
    // request.setRequestHeader('Cache-Control', 'no-cache');
    // request.timeout = 500;
    // request.setRequestHeader('Content-Type',
    //     'application/x-www-form-urlencoded')
    // request.onreadystatechange = function (data) {
    //     if (request.readyState == XMLHttpRequest.DONE) {
    //         const new_notifications = this.responseText;
    //         if (new_notifications.includes('New Order Pending')) {
    //             let audio = new Audio('audio/notification.wav');
    //             audio.play();
    //         }
    //     }
    // }
    const id = document.querySelector('.user_id');
    if (id === null)
        return;
    fetch(`../events/Notification/test.php?id=${parseInt(id.getAttribute('data-id'))}`, {
        method: "GET",
        headers: new Headers({'Content-Type': 'application/json'}
    )})
    .then(function(res) {
        return res.json();
    }).then (function (res) {
        console.log(res)
    })    
}

setInterval(function() {notification();}, 5000);