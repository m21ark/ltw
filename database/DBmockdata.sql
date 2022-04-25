-- podiam ser coordenadas e uma api externa dizia qual era a morada... pode ser util para o estafeta
INSERT INTO Restaurant VALUES (1, "Casa da Mãe Joana", "Rua da Porta Torta nº 62", "Sushi");
INSERT INTO Restaurant VALUES (2, "Restaurante Avenida", "Avenida da Luz nº 3", "Comida Portuguesa");
INSERT INTO Restaurant VALUES (3, "Bordoaria", "Rua da Catedral nº15", "Comida Portuguesa");
INSERT INTO Restaurant VALUES (4, "Canto do Ananás", "Avenida Central nº45", "Comida Italiana");
INSERT INTO Restaurant VALUES (5, "Rei dos Hamburguers", "Rua do Canto n6", "Hamburgaria");

INSERT INTO Dish VALUES (1, "Francesinha", "8.45", "Comida Portuguesa");
INSERT INTO Dish VALUES (2, "Rojões à Portuguesa", "7.60", "Comida Portuguesa");
INSERT INTO Dish VALUES (3, "Feijoada à moda do Porto", "8.20", "Comida Portuguesa");
--adivinhem quem é que não gosta de sushi
INSERT INTO Dish VALUES (4, "Disgusting Raw Fish #1", "-20", "Sushi");
INSERT INTO Dish VALUES (5, "Disgusting Raw Fish #2", "-20", "Sushi");
INSERT INTO Dish VALUES (6, "Disgusting Raw Fish #3", "-20", "Sushi");
--adivinhem quem é que não gosta de sushi
INSERT INTO Dish VALUES (7, "Pizza Hawaina", "6.7", "Comida Italiana");
INSERT INTO Dish VALUES (8, "Massa Carbonara", "7.6", "Comida Italiana");
INSERT INTO Dish VALUES (9, "Lasanha Vegetariana" , "-10", "Comida Italiana");
INSERT INTO Dish VALUES (10, "Cheeseburger", "5.5", "Hamburgaria");
INSERT INTO Dish VALUES (11, "Baconburger", "6", "Hamburgaria");
INSERT INTO Dish Values (12, "BurguerBurguer", "10", "Hamburgaria");

INSERT INTO OrderState VALUES (1, "Received");
INSERT INTO OrderState VALUES (2, "Preparing");
INSERT INTO OrderState VALUES (3, "Delivered");
INSERT INTO OrderState VALUES (4, "Ready");

-- all passwords are batata

--Nota ::: os emais são em Letra minúscula, pelo que os que não tem maisucla devem ser alterados
INSERT INTO "User" VALUES (1, "ASTRAZENECA@COVID.CN", "covid was an inside job", "8467b174e821587c4a0545fd8e57204a398c66d4", "nah im just kidding im bored making mock data is the most boring shit ever", "914442233");
INSERT INTO "User" VALUES (2, "1337gamer123@gaymingworld.com", "1337eater", "8467b174e821587c4a0545fd8e57204a398c66d4", "Rua da Quinta nº 4", "913325436");
INSERT INTO "User" VALUES (3, "amtrap@yahoo.com", "AnaMaria", "8467b174e821587c4a0545fd8e57204a398c66d4", "Avenida Central nº 6", "914531122");
INSERT INTO "User" VALUES (4, "jjmigue@gmail.com", "JotaJota", "8467b174e821587c4a0545fd8e57204a398c66d4!*", "Beco dos becos nº 5", "934531123");
INSERT INTO "User" VALUES (5, "imanalbatroz@burb.com", "ImABirdNotAPerson", "8467b174e821587c4a0545fd8e57204a398c66d4", "The Open Sea", "931124312");
INSERT INTO "User" VALUES (6, "analuiza123@iol.pt", "Ana", "8467b174e821587c4a0545fd8e57204a398c66d4", "Rua da Porta nº 54", "923421123");

-- Nota: aqui estava-se a por dois valores por alguma razão, qual ?
INSERT INTO Customer VALUES (1);
INSERT INTO Customer VALUES (2);
INSERT INTO Customer VALUES (3);
INSERT INTO Customer VALUES (4);
INSERT INTO Customer VALUES (5);

INSERT INTO "Order" VALUES (1, 2, 3, 4);
INSERT INTO "Order" VALUES (2, 4, 2, 3);
INSERT INTO "Order" VALUES (3, 1, 3, 5);
INSERT INTO "Order" VALUES (4, 2, 4, 5);
INSERT INTO "Order" VALUES (5, 3, 2, 1);

INSERT INTO Menu VALUES (1, 1);

-- NOTA : o score deve ser entre 0 e 5 como especificado no uml
INSERT INTO Review VALUES (1, "85", "Good food, great service", "2022-01-09", 1);
INSERT INTO Review VALUES (2, "75", "Had a great time", "2022-02-19", 2);
INSERT INTO Review VALUES (3, "65", "Not the best service, but the food was good", "2022-01-22", 3);
INSERT INTO Review VALUES (4, "25", "Food was cold and staff was rude", "2022-03-01", 4);
INSERT INTO Review VALUES (5, "93", "Best restaurant ever", "2022-02-10", 5);

-- NOTA: Os owners e os costumers são os mesmo (não há diversidade de hipóteses) ... a Ana luisa não está em nenhuma, não pode !!!
INSERT INTO Owner VALUES (1, 1);
INSERT INTO Owner VALUES (2, 2);
INSERT INTO Owner VALUES (3, 3);
INSERT INTO Owner VALUES (4, 4);
INSERT INTO Owner VALUES (5, 5);

INSERT INTO DishOrder VALUES (1, 1);
INSERT INTO DishOrder VALUES (2, 2);
INSERT INTO DishOrder VALUES (3, 3);
INSERT INTO DishOrder VALUES (4, 4);
INSERT INTO DishOrder VALUES (5, 5);

INSERT INTO CustomerFavoriteDishes VALUES (1, 1);
INSERT INTO CustomerFavoriteDishes VALUES (2, 2);
INSERT INTO CustomerFavoriteDishes VALUES (3, 3);
INSERT INTO CustomerFavoriteDishes VALUES (4, 4);
INSERT INTO CustomerFavoriteDishes VALUES (5, 5);
-- Nota : falta o de cima mas para restaurantes
-- Nota : também se podiam adicionar mais pratos favoritos ao costumers