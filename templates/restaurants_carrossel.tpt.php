<?php

declare(strict_types=1);

function drawRestaurantsCarrossel(array $restaurants, bool $showNav = true)
{
?>
    <article class="restaurants">
        <h2>Restaurants</h2>

        <?php if ($showNav) { ?>
            <div class="carrosel_nav">
                <button style="  transform: scale(-1, 1);">&#10145;</button>
                <button>&#10145;</button>
            </div>
        <?php } ?>

        <div class="img_carrosel">

            <?php foreach ($restaurants as $restaurant) { ?>
                <a href=<?= "restaurant.html?id=" . $restaurant->id ?> class="rm_linkdecor">
                    <div class="restaurant_item">
                        <div class="restaurant_face restaurant_face--front">
                            <p><?= $restaurant->name ?></p>
                            <img src="docs/restaurant.jpg" width="200" alt="pizza">
                            <p>3/5 &star;</p>
                        </div>
                        <div class="restaurant_face restaurant_face--back">
                            <p><a href="https://www.google.com/maps/place/Rua das Amoreiras, Lisboa" target="#">Rua das Amoreiras - Lisboa</a></p>
                            <p><a href="tel:+4733378901">22456789</a></p>
                            <p><a class="link_button" href="#">Italian Food</a></p>
                            <p><a class="link_button" href="#">Italian Food</a></p>
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>
    </article>
<?php } ?>