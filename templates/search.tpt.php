<?php

declare(strict_types=1);

function drawSearchBox()
{
?>
    <section class="search" id="search_box">
        <form class="container search_box">
            <h2>Search</h2>
            <input type="search" id="search_box_input" name="q" placeholder="Search" value=<?= htmlentities(($_GET['q']) ? $_GET['q'] : "") ?>>
        </form>
    </section>

<?php }
