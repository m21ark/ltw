<?php



function plate_description(Dish $dish)
{ ?>

    <div id="plate_description">

        <h2>Description</h2>
        <p>
            <?= htmlentities($dish->description) ?>
        </p>

        <div>
            <a href="#"><?= htmlentities($dish->category) ?></a>
        </div>

    </div>

<?php } ?>



<?php function drawPlateInfo(Dish $dish, $customer, array $ingredients, int $restaurantID, bool $isOwner)
{
    $db = getDatabaseConnection(); ?>

    <article id="plate_page" class="container">
        <h2>Plate page</h2>
        <?php if ($isOwner) { ?>
            <a href="edit_plate.php?pid=<?= urlencode($dish->id) ?>">
                <h3>(Edit Plate)</h3>
            </a>
        <?php } ?>
        <div id="plate_left">
            <h2><?= htmlentities($dish->name) ?></h2>
            <img src="../docs/food/<?= urlencode($dish->id) ?>.jpg" alt="">
            <p><?= htmlentities($dish->price) ?> €</p>
        </div>

        <div id="plate_right">
            <h2>Ingredients</h2>

            <div id="ingredients_list">
                <ul>
                    <?php for ($i = 0; $i < sizeof($ingredients); $i++) { ?>
                        <li><?= htmlentities($ingredients[$i]['IngredientName']) ?></li>
                    <?php } ?>
                </ul>
            </div>

        </div>

        <form action="../../actions/action_add_to_cart.php" method="post">
            <input type="hidden" id="id" name="id" value="<?= htmlentities($_GET["id"]) ?>">
            <input type="submit" class="link_button" value="Buy  &#x1f6d2;">
        </form>
        <?php if ($customer != null && in_array(array('DishID' => $dish->id), $customer->getFavoriteDishes($db))) { ?>
            <a class="link_button add_dish_to_favorites">Added ✔</a>
        <?php } else if ($customer != null) { ?>
            <a class="link_button add_dish_to_favorites">Add to favorites &star;</a>
        <?php } ?>

        <a href="restaurant.php?id=<?= htmlentities($restaurantID) ?>" id="plate_restaurant">
            <h2>See Restaurant</h2>
        </a>

        <?php plate_description($dish); ?>


    </article>


<?php } ?>



<?php function drawPlateEdit(?Dish $dish, ?array $ingredients,  int $restaurantID, bool $edit)
{ ?>
    <article id="plate_page" class="container" style="display: block;">
        <h2><?= $edit ? "Edit" : "Add" ?> Plate</h2>
        <form class="edit_form" action="../actions/<?= $edit ? 'action_edit_plate.php' : 'action_add_plate.php' ?>" method="post" enctype="multipart/form-data">


            <label for="p_name">Plate Name</label>
            <input class="custom_input" type="text" name="p_name" required value="<?= htmlentities($edit ? $dish->name : null) ?>">

            <label for="price">Price</label>
            <input class="custom_input" type="number" step=0.01 name="price" required value="<?= htmlentities($edit ? $dish->price : null) ?>">

            <label for="category">Category</label>
            <input class="custom_input" type="text" name="category" required value="<?= htmlentities($edit ? $dish->category : null) ?>">

            <label for="image">Plate Photo</label>
            <input class="custom_input" type="file" name="image" accept="image/png,image/jpeg,image/jpg" <?= htmlentities($edit ? null : 'required') ?>>

            <?php if ($edit) { ?>
                <img src="../docs/food/<?= urlencode($dish->id) ?>.jpg" alt="Plate Picture">
            <?php } ?>

            <label for="description">Description</label>
            <textarea name="description" required><?= htmlentities($edit ? $dish->description : null) ?></textarea>

            <label for="ingredients">Ingredients</label>
            <textarea name="ingredients" required><?php for ($i = 0; $i < sizeof($ingredients) - 1; $i++) {
                                                        echo htmlentities($ingredients[$i]['IngredientName']);
                                                        echo ",\n";
                                                    }
                                                    echo htmlentities($ingredients[sizeof($ingredients) - 1]['IngredientName']); ?></textarea>

            <input type="hidden" name="restID" value=<?= htmlentities($restaurantID) ?>>
            <input type="hidden" name="plateID" value=<?= htmlentities($dish->id) ?>>

            <input class="link_button" type="submit" value="Publish">

            <?php if ($edit) { ?>
                <a class="link_button" id="del_dish" href="../actions/action_delete_plate.php?pid=<?= urlencode($dish->id) ?>&rest_id=<?= urlencode($restaurantID) ?>">Delete</a>
            <?php } ?>

        </form>
    </article>
<?php } ?>