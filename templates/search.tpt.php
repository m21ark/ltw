<?php

declare(strict_types=1);

function drawSearchBox()
{  // TODO
?>
    <section class="search" id="search_box">
        <form class="container search_box">
            <h2>Search</h2>
            <input type="search" id="search_box_input" name="q" autofocus placeholder="Search" value=<?= $_GET['q'] ?>>
            <input type="submit" class="link_button" value="Search   &#128270;">
        </form>
    </section>

<?php }

function drawSearchResults(array $restaurants, array $plates)
{  // TODO
?>

    <section class="container" id="search_results">
        <h2>Search Results</h2>

        <div id="search_results_rests">
            <h4>Restaurants</h4>
            <?php foreach ($restaurants as $rest) { ?>
                <article>
                    <p><?= $rest->name ?></p>
                </article>
            <?php } ?>
        </div>

        <div id="search_results_plates">
            <h4>Plates</h4>
            <?php foreach ($plates as $plate) { ?>
                <article>
                    <p><?= $plate->name ?></p>
                </article>
            <?php } ?>
        </div>


    </section>

<?php } ?>