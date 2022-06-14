DROP TABLE IF EXISTS Restaurant;
DROP TABLE IF EXISTS Dish;
DROP TABLE IF EXISTS "Order";
DROP TABLE IF EXISTS OrderState;
DROP TABLE IF EXISTS Menu;
DROP TABLE IF EXISTS Review;
DROP TABLE IF EXISTS Photo;
DROP TABLE IF EXISTS Customer;
DROP TABLE IF EXISTS Owner;
DROP TABLE IF EXISTS DishOrder;
DROP TABLE IF EXISTS CustomerFavoriteDishes;
DROP TABLE IF EXISTS CustomerFavoriteRestaurants;
DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Courier;
DROP TABLE IF EXISTS DishIngredients;
DROP TABLE IF EXISTS Ingredient;
DROP TABLE IF EXISTS Response;
DROP TABLE IF EXISTS TakenDelivery;
DROP TABLE IF EXISTS "Notification";
DROP TABLE IF EXISTS OrderLocation;
DROP VIEW IF EXISTS Restaurant_Avg_Score;

CREATE TABLE Restaurant (
	RestaurantID INTEGER PRIMARY KEY,
	Name VARCHAR NOT NULL,
	phone VARCHAR NOT NULL,
	Address VARCHAR NOT NULL,
	Category VARCHAR NOT NULL,
	Description VARCHAR NOT NULL
);

CREATE TABLE Dish (
	DishID INTEGER PRIMARY KEY,
	Name VARCHAR NOT NULL,
	Price VARCHAR NOT NULL,
	Category VARCHAR,
	Description VARCHAR DEFAULT 'Sunt cumque exercitationem incidunt dolores vitae. Voluptatem voluptatum fugiat accusamus incidunt voluptas. Perferendis aperiam asperiores voluptas in error. Neque excepturi tempore non veritatis.'
);

CREATE TABLE OrderState (
	OrderStateID INTEGER PRIMARY KEY,
	StateName VARCHAR NOT NULL
);

CREATE TABLE Customer (
	CustomerID INT PRIMARY KEY,
	FOREIGN KEY (CustomerID) REFERENCES User(CustomerID)
);

CREATE TABLE "Order" (
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
);


CREATE TABLE Menu ( 
	RestaurantID INTEGER,
	DishID INTEGER,
	FOREIGN KEY (RestaurantID) REFERENCES Restaurant(RestaurantID),
 	FOREIGN KEY (DishID) REFERENCES Dish(DishID),
	PRIMARY KEY (RestaurantID, DishID)
);

CREATE TABLE Review (
	ReviewID INTEGER PRIMARY KEY,
	Score INTEGER,
	ReviewComment VARCHAR NOT NULL,
	DateOfReview INTEGER NOT NULL,
	RestaurantID INTEGER NOT NULL,
	CustomerID INTEGER NOT NULL,
	FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID),
	FOREIGN KEY (RestaurantID) REFERENCES Restaurant(RestaurantID)
);

CREATE TABLE Photo (
	PhotoID INTEGER PRIMARY KEY,
	ImageB BLOB NOT NULL
);

CREATE TABLE Owner (
	OwnerID INTEGER,
	RestaurantID INTEGER,
	FOREIGN KEY (RestaurantID) REFERENCES Restaurant(RestaurantID),
	FOREIGN KEY (OwnerID) REFERENCES User(OwnerID),
	PRIMARY KEY (OwnerID, RestaurantID)
);

CREATE TABLE DishOrder (
	DishID INTEGER,
	OrderID INTEGER,
	FOREIGN KEY (DishID) REFERENCES Dish(DishID),
	FOREIGN KEY (OrderID) REFERENCES "Order"(OrderID)
);

CREATE TABLE Ingredient(
	IngredientID INTEGER PRIMARY KEY,
	IngredientName VARCHAR NOT NULL
);

CREATE TABLE DishIngredients(
	DishID INTEGER,
	IngredientID INTEGER,
	FOREIGN KEY (DishID) REFERENCES Dish(DishID),
	FOREIGN KEY (IngredientID) REFERENCES Ingredient(IngredientID),
	PRIMARY KEY (DishID, IngredientID)
);

CREATE TABLE CustomerFavoriteDishes (
	CustomerID INTEGER,
	DishID INTEGER,
	FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID),
	FOREIGN KEY (DishID) REFERENCES Dish(DishID),
	PRIMARY KEY (CustomerID, DishID)
);

CREATE TABLE CustomerFavoriteRestaurants (
	CustomerID INTEGER,
	RestaurantID INTEGER,
	FOREIGN KEY (RestaurantID) REFERENCES Restaurant(RestaurantID),
	FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID),
	PRIMARY KEY (CustomerID, RestaurantID)
);

CREATE TABLE User (
	UserId INTEGER PRIMARY KEY,
	email VARCHAR UNIQUE,
	username VARCHAR,
	password VARCHAR,
	Address VARCHAR,
	phoneNumber VARCHAR,
	PhotoID INTEGER,
	FOREIGN KEY (PhotoID) REFERENCES Photo(PhotoID)
);

CREATE TABLE Courier (
	CourierID INTEGER PRIMARY KEY,
	FOREIGN KEY (CourierID) REFERENCES User(CourierID)
);


CREATE TABLE Response (
	ReviewID INTEGER PRIMARY KEY,
	ResponseComment VARCHAR,
	FOREIGN KEY (ReviewID) REFERENCES Review(ReviewID)
);


CREATE TABLE "Notification" (
	id INTEGER PRIMARY KEY,
	UserId INTEGER, -- temporarly removed the primary key
	OrderStateID INTEGER,
	FOREIGN KEY (UserId) REFERENCES User(UserId),
	FOREIGN KEY (OrderStateID) REFERENCES OrderState(OrderStateID)
);

CREATE TABLE OrderLocation (
	OrderID INTEGER PRIMARY KEY,
	lat INTEGER,
	lon INTEGER,
	FOREIGN KEY (OrderID) REFERENCES "Order"(OrderID)
);

DROP TRIGGER IF EXISTS add_notification;
CREATE TRIGGER add_notification
	BEFORE update ON "ORDER"
	when old.OrderStateID <> new.OrderStateID
BEGIN
	insert into "Notification"(id, UserId, OrderStateID) Values (NULL, NEW.CustomerID, NEW.OrderStateID);
END;

DROP TRIGGER IF EXISTS update_location;
CREATE TRIGGER update_location
	BEFORE update ON "ORDER"
	when old.OrderStateID <> new.OrderStateID AND new.OrderStateID = 5
BEGIN
	insert or replace into OrderLocation(OrderID, lat, lon) Values (new.OrderID, NULL, NULL);
END;

CREATE VIEW Restaurant_Avg_Score AS 
SELECT *, AVG(Score) as avg_score
FROM Restaurant LEFT JOIN Review on (Restaurant.RestaurantID = Review.RestaurantID)
Group by Restaurant.RestaurantID
Order by avg_score DESC;

