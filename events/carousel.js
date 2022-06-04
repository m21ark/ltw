function createElementFromHTML(htmlString) {
    var div = document.createElement('div');
    div.innerHTML = htmlString.trim();

    return div.firstChild;
}

function carousel_res() {
    const buttons = document.querySelectorAll(".restaurants .carrosel_nav button");
    let offset = -1;
    buttons.forEach(element => {
        element.addEventListener('click', function (e) {
            const searchBoxInput = document.querySelector('#search_box_input');
            const q = (searchBoxInput !== null) ? searchBoxInput.value : "";
            offset += (element.parentNode.firstElementChild == element) ? -1 : 1;
            url = `../apis/api_restaurants.php?q=${(q !== null) ? q.split(' ').join('%20') : ''}&off=${offset}`

            fetch(url, {
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

                    if (offset < 0)
                        offset = -1;
                    if (document.querySelector('.img_carrosel').firstElementChild === null)
                        offset = -1;
                })
        });
    });
}

function carousel_plates() {
    const buttons = document.querySelectorAll(".plates .carrosel_nav button");
    let offset = -1;
    buttons.forEach(element => {
        element.addEventListener('click', function (e) {
            const searchBoxInput = document.querySelector('#search_box_input');
            const q = (searchBoxInput !== null) ? searchBoxInput.value : "";
            offset += (element.parentNode.firstElementChild == element) ? -1 : 1;
            url = `../apis/api_plates.php?q=${(q !== null) ? q.split(' ').join('%20') : ''}&off=${offset}`;
            const urlParams = new URLSearchParams(window.location.search);

            const id = urlParams.get('id');
            if (id !== null) {
                url += "&rid=" + id;
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
                    
                    if (offset < 0)
                        offset = -1;
                    if (document.querySelector('.img_carrosel').firstElementChild === null)
                        offset = -1;
                })
        });
    });
}

carousel_res();
carousel_plates();
