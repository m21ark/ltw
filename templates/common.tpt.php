<?php
require_once(__DIR__ . '/../database/Users/concrete_user_factory.class.php');
require_once(__DIR__ . '/../utils/session.php');
require_once(__DIR__ . '/../database/connection.php');

$session = new Session();
if ($session->isLoggedIn())
    $user = unserialize($session->getUserSerialized());

function output_header()
{ ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Tasty Eats</title>
        <link rel="icon" type="image/x-icon" href="/docs/favicon.ico">

        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/responsive.css">
        <link rel="stylesheet" href="../css/cart.css">
        <link rel="stylesheet" href="../css/forms.css">
        <link rel="stylesheet" href="../css/plate.css">
        <link rel="stylesheet" href="../css/restaurant.css">
        <link rel="stylesheet" href="../css/user.css">
        <link rel="stylesheet" href="../css/perfil_infos.css">
        <link rel="stylesheet" href="../css/card_flip.css">
        <link rel="stylesheet" href="../css/deliveries.css">
        <link rel="stylesheet" href="../css/kanban_board.css">
        <link rel="stylesheet" href="../css/orders_list.css">

        <script src="../events/increment_decrement_order.js" defer></script>
        <script src="../events/toggle_favorites.js" defer></script>
        <script src="../events/kanban_board.js" defer></script>
        <script src="../events/Notification/notification_handler.js" defer></script>
        <script src="../events/respond_to_client.event.js" defer></script>
        <script src="../events/remove_notifications.event.js" defer></script>
        <script src="../events/remove_dish_from_cart.js" defer></script>
        <script src="../events/searchbox.event.js" defer></script>
        <script src="../events/become_user.js" defer></script>
        <script src="../events/carousel.js" defer></script>

        <meta name="viewport" content="width=device-width, initial-scale=0.8, maximum-scale=5.0, minimum-scale=0.5">
    </head>

    <body>

        <header>
            <a href="index.php"><img src="../docs/logo.png" width="50" height="50" alt="logo"></a>
            <h1 id="logo_name"><a href="index.php?#">Tasty Eats</a></h1>
            <span><a id="header_search" href="index.php">&#128270;</a></span>

            <?php if (!isset($_SESSION['user'])) { ?>
                <div id="header_signup">
                    <a class="link_button" href="register.php">Sign in</a>
                    <a class="link_button" href="login.php">Login</a>
                </div>
            <?php } else {
                $user = unserialize($_SESSION['user']);
            ?>
                <span><a id="header_cart" href="cart.php">&#x1f6d2;</a></span>
                <?php

                $user_pic_id = urlencode($user->permissions[0]->id);
                $user_pic = "../docs/users/$user_pic_id.jpg";

                if (!file_exists($user_pic))
                    $user_pic = "../docs/user.png";

                ?>
                <a id="header_avatar" href="user.php"><img src="<?= $user_pic ?>" alt="logo"></a>
                <span class="user_id" data-id=<?= htmlentities($user->permissions[0]->id) ?> hidden></span>
            <?php } ?>
        </header>


        <nav id="navbar">
            <input type="checkbox" id="hamburger">
            <label class="hamburger" for="hamburger"></label>

            <ul>
                <li><a href="index.php?#italian">Italian</a></li>
                <li><a href="index.php?#japanese">Japanese</a></li>
                <li><a href="index.php?#indian">Indian</a></li>
                <li><a href="index.php?#portuguese">Portuguese</a></li>
                <li><a href="index.php?#vietnamese">Vietnamese</a></li>
                <li><a href="index.php?#vegan">Vegan</a></li>
            </ul>
        </nav>



        <main>
            <section id="session_messages">
                <?php
                $session = new Session();
                foreach ($session->getMessages() as $messsage) { ?>
                    <article class="<?= htmlentities($messsage['type']) ?>">
                        <p><?= htmlentities($messsage['text']) ?></p>
                    </article>
                <?php } ?>
            </section>


        <?php } ?>


        <?php function output_footer()
        { ?>

        </main>

        <footer>
            <p>Tasty Eats LTW 2021/22</p>
        </footer>
    </body>

    </html>

<?php } ?>