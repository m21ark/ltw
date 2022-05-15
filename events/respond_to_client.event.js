function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
  }

function respondClient() {
    const resButton = document.querySelectorAll(".respond_button");
    
    for (const button of resButton) {
        button.addEventListener('click', function() {

            if (button.parentNode.querySelector('textarea').value.trimStart.trimEnd) // TODO
                return;

            const request = new XMLHttpRequest();
            request.withCredentials = true;
            request.open("POST", "../actions/action_add_response.php", true);
            request.setRequestHeader('Content-Type', 
                'application/x-www-form-urlencoded')

            request.send(encodeForAjax({id: button.getAttribute("value"), comment: button.parentNode.querySelector('textarea').value.trimStart()}));
            const element = document.createElement('p');
            element.classList.add('response_text');
            element.textContent = button.parentNode.querySelector('textarea').value.trimStart() + ' ✔' 
            button.parentElement.parentNode.appendChild(element)

            button.parentElement.parentNode.removeChild(button.parentElement.parentNode.querySelector('.response_form'))
            
        });
    }
}

respondClient();