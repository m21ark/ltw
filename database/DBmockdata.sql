-- podiam ser coordenadas e uma api externa dizia qual era a morada... pode ser util para o estafeta
INSERT INTO Restaurant VALUES (1, "Ole Cafe Northfield", 4062181317, "9081 Sutherland Road", "Swedish", "Lorem ipsum dolor sit amet, consectetur adipiscing elit.");
INSERT INTO Restaurant VALUES (2, "The Old Spaghetti Factory", 1889390156, "82 Dawn Plaza", "Thai", "Fusce eros augue, mattis vitae convallis quis, porttitor et turpis.");
INSERT INTO Restaurant VALUES (3, "Cheeseburger in Paradise", 6718619852, "1 Merrick Center", "Burguer", "Phasellus hendrerit vel purus ut aliquam.");
INSERT INTO Restaurant VALUES (4, "Cold Stone Creamery", 3102975046, "2464 Hudson Street", "Italian", "Quisque vel mollis neque, ut varius enim.");
INSERT INTO Restaurant VALUES (6, "Chili's Grill & Bar", 2541854295, "33069 Doe Crossing Crossing", "Grill", "Cras viverra auctor nisi tristique laoreet.");
INSERT INTO Restaurant VALUES (7, "Claim Jumper Restaurants", 3549218898, "0800 Lawn Court", "French", "Nam nisi eros, congue sit amet ornare sed, ullamcorper non risus.");
INSERT INTO Restaurant VALUES (8, "Panera Bread", 6484169262, "00 Ridge Oak Court", "Burguer", "Phasellus porttitor pellentesque blandit.");
INSERT INTO Restaurant VALUES (9, "Captain D's", 9395392890, "58 Dunning Place", "Chinese", "Etiam bibendum metus nec sem dignissim porta.");
INSERT INTO Restaurant VALUES (10, "Noodles & Company", 2382648926, "6 Kenwood Lane", "Chinese", "Mauris vel ipsum accumsan, malesuada arcu in, consequat augue.");
INSERT INTO Restaurant VALUES (11, "On the Border Mexican Grill & Cantina", 4172484735, "03 Oriole Crossing", "Grill", "Aliquam laoreet sollicitudin suscipit.");
INSERT INTO Restaurant VALUES (12, "Cheddar's Casual Cafe", 5732502059, "65113 Almo Point", "Burguer", "Sed quis feugiat turpis.");
INSERT INTO Restaurant VALUES (13, "Wild Wing Cafe", 3155257315, "6271 Bonner Road", "Mexican", "Maecenas at enim ligula.");
INSERT INTO Restaurant VALUES (14, "Charley's Grilled Subs", 3436567121, "0 Moland Alley", "Grill", "Integer purus lectus, accumsan eget ultrices quis, rhoncus in lectus.");
INSERT INTO Restaurant VALUES (15, "Shake Shack", 8863001388, "	8889 Clarendon Court", "Italian", "Vestibulum sagittis diam vel diam porta ultrices.");


INSERT INTO Dish VALUES (1, "Bacon and lamb burgers", "8.45", "Burguer");
INSERT INTO Dish VALUES (2, "Barley and squash risotto", "7.60", "Swedish");
INSERT INTO Dish VALUES (3, "Milk chocolate and honey biscuits", "8.20", "Thai");
INSERT INTO Dish VALUES (4, "Pesto and chicken spaghetti", "6.70", "Italian");
INSERT INTO Dish VALUES (5, "Cardamom and semolina cake", "7.80", "Grill");
INSERT INTO Dish VALUES (6, "Sausage and pesto penne", "5.96", "Italian");
INSERT INTO Dish VALUES (7, "Duck and gorgonzola salad", "6.7", "Chinese");
INSERT INTO Dish VALUES (8, "Jalapeno and grapefruit ciabatta", "7.6", "Mexican");
INSERT INTO Dish VALUES (9, "Salmon and ricotta wontons" , "5.34", "French");
INSERT INTO Dish VALUES (10, "Crayfish and lavender salad", "5.5", "French");
INSERT INTO Dish VALUES (11, "Kalonji and vinegar salad", "6.24", "Chinese");
INSERT INTO Dish Values (12, "Fish and grouse ciabatta", "10", "Mexican");
INSERT INTO Dish VALUES (13, "Venison and coriander korma", "8.65", "Thai");
INSERT INTO Dish VALUES (14, "Chilli and apricot loaf", "5.45", "Mexican");
INSERT INTO Dish VALUES (15, "Bacon and lamb burgers", "8.45", "Burguer");
INSERT INTO Dish VALUES (16, "Steak and sweetcorn pudding", "7.98", "Burguer");
INSERT INTO Dish VALUES (17, "Basil and cheese bread", "2.45", "Burguer");
INSERT INTO Dish VALUES (18, "Navratan and monkfish salad", "4.55", "Chinese");
INSERT INTO Dish VALUES (19, "Broccoli and stilton salad", "2.45", "Burguer");
INSERT INTO Dish VALUES (20, "Thyme and kohlrabi soup", "8.45", "Chinese");
INSERT INTO Dish VALUES (21, "Cornmeal and sausage salad", "2.45", "Grill");
INSERT INTO Dish VALUES (22, "Pheasant and fish stew", "5.66", "Swedish");
INSERT INTO Dish VALUES (23, "Peppercorn and fennel salad", "8.22", "French");
INSERT INTO Dish VALUES (24, "Prune and pumpkin cookies", "6.66", "Thai");
INSERT INTO Dish VALUES (25, "Milk chocolate and lemon cheesecake", "11.45", "Burguer");


