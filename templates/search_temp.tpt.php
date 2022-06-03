<?php

function drawSearchResults()
{  // TODO
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
                    <p><?php echo implode('|', $rest) ?></p>
                </article>
            <?php } ?>
        </div>

        <div id="search_results_plates">
            <h4>Plates</h4>
            <?php foreach ($plats as $plate) { ?>
                <article>
                    <p><?php echo implode('|', $plate) ?></p>
                </article>
            <?php } ?>
        </div>


    </section>

<?php } ?>

<?php
function drawSearchResultsNavBar()
{  // TODO
?>

    <section class="container" id="search_results">
        <h2>Search Results</h2>

        <?php 
        $db = getDatabaseConnection();
        $query = $_GET['q'];
        
        $restaurant_query = "SELECT Name FROM Restaurant WHERE Restaurant.Category LIKE '%$query%'";
        $rests = $db->query($restaurant_query);
        
?>
        <div id="search_results_rests">
            <h4>Restaurants</h4>
            <?php foreach ($rests as $rest) { ?>
                <article>
                    <p><?php echo implode('|', $rest) ?></p>
                </article>
            <?php } ?>
        </div>


    </section>

<?php } ?>