<?php
require_once(__DIR__ . '/../database/Users/concrete_user_factory.class.php');
require_once(__DIR__ . '/../database/restaurant.class.php');
require_once(__DIR__ . '/../database/connection.php');
session_start();


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



function drawKanbanBoardOwner(PDO $db, int $res)
{
    $orders = getOrders($db);
?>
    <h1 class="kanbanH1">Control Board</h1>
    <div class="kanban">
        <?php
        kanban_col_owner($db, $orders, OrderStatus::received, $res);
        kanban_col_owner($db, $orders, OrderStatus::preparing, $res);
        kanban_col_owner($db, $orders, OrderStatus::ready, $res);
        ?>
    </div>

<?php }

function drawKanbanBoardCourier(PDO $db, int $cid)
{
    $orders = getOrders($db);
?>
    <h1 class="kanbanH1">Control Board</h1>
    <div class="kanban">
        <?php
        kanban_col_courier($db, $orders, OrderStatus::taken, $cid);
        kanban_col_courier($db, $orders, OrderStatus::delivering, $cid);
        kanban_col_courier($db, $orders, OrderStatus::delivered, $cid);
        ?>
    </div>

    <a class="link_button_courier" href="find_deliveries.php">Find Work</a>

<?php }



function kanban_col_owner($db, $orders, $OrderStatus, $rid)
{ ?>
    <div class="kanban__column" data-id=<?= $OrderStatus ?>>
        <div class="kanban__column-title"><?= OrderStatus::status[$OrderStatus] ?></div>
        <div class="kanban__items">
            <div class="kanban__dropzone"></div>
        </div>
        <?php foreach ($orders as $order) {
            if ($rid == $order->restaurant)
                if ($order->order_state === $OrderStatus) { ?>
                <div class="kanban__items">
                    <div class="kanban__item-input" draggable="true" data-id=<?= htmlentities("$order->id") ?>>
                        <h3>Order Nº: <?= $order->id ?></h3>
                        <?php foreach ($order->getOrderDishes($db) as $dish) { ?>
                            <p class="kanban_bolder">Plate: <?= htmlentities(Dish::getDish($db, $dish['DishID'])->name) ?></p>
                            <p class="kanban_bolder">Qnt: <?= htmlentities($dish['Qnt']) ?></p>
                            <div></div>
                        <?php } ?>
                        <a class="cancel_order link_button" href="../actions/action_cancel_order.php?oid=<?= $order->id ?>">Remove</a>
                    </div>
                </div>
        <?php }
        } ?>
    </div>
<?php }


function kanban_col_courier($db, $orders, $OrderStatus, $cid)
{ ?>
    <div class="kanban__column" data-id=<?= $OrderStatus ?>>
        <div class="kanban__column-title"><?= OrderStatus::status[$OrderStatus] ?></div>
        <div class="kanban__items">
            <div class="kanban__dropzone"></div>
        </div>
        <?php foreach ($orders as $order) {
            if (($order->courier === $cid) || ($cid == 0))
                if ($order->order_state === $OrderStatus) { ?>
                <div class="kanban__items">
                    <div class="kanban__item-input" draggable="true" data-id=<?= htmlentities("$order->id") ?>>

                        <h3>Order Nº: <?= $order->id ?></h3>
                        <?php $dishC = -1;
                        foreach ($order->getOrderDishes($db) as $dish) {

                            $dishC = Dish::getDish($db, $dish['DishID']);
                        ?>

                            <p class="kanban_bolder">Plate: <?= htmlentities($dishC->name) ?></p>
                            <p class="kanban_bolder">Qnt: <?= htmlentities($dish['Qnt']) ?></p>
                            <div></div>

                        <?php } ?>
                        <p>Restaurant: <?= $dishC->getRestaurantName($db) ?></p>
                        <p>Address: <?= $dishC->getRestaurantAddress($db) ?></p>
                        <div></div>
                        <h3>Delivery Address: <?= $order->getDeliveryAddress($db) ?></h3>
                        <?php if (OrderStatus::delivered !== $OrderStatus) { ?>
                            <a class="cancel_order link_button" href="../actions/action_cancel_delivery.php?oid=<?= $order->id ?>">Cancel</a>
                        <?php } ?>
                    </div>
                </div>
        <?php }
        } ?>
    </div>
<?php }
