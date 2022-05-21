function createElementFromHTML(htmlString) {
    var div = document.createElement('div');
    div.innerHTML = htmlString.trim();
  
    return div.firstChild;
}

function carousel_res() {
    const buttons = document.querySelectorAll(".restaurants .carrosel_nav button");
    buttons.forEach(element => {
        element.addEventListener('click', function(e) {
            fetch(`../apis/api_restaurants.php?response=html`, {
                method: "GET",
                headers: new Headers({'Content-Type': 'text/html'}
            )})
            .then(function(res) {
                return res.text();
            }).then (function (res) {
                
                const div = document.querySelector('.restaurants');
                //div.innerHTML = res.innerHTML;
                const element = createElementFromHTML(res);
                const carrosel = div.querySelector('.img_carrosel');
                div.insertBefore(element.querySelector('.img_carrosel'), carrosel);
                div.removeChild(carrosel);
            })
        });
    });
}

function carousel_plates() {

}

carousel_res();
carousel_plates();
