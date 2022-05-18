<?php
require_once(__DIR__ . '/../database/Users/concrete_user_factory.class.php');
require_once(__DIR__ . '/../database/restaurant.class.php');
require_once(__DIR__ . '/../database/connection.php');
session_start();

function drawKanbanBoard(PDO $db, int $res)
{
    $orders = Restaurant::getRestaurantOrders($db, (int)$res);
?>
    <div class="kanban">
        <div class="kanban__column">
            <div class="kanban__column-title">Received</div>
            <?php foreach ($orders as $order) {
                if ($order->order_state === OrderStatus::received) { ?>
                    <div class="kanban__items">
                        <div class="kanban__item-input" draggable="true" data-id=<?= $order->id ?>>
                            <?php foreach ($order->getOrderDishes($db) as $dish) { ?>
                                <p>Plate: <?= Dish::getDish($db, $dish['DishID'])->name ?> Quantity: <?= $dish['Qnt'] ?></p>
                            <?php } ?>
                        </div>
                        <div class="kanban__dropzone"></div>
                    </div>
            <?php }
            } ?>
            <div class="kanban__items">
                <div class="kanban__dropzone"></div>
            </div>
        </div>
        <div class="kanban__column">
            <div class="kanban__column-title">Preparing</div>
            <?php foreach ($orders as $order) {
                if ($order->order_state === OrderStatus::preparing) { ?>
                    <div class="kanban__items">
                        <div class="kanban__item-input" draggable="true" data-id=<?= $order->id ?>>
                            <?php foreach ($order->getOrderDishes($db) as $dish) { ?>
                                <p>Plate: <?= Dish::getDish($db, $dish['DishID'])->name ?> Quantity: <?= $dish['Qnt'] ?></p>
                            <?php } ?>
                        </div>
                        <div class="kanban__dropzone"></div>
                    </div>
            <?php }
            }
            ?>
            <div class="kanban__items">
                <div class="kanban__dropzone"></div>
            </div>
        </div>
        <div class="kanban__column">
            <div class="kanban__column-title">Ready</div>
            <?php foreach ($orders as $order) {
                if ($order->order_state === OrderStatus::ready) { ?>
                    <div class="kanban__items">
                        <div class="kanban__item-input" draggable="true" data-id=<?= $order->id ?>>
                            <?php foreach ($order->getOrderDishes($db) as $dish) { ?>
                                <p>Plate: <?= Dish::getDish($db, $dish['DishID'])->name ?> Quantity: <?= $dish['Qnt'] ?></p>
                            <?php } ?>
                        </div>
                        <div class="kanban__dropzone"></div>
                    </div>

            <?php }
            }
            ?>
            <div class="kanban__items">
                <div class="kanban__dropzone"></div>
            </div>
        </div>
    </div>
<?php } ?>