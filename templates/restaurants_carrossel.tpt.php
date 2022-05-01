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
                <a href=<?= "restaurant.php?id=" . $restaurant->id ?> class="rm_linkdecor">
                    <div class="restaurant_item">
                        <div class="restaurant_face restaurant_face--front">
                            <p><?= $restaurant->name ?></p>
                            <img src="docs/restaurant/<?= $restaurant->id ?>.jpg" width="200" height="154" alt="pizza">
                            <p>3/5 &star;</p>
                        </div>
                        <div class="restaurant_face restaurant_face--back">
                            <p><a href=<?= "https://www.google.com/maps?daddr=" . str_replace(' ', '%20', $restaurant->address) ?> target="#">
                                    <?= $restaurant->address ?>
                                </a>
                            </p>
                            <p><a href=<?= "tel:" . $restaurant->phone ?>><?= $restaurant->phone ?></a></p>
                            <!--- TODO :: It can have more than one category  --->
                            <p><a class="link_button" href="#"><?= $restaurant->category ?></a></p>
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>
    </article>
<?php } ?>