<?php
require_once(__DIR__ . '/../database/Users/concrete_user_factory.class.php');

session_start();

function output_header()
{ ?>

    <!DOCTYPE html> <!-- Comment -->
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Tasty Eats</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/responsive.css">
        <link rel="stylesheet" href="css/cart.css">
        <link rel="stylesheet" href="css/forms.css">
        <link rel="stylesheet" href="css/plate.css">
        <link rel="stylesheet" href="css/restaurant.css">
        <link rel="stylesheet" href="css/user.css">
        <link rel="stylesheet" href="css/perfil_infos.css">
        <link rel="stylesheet" href="css/card_flip.css">
        <script src="events/increment_decrement_order.js" defer></script>
        <script src="events/toggle_favorites.js" defer></script>
        <script src="events/Notification/notification_handler.js" defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=0.8, maximum-scale=5.0, minimum-scale=0.5">
    </head>

    <body>

        <header>
            <a href="index.php"><img src="docs/logo.jpg" width="50" height="50" alt="logo"></a>
            <h1 id="logo_name"><a href="index.php">Tasty Eats</a></h1>
            <span><a id="header_search" href="index.php">&#128270;</a></span>

            <?php if (!isset($_SESSION['user'])) { ?>
                <div id="header_signup">
                    <a class="link_button" href="register.php">Sign in</a>
                    <a class="link_button" href="login.php">Login</a>
                </div>
            <?php } else {
                $user = unserialize($_SESSION['user']); // TODO ::: THE LOGO MUST CORRESPOND TO THE SESSION
            ?>
                <span><a id="header_cart" href="cart.php">&#x1f6d2;</a></span>
                <a id="header_avatar" href="user.php"><img src="docs/user.png" alt="logo"></a>
            <?php } ?>
        </header>


        <nav id="navbar">
            <input type="checkbox" id="hamburger">
            <label class="hamburger" for="hamburger"></label>

            <ul>
                <li><a href="index.php">Italian</a></li>
                <li><a href="index.php">Japanese</a></li>
                <li><a href="index.php">Indian</a></li>
                <li><a href="index.php">Portuguese</a></li>
                <li><a href="index.php">Vietnamese</a></li>
                <li><a href="index.php">Vegan</a></li>
            </ul>
        </nav>



        <main>

        <?php } ?>


        <?php

        function output_footer()
        { ?>

        </main>

        <footer>
            <p>Tasty Eats LTW 2021/22</p>
        </footer>
    </body>

    </html>

<?php } ?>




<?php function drawLogin()
{ ?>


    <section id="login">
        <div class="container sign_form">
            <form>
                <h2>Login</h2>
                <label>
                    Email <input type="text" required placeholder="Email" name="email">
                </label>
                <label>
                    Password <input type="password" required placeholder="Password" name="password">
                </label>

                <?php if (isset($_GET["error"])) {
                    echo "  <h4>
                        Username and password dont match!
                    </h4>";
                }
                ?>

                <button class="form_button" formaction="actions/action_login.php" formmethod="post">Login</button>
            </form>
            <div class="form_alternative">
                <p><span class="bold">Don't have an account?</span></p>
                <a class="form_button" href="register.php">Register</a>
            </div>
        </div>
    </section>

<?php } ?>


<?php function drawRegister()
{ ?>

    <section id="register">
        <div class="container sign_form">
            <form>
                <h2>Register</h2>

                <div class="left_login">
                    <label>
                        <!--- TODO: URGENTE ... Não temos nome na base de dados, metemos ?--->
                        Username <input type="text" placeholder="Username" name="username" required>
                    </label>
                    <label>
                        Email <input type="email" placeholder="Email" name="email" required>
                    </label>
                    <label>
                        Address <input type="text" placeholder="Address" name="address" required>
                    </label>
                </div>

                <div class="right_login">
                    <label>
                        Phone Number <input type="text" placeholder="Phone Number" name="phone" required>
                    </label>
                    <label>
                        Password <input type="password" placeholder="Password" name="password" required>
                    </label>
                    <button class="form_button" formaction="actions/action_register.php" formmethod="post">Register</button>
                </div>
                <input style="visibility: hidden;margin:0;padding: 0;height: 0;">
                <!--- STYLE Não pode estar aqui--->
            </form>
            <div class="form_alternative">
                <p><span class="bold">Already have an account?</span></p>
                <a class="form_button" href="login.php">Login</a>
            </div>
        </div>

    </section>

<?php } ?>


