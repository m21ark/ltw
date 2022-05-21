<?php

declare(strict_types=1);

require_once(__DIR__ . "/../database/connection.php");


function drawPlatesCarrossel(array $plates, bool $showNav = true)
{  // TODO ::: this is a repetition of the restaurant, maybe consider making a carrossel draw if possible
?>
    <article class="carrosel container plates">
        <h2>Plates</h2>

        <?php if ($showNav) { ?>
            <div class="carrosel_nav">
                <button style="  transform: scale(-1, 1);">&#10145;</button>
                <button>&#10145;</button>
            </div>
        <?php } ?>

        <div class="img_carrosel">
            <?php foreach ($plates as $dish) { ?>
                <a href=<?= "plate.php?id=" . urlencode("$dish->id") ?>>
                    <div class="card_item">
                        <div class="card_face_front">
                            <p><?= htmlentities("$dish->name") ?></p>
                            <img src="../docs/food/<?= htmlentities("$dish->id") ?>.jpg" width="200" height="154" alt="pizza">
                            <p><?= htmlentities("$dish->price") . "€" ?></p>
                        </div>

                        <div class="card_face_back">
                            <?php
                            $db = getDatabaseConnection();
                            $ingredients = $dish->getIngredients($db);
                            foreach ($ingredients as $ing) {  ?>
                                <p>- <?= htmlentities($ing['IngredientName']) ?></p>
                            <?php } ?>


                        </div>

                    </div>
                </a>
            <?php } ?>
        </div>
    </article>
<?php } ?>