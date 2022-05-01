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
                        Name <input type="text" placeholder="Name" name="name" required>
                    </label>
                    <label>
                        Email <input type="email" placeholder="Email" name="email" required>
                    </label>
                    <label>
                        Adress <input type="text" placeholder="Adress" name="adress" required>
                    </label>
                </div>

                <div class="right_login">
                    <label>
                        Username <input type="text" placeholder="Username" name="username" required>
                    </label>
                    <label>
                        Password <input type="password" placeholder="Password" name="password" required>
                    </label>
                    <button class="form_button" formaction="#" formmethod="post">Register</button>
                </div>
                <input style="visibility: hidden;margin:0;padding: 0;height: 0;">
            </form>
            <div class="form_alternative">
                <p><span class="bold">Already have an account?</span></p>
                <a class="form_button" href="login.php">Login</a>
            </div>
        </div>

    </section>

<?php } ?>


<?php function drawCartList()
{ ?>

    <form id="cart_list">
        <h2>Cart List</h2>

        <?php for ($i = 0; $i < 5; $i++) { ?>

            <div class="container">
                <a href="plate.php" class="container_name">Pizza de Atum</a>
                <img src="docs/pizza.jpg" alt="pizza">
                <p class="container_price">13,99$</p>

                <div class="cart_qnt_arrows">
                    <span class="input-number-decrement">-</span>
                    <input class="input-number" readonly type="text" value="1" min="0" max="10">
                    <span class="input-number-increment">+</span>
                </div>

                <p class="container_delete">&#128465;</p>
            </div>


        <?php } ?>

        <input type="submit" class="form_button" value="Buy for 28,54 $">
    </form>

<?php } ?>


<?php function plate_description()
{ ?>

    <a href="restaurant.php" id="plate_restaurant">
        <h2>See Restaurant</h2>
    </a>

    <div id="plate_description">
        <h2>Description</h2>
        <p>
            Lorem ipsum dolor sit amet, consectetur
            adipiscing elit, sed do eiusmod tempor
            incididunt ut labore et dolore magna aliqua. Ut
            enim ad minim veniam, quis nostrud
            exercitation ullamco laboris nisi ut aliquip ex ea
            commodo consequat.
        </p>

        <div>
            <a href="#">Italian</a>
            <a href="#">Spicy</a>
            <a href="#">Oven</a>
        </div>

    </div>


<?php } ?>



<?php function drawPlateInfo()
{ ?>

    <article id="plate_page" class="container">
        <h2>Plate page</h2>
        <div id="plate_left">
            <h2>Pizza de Atum</h2>
            <img src="docs/pizza.jpg" alt="">
            <p>13,99 $</p>
        </div>

        <div id="plate_right">
            <h2>Ingredients</h2>

            <div id="ingredients_list">
                <ul>
                    <li>Batata</li>
                    <li>Batata</li>
                    <li>Batata</li>
                    <li>Batata</li>


                </ul>
                <ul>
                    <li>Batata</li>
                    <li>Batata</li>
                    <li>Batata</li>
                    <li>Batata</li>
                </ul>
            </div>

            <form>
                <input type="submit" value="Buy  &#x1f6d2;">
            </form>
        </div>

        <?php plate_description(); ?>

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
                <?php } // TODO :: MAKE A BUTTON THAT SAYS :: BECOME A CUSTOMER, so this for the other option
                ?>
                <?php if ($user->hasPermission("RestaurantOwner") !== null) { ?>
                    <p><a href="perfil_info.php"><span class="bold">TODO: Restaurant owner Page &#9749;</span></a></p>
                <?php } ?>
            </div>
            <a href="register.php" id="edit_account">Edit account details</a>

        </section>
    </div>


<?php } ?>


<?php function drawMakeReview()
{ ?>

    <section id="review">
        <div class="container sign_form">
            <form>
                <h2>Review</h2>
                <label>
                    Write your review <textarea name="review" style="resize: none;" cols="30" rows="16"></textarea>
                </label>
                <label>Score </label>

                <div class="feedback">
                    <div id="star_rating">
                        <input type="radio" name="rating" id="rating-5">
                        <label for="rating-5"></label>
                        <input type="radio" name="rating" id="rating-4">
                        <label for="rating-4"></label>
                        <input type="radio" name="rating" id="rating-3" checked>
                        <label for="rating-3"></label>
                        <input type="radio" name="rating" id="rating-2">
                        <label for="rating-2"></label>
                        <input type="radio" name="rating" id="rating-1">
                        <label for="rating-1"></label>
                    </div>
                </div>

                <div id="review_options">
                    <button class="form_button" formaction="#" formmethod="post">Publish</button>
                    <a href="index.php">Go back</a>
                </div>
            </form>
        </div>
    </section>

<?php } ?>



<?php function drawUserFavCards($dishes, $restaurants)
{ ?>

    <form id="favorite_cards">
        <h2>Favorites</h2>
        <?php
        drawPlatesCarrossel($dishes, false);
        drawRestaurantsCarrossel($restaurants, false);
        ?>
    </form>

<?php } ?>