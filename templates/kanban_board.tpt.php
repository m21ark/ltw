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
        kanban_col($db, $orders, OrderStatus::received, 0);
        kanban_col($db, $orders, OrderStatus::preparing, 0);
        kanban_col($db, $orders, OrderStatus::ready, 0);
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
        kanban_col($db, $orders, OrderStatus::taken, $cid);
        kanban_col($db, $orders, OrderStatus::delivering, $cid);
        kanban_col($db, $orders, OrderStatus::delivered, $cid);
        ?>
    </div>

    <a class="link_button_courier" href="find_deliveries.php">Find Work</a>

<?php }


function kanban_col($db, $orders, $OrderStatus, $cid)
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
                        <h4>Order Nº: <?= $order->id ?></h4>
                        <?php foreach ($order->getOrderDishes($db) as $dish) { ?>
                            <p>Plate: <?= htmlentities(Dish::getDish($db, $dish['DishID'])->name) ?></p>
                            <p>Qnt: <?= htmlentities($dish['Qnt']) ?></p>
                        <?php } ?>
                    </div>
                </div>
        <?php }
        } ?>
    </div>
<?php }
