<?php

declare(strict_types=1);

require_once(__DIR__ . "/../database/connection.php");

function drawRestaurantsCarrossel(PDO $db, array $restaurants, bool $showNav = true)
{
?>


    <article class="carrosel container">
        <h2>Restaurants</h2>

        <?php if ($showNav) { ?>
            <div class="carrosel_nav">
                <button style="  transform: scale(-1, 1);">&#10145;</button>
                <button>&#10145;</button>
            </div>
        <?php } ?>

        <div class="img_carrosel">
            <?php foreach ($restaurants as $restaurant) { ?>
                <a href=<?= "restaurant.php?id=" . $restaurant->id ?>>
                    <div class="card_item">
                        <div class="card_face_front">
                            <p><?= $restaurant->name ?></p>
                            <img src="docs/restaurant/<?= $restaurant->id ?>.jpg" width="200" height="154" alt="pizza">
                            <p><?= $restaurant->getMediumScore($db) ?>/5 &star;</p>
                        </div>

                        <div class="card_face_back">
                            <p> <?= $restaurant->address ?> </p>
                            <p><?= $restaurant->phone ?></p>
                            <p class="link_button"><?= $restaurant->category  ?></p>
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>
    </article>
<?php }


?>