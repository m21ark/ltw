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

CREATE TABLE Restaurant ( 
	RestaurantID INTEGER PRIMARY KEY,
	Name VARCHAR NOT NULL,
	phone VARCHAR NOT NULL,
	Address VARCHAR NOT NULL,
	Category VARCHAR NOT NULL,
	Description VARCHAR NOT NULL);
	
CREATE TABLE Dish (
	DishID INTEGER PRIMARY KEY,
	Name VARCHAR NOT NULL,
	Price VARCHAR NOT NULL,
	Category VARCHAR);
	
CREATE TABLE OrderState (
	OrderStateID INTEGER PRIMARY KEY,
	StateName VARCHAR NOT NULL);
	
CREATE TABLE Customer (
	CustomerID INT PRIMARY KEY,
	FOREIGN KEY (CustomerID) REFERENCES User(CustomerID));
	
CREATE TABLE "Order" ( 
	OrderID INTEGER PRIMARY KEY,
	OrderStateID INTEGER,
	CustomerID INTEGER,
	RestaurantID INTEGER,
	FOREIGN KEY (RestaurantID) REFERENCES Restaurant(RestaurantID),
	FOREIGN KEY (OrderStateID) REFERENCES OrderState(OrderStateID),
	FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID));
	
CREATE TABLE Menu ( -- Não é só um dish --> assim já dará
	RestaurantID INTEGER,
	DishID INTEGER,
	FOREIGN KEY (RestaurantID) REFERENCES Restaurant(RestaurantID),
 	FOREIGN KEY (DishID) REFERENCES Dish(DishID),
	PRIMARY KEY (RestaurantID, DishID));
	
CREATE TABLE Review ( -- falta quem fez a review
	ReviewID INTEGER PRIMARY KEY,
	Score INTEGER,
	ReviewComment VARCHAR NOT NULL,
	DateOfReview INTEGER NOT NULL,  --- insert the date in epoch format
	RestaurantID INTEGER NOT NULL,
	FOREIGN KEY (RestaurantID) REFERENCES Restaurant(RestaurantID)
);
	
CREATE TABLE Photo ( 
	PhotoID INTEGER PRIMARY KEY,
	ImageB BLOB NOT NULL);
	
CREATE TABLE Owner ( 
	OwnerID INTEGER,
	RestaurantID INTEGER,
	FOREIGN KEY (RestaurantID) REFERENCES Restaurant(RestaurantID),
	FOREIGN KEY (OwnerID) REFERENCES User(OwnerID),
	PRIMARY KEY (OwnerID, RestaurantID)
	);
	
CREATE TABLE DishOrder ( --- SE FIZERMOS ORDER DE 2 PRATOS IGUAIS - SERÁ QUE RESULTA? Parece que sim, mas confirmar ao povoar
	DishID INTEGER,
	OrderID INTEGER,
	FOREIGN KEY (DishID) REFERENCES Dish(DishID),
	FOREIGN KEY (OrderID) REFERENCES "Order"(OrderID));
	
CREATE TABLE CustomerFavoriteDishes ( 
	CustomerID INTEGER,
	DishID INTEGER,
	FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID),
	FOREIGN KEY (DishID) REFERENCES Dish(DishID));
	
CREATE TABLE CustomerFavoriteRestaurants (
	CustomerID INTEGER,
	RestaurantID INTEGER, 
	FOREIGN KEY (RestaurantID) REFERENCES Restaurant(RestaurantID),
	FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID));
	
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
	