<?php function drawCartList(PDO $db, array $cart)
{
    require_once(__DIR__ . "/../database/restaurant.class.php"); ?>

    <form id="cart_list" method="post">
        <h2>Cart List</h2>

        <?php foreach ($cart as $dishID) {
            $dish = Dish::getDish($db, $dishID);
        ?>

            <div class="container">
                <a href="plate.php?id=<?= $dishID ?>" class="container_name"><?= $dish->name ?></a>
                <img src=<?= "docs/food/" . $dishID . ".jpg" ?> alt=<?= $dish->name ?>>
                <p class="container_price"><?= $dish->price ?>$</p>

                <div class="cart_qnt_arrows">
                    <span class="input-number-decrement">-</span>
                    <input class="input-number" readonly type="text" value="1" min="0" max="10">
                    <span class="input-number-increment">+</span>
                </div>

                <button type="text" formaction="actions/action_remove_from_cart.php" formmethod="POST" name="id" value=<?= $dishID ?>>
                    <p class="container_delete">&#128465;</p>
                </button>

            </div>

        <?php } ?>

        <input type="submit" class="form_button" value="Buy for 0,0 $">
    </form>

<?php } ?>


<?php function plate_description(Dish $dish)
{ ?>

    <div id="plate_description">

        <h2>Description</h2>
        <p>
            <?= $dish->description ?>
        </p>

        <div>
            <a href="#"><?= $dish->category ?></a>
        </div>


    </div>

    <!-- TEMPORARY! SHOULD ONLY BE SEEN BY REST OWNER -->
    <a class="link_button" href="edit_plate.php?pid=<?= $dish->id ?>">EDIT</a>

<?php } ?>



<?php function drawPlateInfo(Dish $dish, array $ingredients,  int $restaurantID)
{ ?>

    <article id="plate_page" class="container">
        <h2>Plate page</h2>

        <div id="plate_left">
            <h2><?= $dish->name ?></h2>
            <img src="docs/food/<?= $dish->id ?>.jpg" alt="">
            <p><?= $dish->price ?> €</p>
        </div>

        <div id="plate_right">
            <h2>Ingredients</h2>

            <div id="ingredients_list">
                <ul>
                    <?php for ($i = 0; $i < 8; $i++) { ?>
                        <li><?= $ingredients[$i]['IngredientName'] ?></li>
                    <?php } ?>
                </ul>
            </div>

        </div>

        <form action="../actions/action_add_to_cart.php" method="post">
            <input type="hidden" id="id" name="id" value="<?= $_GET["id"] ?>">
            <input type="submit" class="link_button" value="Buy  &#x1f6d2;">
        </form>


        <a href="restaurant.php?id=<?= $restaurantID ?>" id="plate_restaurant">
            <h2>See Restaurant (<?= $restaurantID ?>)</h2>
        </a>

        <?php plate_description($dish); ?>


    </article>


<?php } ?>




