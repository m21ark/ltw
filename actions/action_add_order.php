<?php

declare(strict_types=1);

require_once(__DIR__ . "/../database/Users/user_composite.class.php");
require_once(__DIR__ . "/../database/connection.php");

// Restricts access to logged in users
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if (!$session->isLoggedIn()) {
    $session->addMessage('erro', 'Login required. Redirected to main page');
    die(header('Location: /'));
}

$db = getDatabaseConnection();

$user = unserialize($session->getUserSerialized());

$customer = $user->hasPermission('Customer');
if ($customer == null) {
    $session->addMessage('erro', 'You dont have customer permissions');
    die(header('Location: /'));
}

$cart = $customer->cart;


for ($i = 0; $i < sizeof($cart); $i++) {
    print_r($cart[$i]);
}

die();

// -----------------------------------------------------------------------------------

$stmt = $db->prepare("INSERT INTO 'Order' VALUES (NULL, ?,  ?, ?, ?, ?) ");
$stmt->execute(array('2022-06-20 10:00:00', 1, $customer->id, $_POST['RestaurantID'], 0));

$OrderID = $db->lastInsertId();

// -----------------------------------------------------------------------------------

$stmt = $db->prepare("INSERT INTO DishOrder  VALUES (?, ?) ");
$stmt->execute(array($_POST['DishID'], $OrderID));

// -----------------------------------------------------------------------------------

$customer->emptyCart();

die(header('Location: ' . $_SERVER['HTTP_REFERER']));


/*
                        Order

	OrderID INTEGER PRIMARY KEY,
	DateOrder datetime not null, -- '2007-01-01 10:00:00'
	OrderStateID INTEGER,
    
	CustomerID INTEGER,
	RestaurantID INTEGER,
	CourierID INTEGER,

	FOREIGN KEY (RestaurantID) REFERENCES Restaurant(RestaurantID),
	FOREIGN KEY (OrderStateID) REFERENCES OrderState(OrderStateID),
	FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID),
	FOREIGN KEY (CourierID) REFERENCES Courier(CourierID)



                     DishOrder

    DishID INTEGER,
	OrderID INTEGER, -- SE FIZERMOS ORDER DE 2 PRATOS IGUAIS - SERÁ QUE RESULTA? Parece que sim, mas confirmar ao povoar
	FOREIGN KEY (DishID) REFERENCES Dish(DishID),
	FOREIGN KEY (OrderID) REFERENCES "Order"(OrderID)
*/
