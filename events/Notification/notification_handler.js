function notification() {
    const request = new XMLHttpRequest();
    request.withCredentials = true;
    request.open("GET", "events/Notification/test.php", true);
    request.setRequestHeader('Cache-Control', 'no-cache');
    request.timeout = 500;
    request.setRequestHeader('Content-Type',
        'application/x-www-form-urlencoded')
    request.onreadystatechange = function (data) {
        if (request.readyState == XMLHttpRequest.DONE) {
            const new_notifications = this.responseText;
            if (new_notifications.includes('New Order Pending')) {
                let audio = new Audio('audio/notification.wav');
                audio.play();
            }
        }
    }

    request.onerror = function(XMLHttpRequest, textStatus, errorThrown) {

    }

    request.send(); // send the data later --- to know wich user we are and to see if a notification is available
    
}

//setInterval(function() {notification();}, 5000);