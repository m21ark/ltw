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

                <button class="form_button" formaction="../actions/action_login.php" formmethod="post">Login</button>
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
                    <button class="form_button" formaction="../actions/action_register.php" formmethod="post">Register</button>
                </div>
                <input class="null_input">

            </form>
            <div class="form_alternative">
                <p><span class="bold">Already have an account?</span></p>
                <a class="form_button" href="login.php">Login</a>
            </div>
        </div>

    </section>

<?php } ?>

<?php function drawEditProfile(User $user)
{ ?>

    <?php $user = $user->permissions[0]; ?>

    <div id="user_info">
        <section class="container">

            <form class="edit_profile" action="../actions/action_edit_user.php" method="post" enctype="multipart/form-data">
                <h2>Edit Profile</h2>

                <div>
                    <label>
                        Username <input class="custom_input" type="text" placeholder="Username" name="username" required value="<?= htmlentities($user->username)  ?>">
                    </label>
                    <label>
                        Email <input class="custom_input" type="email" placeholder="Email" name="email" required value="<?= htmlentities($user->email)  ?>">
                    </label>
                    <label>
                        Address <input class="custom_input" type="text" placeholder="Address" name="address" required value="<?= htmlentities($user->address)  ?>">
                    </label>

                    <label>
                        Phone Number <input class="custom_input" type="text" placeholder="Phone Number" name="phone" required value="<?= htmlentities($user->phone)  ?>">
                    </label>
                    <label>
                        Password <input class="custom_input" type="password" placeholder="Password" name="new_password" required>
                    </label>

                    <label for="image">Profile Image</label>
                    <input class="custom_input" type="file" name="image" accept="image/png,image/jpeg">

                </div>

                <div id="edit_profile_options">
                    <input class="link_button" type="submit" value="Apply Changes">
                    <a class="link_button" href="../actions/action_delete_user.php">Delete Account</a>
                </div>
            </form>


    </div>
    </section>


<?php } ?>



<?php function drawCartList(PDO $db, array $cart)
{

    require_once(__DIR__ . "/../database/restaurant.class.php"); ?>

    <form id="cart_list" method="post" action="../actions/action_add_order.php">
        <h2>Cart List</h2>

        <?php for ($i = 0; $i < sizeof($cart); $i++) {

            $dishID = $cart[$i][0];
            $dishQnt = $cart[$i][1];

            $dish = Dish::getDish($db, $dishID);
        ?>

            <div class="container">
                <a href="plate.php?id=<?= urlencode($dishID) ?>" class="container_name"><?= urlencode($dish->name) ?></a>
                <img src=<?= "../docs/food/" . urlencode($dishID) . ".jpg" ?> alt=<?= $dish->name ?>>
                <p class="container_price"><?= htmlentities($dish->price) ?>$</p>

                <div class="cart_qnt_arrows">
                    <span class="input-number-decrement" data-id="<?= htmlentities($dishID) ?>">-</span>
                    <input class="input-number" readonly type="text" value="<?= htmlentities($dishQnt) ?>" min="0" max="20">
                    <span class="input-number-increment" data-id="<?= htmlentities($dishID) ?>">+</span>
                </div>

                <button type="text" formaction="" formmethod="POST" name="id" value=<?= htmlentities($dishID) ?>>
                    <p class="container_delete">&#128465;</p>
                </button>

            </div>

        <?php } ?>

        <input type="submit" class="form_button" value="Buy for 0,0 $">
    </form>

<?php } ?>


