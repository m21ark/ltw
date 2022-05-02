<?php

declare(strict_types=1);

function drawPlatesCarrossel(array $plates, bool $showNav = true)
{  // TODO ::: this is a repetition of the restaurant, maybe consider making a carrossel draw if possible
?>
    <article class="carrosel container">
        <h2>Plates</h2>

        <?php if ($showNav) { ?>
            <div class="carrosel_nav">
                <button style="  transform: scale(-1, 1);">&#10145;</button>
                <button>&#10145;</button>
            </div>
        <?php } ?>

        <div class="img_carrosel">
            <?php foreach ($plates as $dish) { ?>
                <a href=<?= "plate.php?id=" . $dish->id ?>>
                    <div class="card_item">
                        <div class="card_face_front">
                            <p><?= $dish->name ?></p>
                            <img src="docs/food/<?= $dish->id ?>.jpg" width="200" height="154" alt="pizza">
                            <p><?= $dish->price . "€" ?></p>
                        </div>
                        <div class="card_face_back">
                            <p> BACK SIDE INFO </p>
                            <img src="docs/food/<?= $dish->id ?>.jpg" width="200" height="154" alt="pizza">
                            <p><?= $dish->price . "$" ?></p>
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>
    </article>
<?php } ?>