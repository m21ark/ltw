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
    <link rel="stylesheet" href="css/layout.css">
    <link rel="stylesheet" href="css/perfil_infos.css">
    <meta name="viewport" content="width=device-width, initial-scale=0.8, maximum-scale=5.0, minimum-scale=0.5">
</head>

<body>

    <header>
        <a href="index.html"><img src="docs/logo.jpg" width="50" height="50" alt="logo"></a>
        <h1 id="logo_name"><a href="index.html">Tasty Eats</a></h1>
        <span><a id="header_search" href="index.html">&#128270;</a></span>

        <div id="header_signup">
            <a class="link_button" href="register.html">Sign in</a>
            <a class="link_button" href="login.html">Login</a>
        </div>
    </header>


    <nav id="navbar">
        <input type="checkbox" id="hamburger">
        <label class="hamburger" for="hamburger"></label>

        <ul>
            <li><a href="index.html">Italian</a></li>
            <li><a href="index.html">Japanese</a></li>
            <li><a href="index.html">Indian</a></li>
            <li><a href="index.html">Portuguese</a></li>
            <li><a href="index.html">Vietnamese</a></li>
            <li><a href="index.html">Vegan</a></li>
        </ul>
    </nav>

    <main>

        <form id="favorite_cards">

            <h2>Favorites</h2>
            
            <?php 
                require_once("templates/plates_carrossel.tpt.php");
                require_once("templates/restaurants_carrossel.tpt.php");
                require_once("database/restaurant.class.php");
                require_once("database/connection.php");

                $db = getDatabaseConnection();
                // TODO
                $dishes = Dish::getRandomDishes($db, 5);
                $restaurants = Restaurant::getRandomRestaurants($db, 5);
                drawPlatesCarrossel($dishes, false);
                drawRestaurantsCarrossel($restaurants, false);
            
            ?>
        </form>



    </main>
    <footer>
        <p>Tasty Eats LTW 2021/22</p>
    </footer>
</body>

</html>