<?php require_once(__DIR__ . "/../database/Users/user_composite.class.php");
function drawUserInfoPage(UserComposite $user)
{  ?>
    <div id="user_info">
        <section class="container">
            <h2>User</h2>
            <div id="info_display">
                <img id="user_photo" src="../docs/users/<?= urlencode($user->permissions[0]->id) ?>.jpg" width="200" height="200" alt="logo">
                <h3><?= htmlentities($user->permissions[0]->username) ?></h3>
                <p><span class="bold">Username:</span> <?= htmlentities($user->permissions[0]->username) ?></p>
                <p><span class="bold">Adress:</span> <?= htmlentities($user->permissions[0]->address) ?></p>
                <p><span class="bold">Email:</span> <?= htmlentities($user->permissions[0]->email) ?></p>

                <?php if ($user->hasPermission("Customer") !== null) { ?>
                    <p><a href="perfil_info.php?type=fav"><span class="bold">Favorites &star; </span></a></p>
                    <p><a href="orders.php"><span class="bold">My Orders</span></a></p>
                <?php } else { ?>
                    <p><a href=""><span class="bold becomeCustomer" data-id=<?= htmlentities($user->permissions[0]->id) ?>>Become a Customer</span></a></p>
                <?php } ?>
                <?php if ($user->hasPermission("Courier") !== null) { ?>
                    <p><a href="control_center.php?cid=<?= htmlentities($user->permissions[0]->id) ?>"><span class="bold">My deliveries </span></a></p>
                <?php } ?>
                <?php if ($user->hasPermission("RestaurantOwner") !== null) { ?>
                    <p><a href="perfil_info.php?type=res"><span class="bold">Restaurant owner Page &#9749;</span></a></p>
                <?php } ?>
                <p><a href="edit_restaurant.php?id=0"><span class="bold">Add your Restaurant &#9749;</span></a></p>
            </div>
            <a href="edit_profile.php?<?= urlencode($user->permissions[0]->id) ?>" id="edit_account">Edit account details</a>
            <a href="../../actions/action_logout.php" id="logout">Logout &times;</a>
        </section>
    </div>


<?php } ?>


<?php function drawMakeReview()
{ ?>

    <section id="review">
        <div class="container sign_form">
            <form action="../../actions/action_make_review.php" method="post" enctype="multipart/form-data">
                <h2>Review</h2>
                <label>
                    Write your review <textarea name="review" style="resize: none;" cols="30" rows="16" required></textarea>
                </label>

                <label for="image">Review Image</label>
                <input class="custom_input" type="file" name="image" accept="image/png,image/jpeg" required>


                <label>Score </label>
                <input type="hidden" id="id" name="id" value="<?= htmlentities($_GET["id"]) ?>">
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
                    <input type="submit" class="link_button" value="Publish"></button>
                    <a href="restaurant.php?id=<?= urlencode($_GET["id"]) ?>">Go back</a>
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



<?php function drawOrderList($db, $orders)
{ ?>

    <a class="link_button" id="goback_delivery" href="user.php"> Go back</a>
    <h2 class="orders_list_title">Orders List</h2>
    <div id="orders_list">
        <?php foreach ($orders as $order) { ?>

            <div class="container">

                <h2> <?= htmlentities($order->id) ?> </h2>
                <h3><?= htmlentities($order->getRestaurantName($db)) ?></h3>

                <div>
                    <?php $dishC = -1;
                    foreach ($order->getOrderDishes($db) as $dish) {

                        $dishC = Dish::getDish($db, $dish['DishID']);
                    ?>

                        <p class="kanban_bolder">Plate: <?= htmlentities($dishC->name) ?></p>
                        <p class="kanban_bolder">Qnt: <?= htmlentities($dish['Qnt']) ?></p>
                        <div></div>
                    <?php } ?>
                </div>

                <h3><?= htmlentities(OrderStatus::status[$order->order_state]) ?></h3>

                <?php if ($order->order_state < 6) { ?>
                    <a href="../actions/action_cancel_order.php?oid=<?= urlencode($order->id) ?>">
                        <p class="container_delete">&#128465;</p>
                    </a>
                <?php } ?>

                <?php if ($order->order_state === 5) { ?>
                    <div id=<?= $order->id ?> class="map"></div>
                    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBzgJqREIIsXex1RCkEXXiJyA2odtCX394&callback=initMap">
                    </script>
                <?php } ?>
            </div>

        <?php } ?>
    </div>



<?php } ?>