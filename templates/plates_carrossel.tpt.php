<?php

declare(strict_types=1);

function drawPlatesCarrossel(array $plates)
{  // TODO ::: this is a repetition of the restaurant, maybe consider making a carrossel draw if possible
?>
    <article class="plates">
        <h2>Plates</h2>

        <div class="carrosel_nav">
            <button style="  transform: scale(-1, 1);">&#10145;</button>
            <button>&#10145;</button>
        </div>

        <div class="img_carrosel">


            <a href="plate.html" class="rm_linkdecor">
                <div class="plate_item">
                    <p>Pizza de Atum</p>
                    <img src="docs/pizza.jpg" width="200" alt="pizza">
                    <p>9,99$</p>
                </div>
            </a>

            <a href="plate.html" class="rm_linkdecor">
                <div class="plate_item">
                    <p>Pizza de Atum</p>
                    <img src="docs/pizza.jpg" width="200" alt="pizza">
                    <p>9,99$</p>
                </div>
            </a>
            <a href="plate.html" class="rm_linkdecor">
                <div class="plate_item">
                    <p>Pizza de Atum</p>
                    <img src="docs/pizza.jpg" width="200" alt="pizza">
                    <p>9,99$</p>
                </div>
            </a>
            <a href="plate.html" class="rm_linkdecor">
                <div class="plate_item">
                    <p>Pizza de Atum</p>
                    <img src="docs/pizza.jpg" width="200" alt="pizza">
                    <p>9,99$</p>
                </div>
            </a>

        </div>
    </article>
<?php } ?>