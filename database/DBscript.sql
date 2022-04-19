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
	Address VARCHAR NOT NULL,
	Category VARCHAR );
	
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
	
CREATE TABLE "Order" ( -- FALTAVA O RESTAURANTE
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
	
CREATE TABLE Review ( --- FALTA LIGAR COM O RESTAURANTE
	ReviewID INTEGER PRIMARY KEY,
	Score INTEGER,
	ReviewComment VARCHAR NOT NULL,
	DateOfReview INTEGER NOT NULL,  --- insert the date in epoch format
	RestaurantID INTEGER NOT NULL,
	FOREIGN KEY (RestaurantID) REFERENCES Restaurant(RestaurantID)
);
	
CREATE TABLE Photo ( --- Não será assim o formato (com URL) deverá ser um BLOB
	PhotoID Dishes PRIMARY KEY,
	URL VARCHAR NOT NULL);
	
CREATE TABLE Owner ( --- Faltava LIGAR COM RESTAURANTE e Ligar com User
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
	
CREATE TABLE User ( --- adicionar foto
	UserId INTEGER PRIMARY KEY,
	username VARCHAR,
	password VARCHAR,
	Address VARCHAR,
	phoneNumer VARCHAR
)
	