INSERT INTO OrderState VALUES (1, "Received");
INSERT INTO OrderState VALUES (2, "Preparing");
INSERT INTO OrderState VALUES (3, "Delivered");
INSERT INTO OrderState VALUES (4, "Ready");

-- all passwords are batata
INSERT INTO "User" VALUES (1, "user@gmail.com", "mbean0", "8467b174e821587c4a0545fd8e57204a398c66d4", "6 Kim Road", "6976825671", 1);
INSERT INTO "User" VALUES (2, "cgolborn1@arstechnica.com", "bmcgill1", "8467b174e821587c4a0545fd8e57204a398c66d4", "1 Talisman Center", "5531077427", 2);
INSERT INTO "User" VALUES (3, "nsuddock2@edublogs.org", "llampkin2", "8467b174e821587c4a0545fd8e57204a398c66d4", "05928 Pine View Crossing", "3189560591", 4);
INSERT INTO "User" VALUES (4, "eshalliker3@sitemeter.com", "dlaidel3", "8467b174e821587c4a0545fd8e57204a398c66d4", "40576 Portage Alley", "9762677183", 3);
INSERT INTO "User" VALUES (5, "gbrandt4@nature.com", "svanderbaaren4", "8467b174e821587c4a0545fd8e57204a398c66d4", "25377 Debra Junction", "3703743271", 5);
INSERT INTO "User" VALUES (6, "drudkin5@china.com.cn", "fmilton5", "8467b174e821587c4a0545fd8e57204a398c66d4", "44587 Sunbrook Road", "9985967728",6);
INSERT INTO "User" VALUES (7, "opattlel6@jigsy.com", "esoaper6", "8467b174e821587c4a0545fd8e57204a398c66d4", "93 Roth Junction", "9105645396",7);
INSERT INTO "User" VALUES (8, "epiggen7@cyberchimps.com", "gantonovic7", "8467b174e821587c4a0545fd8e57204a398c66d4", "4023 Blaine Trail", "8232671441",8);
INSERT INTO "User" VALUES (9, "bsanchez8@vk.com", "aathy8", "8467b174e821587c4a0545fd8e57204a398c66d4", "34 Eggendart Terrace", "6344913699",9);
INSERT INTO "User" VALUES (10, "fdepinna9@uol.com.br", "gmcphilip9", "8467b174e821587c4a0545fd8e57204a398c66d4", "79616 David Crossing", "1176162274",10);
INSERT INTO "User" VALUES (11, "kpamphilona@liveinternet.ru", "bpimmea", "8467b174e821587c4a0545fd8e57204a398c66d4", "46653 Nelson Center", "7845811784",11);
INSERT INTO "User" VALUES (12, "rgonningb@sciencedaily.com", "khalifaxb", "8467b174e821587c4a0545fd8e57204a398c66d4", "1601 Larry Drive", "2391248603",12);
INSERT INTO "User" VALUES (13, "abrimblecombc@mapy.cz", "cnorwoodc", "8467b174e821587c4a0545fd8e57204a398c66d4", "27443 Pepper Wood Terrace", "4619580426",13);
INSERT INTO "User" VALUES (14, "obrouardd@sphinn.com", "hhadyed", "8467b174e821587c4a0545fd8e57204a398c66d4", "63 Butterfield Circle", "7826437935",14);
INSERT INTO "User" VALUES (15, "thartfleete@4shared.com", "jpole", "8467b174e821587c4a0545fd8e57204a398c66d4", "0205 School Circle", "4402716689",15);
INSERT INTO "User" VALUES (16, "abengocheaf@wikipedia.org", "mrustanf", "8467b174e821587c4a0545fd8e57204a398c66d4", "09765 Becker Avenue", "7587843434",16);
INSERT INTO "User" VALUES (17, "rbrislaneg@godaddy.com", "ewhiffg", "8467b174e821587c4a0545fd8e57204a398c66d4", "55 Oriole Park", "8575196407",17);
INSERT INTO "User" VALUES (18, "gcosstickh@themeforest.net", "sglederh", "8467b174e821587c4a0545fd8e57204a398c66d4", "2683 Ohio Terrace", "9796527227",18);
INSERT INTO "User" VALUES (19, "vaspinali@amazon.co.jp", "ewellsteadi", "8467b174e821587c4a0545fd8e57204a398c66d4", "51543 Commercial Lane", "6835259373",19);
INSERT INTO "User" VALUES (20, "msayerj@redcross.org", "rhazelhurstj", "8467b174e821587c4a0545fd8e57204a398c66d4", "68041 Gina Place", "1498615352",20);
INSERT INTO "User" VALUES (21, "msay@redcross.org", "rhazelhurstj", "8467b174e821587c4a0545fd8e57204a398c66d4", "68041 Rita Place", "9998615352",21);



