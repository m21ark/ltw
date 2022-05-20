const searchContent = document.querySelector('#search_box_input')

if (searchContent) {

    searchContent.addEventListener('input', async function () {

        console.log(this.value)

        /* ______________________________MAKE REQUESTS______________________________ */

        /*
        const response1 = await fetch('../apis/api_plates.php?search=' + this.value)
        const plates = await response1.json()

        const response2 = await fetch('../apis/api_plates.php?search=' + this.value)
        const restaurants = await response2.json()
        */


        /* _____________________________DISPLAY RESULTS_____________________________ */

        const restsDiv = document.querySelector('#search_results_rests')
        restsDiv.innerHTML = ''

        const platesDIV = document.querySelector('#search_results_plates')
        platesDIV.innerHTML = ''

        for (i = 0; i < 5; i++/*const plate of plates*/) {
            /*
                const article = document.createElement('article')
                const img = document.createElement('img')
                img.src = 'https://picsum.photos/200?' + artist.id
                const link = document.createElement('a')
                link.href = '../pages/artist.php?id=' + artist.id
                link.textContent = artist.name
                article.appendChild(img)
                article.appendChild(link)
                section1.appendChild(article)
             */
            const p = document.createElement('p')
            p.textContent = "Prato"
            platesDIV.appendChild(p)
        }

        for (i = 0; i < 5; i++/*const rest of restaurants*/) {
            /*
                const article = document.createElement('article')
                const img = document.createElement('img')
                img.src = 'https://picsum.photos/200?' + artist.id
                const link = document.createElement('a')
                link.href = '../pages/artist.php?id=' + artist.id
                link.textContent = artist.name
                article.appendChild(img)
                article.appendChild(link)
                section2.appendChild(article)
                 */
            const p = document.createElement('p')
            p.textContent = "Restaurante"
            restsDiv.appendChild(p)
        }



    })
}