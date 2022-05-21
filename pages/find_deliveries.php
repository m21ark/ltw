<?php

declare(strict_types=1);

require_once(__DIR__ . "/../database/Users/user_composite.class.php");
require_once(__DIR__ . "/../database/Users/customer.class.php");
require_once(__DIR__ . "/../templates/common.tpt.php");
require_once(__DIR__ . "/../templates/plates_carrossel.tpt.php");
require_once(__DIR__ . "/../templates/restaurants_carrossel.tpt.php");
require_once(__DIR__ . "/../database/connection.php");

// Restricts access to logged in users
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if (!$session->isLoggedIn()) {
    $session->addMessage('erro', 'Login required. Redirected to main page');
    die(header('Location: /'));
}

$user = unserialize($session->getUserSerialized());


$acess = $user->hasPermission("Courier");
if ($acess === null) {
    $session->addMessage('erro', 'You dont have courier permissions');
    die(header('Location: /'));
}


$db = getDatabaseConnection();


output_header();

$dishes = Dish::getRandomDishes($db, 4);
?>


<section id="delivery_container" class="container">
    <h2>Order being taking</h2>

    <div class="delivery_taken">
        <h3><?= "Name" ?></h3>
        <p><?= "14.95€" ?></p>
        <a class="link_button" href="#">Cancel Order</a>
    </div>

</section>


<section id="delivery_container" class="container">
    <h2>Orders waiting delivery</h2>
    <div>



        <article class="delivery_item">
            <div>
            <p><?= "Name" ?></p>
            <p><?= "14.95€" ?></p>
            <a class="link_button" href="#">Take Order</a>
            </div>
        </article>

        <article class="delivery_item">
            <div>
            <p><?= "Name" ?></p>
            <p><?= "14.95€" ?></p>
            <a class="link_button" href="#">Take Order</a>
            </div>
        </article>

        <article class="delivery_item">
            <div>
            <p><?= "Name" ?></p>
            <p><?= "14.95€" ?></p>
            <a class="link_button" href="#">Take Order</a>
            </div>
        </article>

        <article class="delivery_item">
            <div>
            <p><?= "Name" ?></p>
            <p><?= "14.95€" ?></p>
            <a class="link_button" href="#">Take Order</a>
            </div>
        </article>

        <article class="delivery_item">
            <div>
            <p><?= "Name" ?></p>
            <p><?= "14.95€" ?></p>
            <a class="link_button" href="#">Take Order</a>
            </div>
        </article>

        <article class="delivery_item">
            <div>
            <p><?= "Name" ?></p>
            <p><?= "14.95€" ?></p>
            <a class="link_button" href="#">Take Order</a>
            </div>
        </article>
        
        <article class="delivery_item">
            <div>
            <p><?= "Name" ?></p>
            <p><?= "14.95€" ?></p>
            <a class="link_button" href="#">Take Order</a>
            </div>
        </article>

        <article class="delivery_item">
            <div>
            <p><?= "Name" ?></p>
            <p><?= "14.95€" ?></p>
            <a class="link_button" href="#">Take Order</a>
            </div>
        </article>

        <article class="delivery_item">
            <div>
            <p><?= "Name" ?></p>
            <p><?= "14.95€" ?></p>
            <a class="link_button" href="#">Take Order</a>
            </div>
        </article>

        <article class="delivery_item">
            <div>
            <p><?= "Name" ?></p>
            <p><?= "14.95€" ?></p>
            <a class="link_button" href="#">Take Order</a>
            </div>
        </article>


    </div>
</section>






<?php output_footer(); ?>