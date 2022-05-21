function becomeCustomer() {
    const button = document.querySelector('.becomeCustomer').parentElement;
    console.log(button.getAttribute("data-id"));

    button.addEventListener('click', function(e) {
        const request = new XMLHttpRequest();
        request.withCredentials = true;
        request.open("POST", "../actions/action_become_customer.php", true);
        request.setRequestHeader('Content-Type',
            'application/x-www-form-urlencoded')// 
        request.send(encodeForAjax({ id: button.getAttribute("data-id")}));

        e.preventDefault();
        
        button.href = "perfil_info.php?type=fav";
        button.firstChild.textContent = "Favorites &star;";
        button.firstChild.classList.remove('becomeCustomer');
        
    },{once : true});
}

becomeCustomer();