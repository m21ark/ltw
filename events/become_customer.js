function becomeCustomer() {
    const button = document.querySelector('.becomeCustomer').parentElement;

    button.addEventListener('click', function (e) {
        const request = new XMLHttpRequest();
        request.withCredentials = true;
        request.open("POST", "../actions/action_become_customer.php", true);
        request.setRequestHeader('Content-Type',
            'application/x-www-form-urlencoded')
        request.send(encodeForAjax({ id: button.firstChild.getAttribute("data-id") }));

        e.preventDefault();

        button.href = "perfil_info.php?type=fav";
        button.firstChild.textContent = "Favorites ☆";
        button.firstChild.classList.remove('becomeCustomer');

    }, { once: true });
}

becomeCustomer();