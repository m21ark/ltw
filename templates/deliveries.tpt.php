<?php function draw_deliveries(PDO $db, Session $session)
{
    draw_deliverTaken();
    draw_deliveryOptions($session, $db, getOrders($db));
} ?>



<?php

function getRestaurantIDS(PDO $db): array
{
    $stmt = $db->prepare('SELECT RestaurantID FROM Restaurant');
    $stmt->execute(array());
    return $stmt->fetchAll();
}


function getOrders(PDO $db): array
{

    $restIDS = getRestaurantIDS($db);

    $orders = array();

    foreach ($restIDS as $res) {
        $aux = Restaurant::getRestaurantOrders($db, (int)$res['RestaurantID']);
        $orders = array_merge($orders, $aux);
    }
    return $orders;
}

?>

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



<?php function draw_deliveryOptions($session, $db, $orders)
{
?>
    <a class="link_button" id="goback_delivery" href="control_center.php?cid=<?= $session->getId() ?>"> Go back</a>
    <section id="delivery_container" class="container">
        <h2>Orders waiting delivery</h2>

        <div class=delivery_list>

            <?php

            foreach ($orders as $order)
                if ($order->order_state === OrderStatus::ready) { ?>

                <article class="delivery_item">

                    <h3>Order Nº: <?= $order->id ?></h3>
                    <?php foreach ($order->getOrderDishes($db) as $dish) { ?>
                        <p>Plate: <?= htmlentities(Dish::getDish($db, $dish['DishID'])->name) ?></p>
                        <p>Qnt: <?= htmlentities($dish['Qnt']) ?></p>
                        <div>
                            <p>Restaurante: XXXX</p>
                            <p>Adress: XXXX</p>
                        </div>
                    <?php } ?>
                    <h3>Total Price: 29,99$</h3>
                    <h3>Delivery Adress: Rua Belo Monte</h3>
                    <a class="link_button" href="../actions/action_take_delivery.php?cid=<?= $session->getId() ?>&oid=<?= $order->id ?>">Take Order</a>
                </article>

            <?php } ?>



        </div>


    </section>

<?php } ?>