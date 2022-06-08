<?php

declare(strict_types=1);

function drawSearchBox()
{
?>
    <section class="search" id="search_box">
        <form class="container search_box">
            <h2>Search</h2>
            <input type="search" id="search_box_input" name="q" autofocus placeholder="Search" value=<?= htmlentities(($_GET['q']) ? $_GET['q'] : "") ?>>
            <input type="submit" class="link_button" value="Search   &#128270;">
        </form>
    </section>

<?php }

function drawSearchResults()
{
?>

    <section class="container" id="search_results">
        <h2>Search Results</h2>

        <?php
        $db = getDatabaseConnection();
        $query = $_GET['q'];

        $restaurant_query = "SELECT Name FROM Restaurant WHERE Restaurant.Name LIKE '%$query%'";
        $plates_query = "SELECT Name FROM Dish WHERE Dish.Name LIKE '%$query%'";
        $rests = $db->query($restaurant_query);
        $plats = $db->query($plates_query);

        ?>
        <div id="search_results_rests">
            <h4>Restaurants</h4>
            <?php foreach ($rests as $rest) { ?>
                <article>
                    <p><?= htmlentities(implode('|', $rest)) ?></p>
                </article>
            <?php } ?>
        </div>

        <div id="search_results_plates">
            <h4>Plates</h4>
            <?php foreach ($plats as $plate) { ?>
                <article>
                    <p><?= htmlentities(implode('|', $plate)) ?></p>
                </article>
            <?php } ?>
        </div>


    </section>

<?php } ?>