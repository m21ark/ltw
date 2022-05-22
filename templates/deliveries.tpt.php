<?php function draw_deliveries(PDO $db, Session $session)
{
    draw_deliverTaken();
    draw_deliveryOptions($session);
    getOrders($db);
} ?>





<?php

function getRestaurantIDS(PDO $db): array
{
    $stmt = $db->prepare('SELECT RestaurantID FROM Restaurant');
    $stmt->execute(array());
    return $stmt->fetchAll();
}


function getOrders(PDO $db)
{

    $restIDS = getRestaurantIDS($db);

    foreach ($restIDS as $res) {
        $orders = Restaurant::getRestaurantOrders($db, (int)$res['RestaurantID']);
        drawOrders($db, $orders);
    }
}

?>

<?php function drawOrders($db, $orders)
{

    foreach ($orders as $order) {
        if ($order->order_state === OrderStatus::ready) { ?>
            <div class="container" style="margin:2em">
                <div class="kanban__item-input" draggable="true" data-id=<?= htmlentities("$order->id") ?>>
                    <h4>Order Nº: <?= $order->id ?></h4>
                    <?php foreach ($order->getOrderDishes($db) as $dish) { ?>
                        <p>Plate: <?= htmlentities(Dish::getDish($db, $dish['DishID'])->name) ?></p>
                        <p>Qnt: <?= htmlentities($dish['Qnt']) ?></p>
                    <?php } ?>
                </div>
            </div>
<?php }
    }
} ?>



<?php function draw_deliverTaken()
{
?>

    <section id="delivery_container" class="container">
        <h2>Order being taking</h2>

        <div class="delivery_taken">
            <h3><?= "Name" ?></h3>
            <p><?= "14.95€" ?></p>
            <a class="link_button" href="#">Cancel Order</a>
        </div>
    </section>

<?php } ?>



<?php function draw_deliveryOptions(Session $session)
{
?>
    <a class="link_button" id="goback_delivery" href="control_center.php?cid=<?= $session->getId() ?>"> Go back</a>
    <section id="delivery_container" class="container">
        <h2>Orders waiting delivery</h2>
        <div>

            <?php for ($i = 0; $i < 10; $i++) { ?>

                <article class="delivery_item">
                    <div>
                        <p><?= "Name" ?></p>
                        <p><?= "14.95€" ?></p>
                        <a class="link_button" href="#">Take Order</a>
                    </div>
                </article>

            <?php } ?>

        </div>
    </section>

<?php } ?>