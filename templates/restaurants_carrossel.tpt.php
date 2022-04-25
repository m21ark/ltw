<?php

declare(strict_types=1);

function drawRestaurantsCarrossel(array $restaurants)
{  // TODO 
?>
    <article class="restaurants">
        <h2>Restaurants</h2>

        <div class="carrosel_nav">
            <button style="  transform: scale(-1, 1);">&#10145;</button>
            <button>&#10145;</button>
        </div>

        <div class="img_carrosel">


            <a href="restaurant.html" class="rm_linkdecor">
                <div class="restaurant_item">
                    <p>Restaurante 1</p>
                    <img src="docs/restaurant.jpg" width="200" alt="pizza">
                    <p>3/5 &star;</p>
                </div>
            </a>

            <a href="restaurant.html" class="rm_linkdecor">
                <div class="restaurant_item">
                    <p>Restaurante 2</p>
                    <img src="docs/restaurant.jpg" width="200" alt="pizza">
                    <p>3/5 &star;</p>
                </div>
            </a>
            <a href="restaurant.html" class="rm_linkdecor">
                <div class="restaurant_item">
                    <p>Restaurante 3</p>
                    <img src="docs/restaurant.jpg" width="200" alt="pizza">
                    <p>3/5 &star;</p>
                </div>
            </a>
            <a href="restaurant.html" class="rm_linkdecor">
                <div class="restaurant_item">
                    <p>Restaurante 4</p>
                    <img src="docs/restaurant.jpg" width="200" alt="pizza">
                    <p>3/5 &star;</p>
                </div>
            </a>

        </div>
    </article>
<?php } ?>