<?php function drawPlateEdit(?Dish $dish, ?array $ingredients,  int $restaurantID, bool $edit)
{ ?>
    <article id="plate_page" class="container" style="display: block;">
        <h2>Edit Plate</h2>
        <form action="actions/<?= $edit ? 'action_edit_plate.php' : 'action_add_plate.php' ?>" method="post" enctype="multipart/form-data" style="display: flex;width:60%; flex-direction:column">


            <label for="p_name">Plate Name</label>
            <input type="text" name="p_name" required value="<?= $edit ? $dish->name : null ?>">

            <label for="price">Price</label>
            <input type="number" step=0.01 name="price" required value="<?= $edit ? $dish->price : null ?>">

            <label for="category">Category</label>
            <input type="text" name="category" required value="<?= $edit ? $dish->category : null ?>">

            <label for="image">Uploud Plate Photo</label>
            <input type="file" name="image" accept="image/png,image/jpeg" <?= $edit ? null : 'required' ?>>

            <?php if ($edit) { ?>
                <img src="docs/food/<?= $dish->id ?>.jpg" alt="Plate Picture">
            <?php } ?>

            <label for="description">Description</label>
            <textarea name="description" required><?= $edit ? $dish->description : null ?></textarea>

            <label for="ingredients">Ingredients</label>
            <textarea name="ingredients" required><?php foreach ($ingredients as $ing) {
                                                        echo $ing['IngredientName'];
                                                        echo "\n";
                                                    } ?></textarea>

            <input type="hidden" name="restID" value=<?= $restaurantID ?>>

            <input class="link_button" type="submit" value="Publish">


        </form>
    </article>
<?php } ?>





<?php require_once(__DIR__ . "/../database/Users/user_composite.class.php");
function drawUserInfoPage(UserComposite $user)
{  ?>
    <div id="user_info">
        <section class="container">
            <h2>User</h2>
            <div id="info_display">
                <img id="user_photo" src="docs/user.png" width="200" height="200" alt="logo">
                <h3><?= $user->permissions[0]->username ?></h3>
                <p><span class="bold">Username:</span> <?= $user->permissions[0]->username ?></p>
                <p><span class="bold">Adress:</span> <?= $user->permissions[0]->address ?></p>
                <p><span class="bold">Email:</span> <?= $user->permissions[0]->email ?></p>

                <?php if ($user->hasPermission("Customer") !== null) { ?>
                    <p><a href="perfil_info.php"><span class="bold">Favorites &star;</span></a></p>
                <?php } else { ?>
                    <p><a href=""><span class="bold">Become a Costumer</span></a></p>
                <?php } ?>
                <?php if ($user->hasPermission("RestaurantOwner") !== null) { ?>
                    <p><a href="perfil_info.php"><span class="bold">TODO: Restaurant owner Page &#9749;</span></a></p>
                <?php } else { ?>
                    <p><a href=""><span class="bold">Add your Restaurant &#9749;</span></a></p>
                <?php } ?>
            </div>
            <a href="register.php" id="edit_account">Edit account details</a>
            <a href="../actions/action_logout.php" id="logout">Logout &times;</a>
        </section>
    </div>


<?php } ?>


<?php function drawMakeReview()
{ ?>

    <section id="review">
        <div class="container sign_form">
            <form action="../actions/action_make_review.php" method="post">
                <h2>Review</h2>
                <label>
                    Write your review <textarea name="review" style="resize: none;" cols="30" rows="16"></textarea>
                </label>
                <label>Score </label>
                <input type="hidden" id="id" name="id" value="<?= $_GET["id"] ?>">
                <div class="feedback">
                    <div id="star_rating">
                        <input type="radio" name="rating" id="rating-5" value="5">
                        <label for="rating-5"></label>
                        <input type="radio" name="rating" id="rating-4" value="4">
                        <label for="rating-4"></label>
                        <input type="radio" name="rating" id="rating-3" value="3" checked>
                        <label for="rating-3"></label>
                        <input type="radio" name="rating" id="rating-2" value="2">
                        <label for="rating-2"></label>
                        <input type="radio" name="rating" id="rating-1" value="1">
                        <label for="rating-1"></label>
                    </div>
                </div>

                <div id="review_options">
                    <button class="form_button">Publish</button>
                    <a href="index.php">Go back</a>
                </div>
            </form>
        </div>
    </section>

<?php } ?>



<?php function drawUserFavCards($dishes, $restaurants)
{
    require_once(__DIR__ . "/../database/connection.php");
    $db = getDatabaseConnection(); ?>

    <form id="favorite_cards">
        <h2>Favorites</h2>
        <?php
        drawPlatesCarrossel($dishes, false);
        drawRestaurantsCarrossel($db, $restaurants, false);
        ?>
    </form>

<?php } ?>