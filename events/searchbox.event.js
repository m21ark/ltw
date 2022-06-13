function searchBoxInput() {
    const searchContent = document.querySelector('#search_box_input')

    if (searchContent) {
        searchContent.addEventListener('input', async function () {
            fetch(`../apis/api_restaurants.php?q=${(this.value !== null) ? this.value.split(' ').join('%20') : ''}`, {
                method: "GET",
                headers: new Headers({ 'Content-Type': 'text/html' }
                )
            })
                .then(function (res) {
                    return res.text();
                }).then(function (res) {

                    const div = document.querySelector('.restaurants');
                    const element = createElementFromHTML(res);
                    const carrosel = div.querySelector('.img_carrosel');
                    div.insertBefore(element.querySelector('.img_carrosel'), carrosel);
                    div.removeChild(carrosel);
                })

            fetch(`../apis/api_plates.php?q=${(this.value !== null) ? this.value.split(' ').join('%20') : ''}`, {
                method: "GET",
                headers: new Headers({ 'Content-Type': 'text/html' }
                )
            })
                .then(function (res) {
                    return res.text();
                }).then(function (res) {
                    const div = document.querySelector('.plates');
                    const element = createElementFromHTML(res);
                    const carrosel = div.querySelector('.img_carrosel');
                    div.insertBefore(element.querySelector('.img_carrosel'), carrosel);
                    div.removeChild(carrosel);
                })
        })
    }
}

function searchCategory() {
    const navCat = document.querySelectorAll("#navbar>ul>li>a");

    navCat.forEach(element => {
        const searchContent = document.querySelector('#search_box_input')

        element.addEventListener('click', function (evt) {
            evt.preventDefault()
            window.location.hash = element.textContent;

            let url = `../apis/api_plates.php?q=${(searchContent !== null && searchContent.value !== null) ? searchContent.value.split(' ').join('%20') : ''}&cat=${element.textContent}`;
            const urlParams = new URLSearchParams(window.location.search);

            const id = urlParams.get('id');
            if (id !== null) {
                url += "&rid=" + id;
            } else {
                fetch(`../apis/api_restaurants.php?q=${(searchContent.value !== null) ? searchContent.value.split(' ').join('%20') : ''}&cat=${element.textContent}`, {
                    method: "GET",
                    headers: new Headers({ 'Content-Type': 'text/html' }
                    )
                })
                    .then(function (res) {
                        return res.text();

                    }).then(function (res) {

                        const div = document.querySelector('.restaurants');
                        const element = createElementFromHTML(res);
                        const carrosel = div.querySelector('.img_carrosel');
                        div.insertBefore(element.querySelector('.img_carrosel'), carrosel);
                        div.removeChild(carrosel);
                    })
            }
            fetch(url, {
                method: "GET",
                headers: new Headers({ 'Content-Type': 'text/html' }
                )
            })
                .then(function (res) {
                    return res.text();
                }).then(function (res) {
                    const div = document.querySelector('.plates');
                    const element = createElementFromHTML(res);
                    const carrosel = div.querySelector('.img_carrosel');
                    div.insertBefore(element.querySelector('.img_carrosel'), carrosel);
                    div.removeChild(carrosel);
                })
        })
    });
}

searchBoxInput();
searchCategory();

function parse_fragment() {
    const hash = window.location.hash

    if (hash) {
        const category = hash
    }
}

window.location = '#';
window.addEventListener('hashchange', parse_fragment)