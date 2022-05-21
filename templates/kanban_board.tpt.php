<?php
require_once(__DIR__ . '/../database/Users/concrete_user_factory.class.php');
require_once(__DIR__ . '/../database/restaurant.class.php');
require_once(__DIR__ . '/../database/connection.php');
session_start();

function drawKanbanBoardOwner(PDO $db, int $res)
{
    $orders = Restaurant::getRestaurantOrders($db, (int)$res);
?>
    <h1 class="kanbanH1">Control Board</h1>
    <div class="kanban">
        <?php
        kanban_col($db, $orders, OrderStatus::received);
        kanban_col($db, $orders, OrderStatus::preparing);
        kanban_col($db, $orders, OrderStatus::ready);
        ?>
    </div>

<?php }

function drawKanbanBoardCourier(PDO $db, int $res)
{
    $orders = Restaurant::getRestaurantOrders($db, (int)$res);
?>
    <h1 class="kanbanH1">Control Board</h1>
    <div class="kanban">
        <?php
        kanban_col($db, $orders, OrderStatus::ready);
        kanban_col($db, $orders, OrderStatus::delivering);
        kanban_col($db, $orders, OrderStatus::delivered);
        ?>
    </div>

    <a class="link_button_courier" href="find_deliveries.php">Find Work</a>

<?php }


function kanban_col($db, $orders, $OrderStatus)
{ ?>
    <div class="kanban__column" data-id=<?= $OrderStatus ?>>
        <div class="kanban__column-title"><?= OrderStatus::status[$OrderStatus] ?></div>
        <div class="kanban__items">
            <div class="kanban__dropzone"></div>
        </div>
        <?php foreach ($orders as $order) {
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
