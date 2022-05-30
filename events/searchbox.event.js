
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
        })
    }
}

searchBoxInput();
