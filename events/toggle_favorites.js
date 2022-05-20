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
        }
        else {
            favorite.textContent = 'Add to favorites ☆';
        }
    });
}

toggleFavorite();