INSERT INTO Customer VALUES (1);
INSERT INTO Customer VALUES (2);
INSERT INTO Customer VALUES (3);
INSERT INTO Customer VALUES (4);
INSERT INTO Customer VALUES (5);
INSERT INTO Customer VALUES (6);
INSERT INTO Customer VALUES (7);
INSERT INTO Customer VALUES (8);
INSERT INTO Customer VALUES (9);
INSERT INTO Customer VALUES (10);
INSERT INTO Customer VALUES (11);
INSERT INTO Customer VALUES (12);
INSERT INTO Customer VALUES (13);
INSERT INTO Customer VALUES (14);
INSERT INTO Customer VALUES (15);

INSERT INTO "Order" VALUES (1, 2, 3, 4, 21);
INSERT INTO "Order" VALUES (2, 4, 2, 3, 21);
INSERT INTO "Order" VALUES (3, 1, 3, 5, 21);
INSERT INTO "Order" VALUES (4, 2, 4, 5, 21);
INSERT INTO "Order" VALUES (5, 3, 2, 1, 21);

-- TODO: MORE DISHES TO THE MENU AND MORE MENUS
INSERT INTO Menu VALUES (1, 1);

INSERT INTO Review VALUES (1, "1", "Good food, great service", "2022-01-09", 1, 1);
INSERT INTO Review VALUES (2, "1", "Had a great time", "2022-02-19", 2, 2);
INSERT INTO Review VALUES (3, "2", "Not the best service, but the food was good", "2022-01-22", 3, 3);
INSERT INTO Review VALUES (4, "4", "Food was cold and staff was rude", "2022-03-01", 4, 4);
INSERT INTO Review VALUES (5, "5", "Best restaurant ever", "2022-02-10", 5, 5);

INSERT INTO Owner VALUES (16, 1);
INSERT INTO Owner VALUES (16, 2);
INSERT INTO Owner VALUES (16, 3);
INSERT INTO Owner VALUES (17, 4);
INSERT INTO Owner VALUES (17, 5);
INSERT INTO Owner VALUES (18, 6);
INSERT INTO Owner VALUES (18, 7);
INSERT INTO Owner VALUES (18, 8);
INSERT INTO Owner VALUES (18, 9);
INSERT INTO Owner VALUES (19, 10);
INSERT INTO Owner VALUES (20, 11);
INSERT INTO Owner VALUES (20, 12);
INSERT INTO Owner VALUES (20, 13);
INSERT INTO Owner VALUES (20, 14);
INSERT INTO Owner VALUES (20, 15);

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

INSERT INTO Courier VALUES (21);