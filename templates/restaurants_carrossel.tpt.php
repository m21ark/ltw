<?php

declare(strict_types=1);

function drawRestaurantsCarrossel(array $restaurants)
{
?>
    <article class="restaurants">
        <h2>Restaurants</h2>

        <div class="carrosel_nav">
            <button style="  transform: scale(-1, 1);">&#10145;</button>
            <button>&#10145;</button>
        </div>

        <div class="img_carrosel">

            <?php foreach ($restaurants as $restaurant) { ?>
                <a href=<?= "restaurant.php?id=" . $restaurant->id ?> class="rm_linkdecor">
                    <div class="restaurant_item">
                        <p><?= $restaurant->name ?></p>
                        <img src="docs/restaurant.jpg" width="200" alt="pizza">
                        <p>3/5 &star;</p>
                    </div>
                </a>
            <?php } ?>
        </div>
    </article>
<?php } ?>