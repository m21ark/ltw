function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
  }

function removeDishFromCart() {
    const deleteButton = document.querySelectorAll(".container_delete");

    for (const button of deleteButton) {
        button.addEventListener('click', function() {
            //const hidden = document.createElement('input');
            //hidden.type = 'hidden';
            //hidden.id = 'id'
            //hidden.name = 'id'
            //hidden.value = button.value;
            console.log(button.id);
            const request = new XMLHttpRequest();
            request.withCredentials = true;
            request.open("POST", "../actions/action_remove_from_cart.php", true);
            request.setRequestHeader('Content-Type', 
                'application/x-www-form-urlencoded')

            request.send(encodeForAjax({id: button.id}));
            //button.parentNode.parentNode.parentNode.appendChild(hidden);
            button.parentNode.parentNode.removeChild(button.parentNode);
        });
    }
}

removeDishFromCart();