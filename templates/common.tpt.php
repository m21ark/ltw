
<?php 
require_once(__DIR__ . '/../database/Users/concrete_user_factory.class.php');

session_start();

function output_header(){?>

<!DOCTYPE html> 
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Spicy Restaurant</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header>
        <a href="index.html"><img src="docs/logo.jpg" width="50" height="50" alt="logo"></a>
        <h1 id="logo_name"><a href="index.html">Spicy Restaurant</a></h1>
        <span><a id="header_search" href="index.html">&#128270;</a></span>
        <?php if (!isset($_SESSION['user'])) {?>
            <a class="header_right" id="signup" href="login.html">Sign in</a>
        <?php } else {
            $user = unserialize($_SESSION['user']); // TODO ::: THE LOGO MUST CORRESPOND TO THE SESSION?>
            <span><a id="header_cart" href="cart.html">&#x1f6d2;</a></span>
            <a id="header_avatar" href="user.html"><img src="docs/user.png" alt="logo"></a>
        <?php } ?>
    </header>
    <main>

<?php }?>


<?php function output_footer(){?>

    </main>

    <footer>
        <p>Spicy Restaurant LTW 2021/22</p>
    </footer>
</body>

</html>

<?php }?>
