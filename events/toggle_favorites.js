function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

function toggleFavorite() {
    const favorite = document.querySelector(".add_to_favorites");
    if (favorite == null) {
        return;
    }
    favorite.addEventListener('click', function (event) {
        if (favorite.textContent == 'Add to favorites ☆') {
            favorite.textContent = 'Added ✔';
            console.log("KDkd")
            const request = new XMLHttpRequest();
            request.withCredentials = true;
            request.open("POST", "../actions/action_add_to_favorites.php", true);
            request.setRequestHeader('Content-Type',
                'application/x-www-form-urlencoded')
            const resID = document.querySelector('#description>img').getAttribute('src').match('([0-9])+')
            request.send(encodeForAjax({ resID: resID[0] }));
        }
        else {
            favorite.textContent = 'Add to favorites ☆';

            const request = new XMLHttpRequest();
            request.withCredentials = true;
            request.open("POST", "../actions/action_delete_favorite.php", true);
            request.setRequestHeader('Content-Type',
                'application/x-www-form-urlencoded')
            const resID = document.querySelector('#description>img').getAttribute('src').match('([0-9])+')
            request.send(encodeForAjax({ resID: resID[0] }));
        }
    });
}

function toggleDishFavorite() {
    const favorite = document.querySelector(".add_dish_to_favorites");

    if (favorite == null) {
        return;
    }

    favorite.addEventListener('click', function (event) {
        if (favorite.textContent == 'Add to favorites ☆') {
            favorite.textContent = 'Added ✔';

            const request = new XMLHttpRequest();
            request.withCredentials = true;
            request.open("POST", "../actions/action_add_to_favorites.php", true);
            request.setRequestHeader('Content-Type',
                'application/x-www-form-urlencoded')
            const dishID = document.querySelector("#id").value
            request.send(encodeForAjax({ dishID: dishID }));
        }
        else {
            favorite.textContent = 'Add to favorites ☆';

            const request = new XMLHttpRequest();
            request.withCredentials = true;
            request.open("POST", "../actions/action_delete_favorite.php", true);
            request.setRequestHeader('Content-Type',
                'application/x-www-form-urlencoded')
            const dishID = document.querySelector("#id").value
            request.send(encodeForAjax({ dishID: dishID }));
        }
    });
}


toggleFavorite();
toggleDishFavorite();
