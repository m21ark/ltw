function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

function toggleFavorite() {
    const favorite = document.querySelector(".add_to_favorites");

    favorite.addEventListener('click', function (event) {
        if (favorite.textContent == 'Add to favorites ☆') {
            favorite.textContent = 'Added ✔';

            const request = new XMLHttpRequest();
            request.withCredentials = true;
            request.open("POST", "../actions/action_add_to_favorites.php", true);
            request.setRequestHeader('Content-Type',
                'application/x-www-form-urlencoded')
            const dishID = document.querySelector('#description>img').getAttribute('src').match('([0-9])+')
            console.log(dishID[0])
            request.send(encodeForAjax({ dishID: dishID[0]}));
        }
        else {
            favorite.textContent = 'Add to favorites ☆';
        }
    });
}

toggleFavorite();

