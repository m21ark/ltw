function becomeUser() {
    const tmp = document.querySelector('.becomeCustomer');


    if (tmp != null) {
        const button = document.querySelector('.becomeCustomer').parentElement;
        button.addEventListener('click', function (e) {
            const request = new XMLHttpRequest();
            request.withCredentials = true;
            request.open("POST", "../actions/action_become_user.php", true);
            request.setRequestHeader('Content-Type',
                'application/x-www-form-urlencoded')
            request.send(encodeForAjax({ id: button.firstChild.getAttribute("data-id"), type: "Customer" }));

            e.preventDefault();

            button.href = "perfil_info.php?type=fav";
            button.firstChild.textContent = "Favorites ☆";
            button.firstChild.classList.remove('becomeCustomer');

        }, { once: true });
    }

    const tmp2 = document.querySelector('.becomeCourier');
    if (tmp2 != null) {
        const courier = document.querySelector('.becomeCourier').parentElement;
        courier.addEventListener('click', function (e) {
            const request = new XMLHttpRequest();
            request.withCredentials = true;
            request.open("POST", "../actions/action_become_user.php", true);
            request.setRequestHeader('Content-Type',
                'application/x-www-form-urlencoded')
            request.send(encodeForAjax({ id: courier.firstChild.getAttribute("data-id"), type: "Courier" }));

            e.preventDefault();

            courier.href = `control_center.php?cid=${courier.firstChild.getAttribute("data-id")}`;
            courier.firstChild.textContent = "My deliveries";
            courier.firstChild.classList.remove('becomeCourier');

        }, { once: true });
    }
}

becomeUser();