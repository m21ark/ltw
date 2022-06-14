# LTW Project

## Description

Create a website where restaurants can list and offer their menus for take-away. To create this application, students should:

- Create an SQLite database that stores information about restaurants, menus, dishes, customers, and orders.
- Create documents using HTML and CSS representing the application's web pages.
- Use PHP to generate those web pages after retrieving/changing data from the database.
- Use Javascript to enhance the user experience (for example, using Ajax).

## Implemented Base Features

All base requirements were implemented.

### Accounts

- [x] Register new account
- [x] Login/Logout
- [x] Edit Profile (including photo)
- [x] Delete Profile
- [x] Users can stack functions roles

### Restaurants

- [x] Add Restaurant
- [x] Edit Restaurant
- [x] Remove Restaurant
- [x] Restaurant Photos
- [x] Searchable & Sortable
- [x] Mark as favorite

### Dishes

- [x] Add Dish
- [x] Edit Dish
- [x] Remove Dish
- [x] Dish Photos
- [x] Searchable & Sortable
- [x] Mark as favorite

### Reviews

- [x] List Restaurant Reviews
- [x] Customer Make Review with photo
- [x] Owner Can Answer Reviews

### Orders

- [x] Owners can see orders
- [x] Owners can change order state
- [x] Customer can see orders and status

## Extra Features

Most additional suggested requirements were also implemented.

### + Courier / Driver

- [x] Added Courier User
- [x] Courier can find ready plates to pickup at nearby restaurants
- [x] Courier can update delivery order status
- [x] Courier can cancel a delivery
- [x] Courier can alow geolocation tracking while delivering
- [x] Customer can check Courier geolocation with Google Maps API

### + Orders

- [x] Orders have extra information for the Courier
- [x] Order's Kanbord for Owner and Courier
- [x] Customer & Owners can cancel orders
- [x] Customer recieves notification with sound after order status change

### + Others

- [x] User actions notifications of types: info, error, success
- [x] Cart can include multiple restaurants and the orders will be split by restaurant
- [x] Some REST API's were developed
- [x] Image Carousel for Restaurants & Plates
- [x] Search plate category inside Restaurant Page

## Credentials

We have 3 kinds of users: Customer, Owner, Courier.
You can use the following demo user credentials:

| Users    | Email                    | Password     |
| -------- | ------------------------ | ------------ |
| Customer | ```user@gmail.com```     | ```batata``` |
| Owner    | ```owner@gmail.com```    | ```batata``` |
| Courier  | ```estafeta@gmail.com``` | ```batata``` |

## Workgroup

- Marco André (up202004901@fe.up.pt)
- Ricardo de Matos (up202007962@fe.up.pt)
- Francisco Bernardo (200904191@fe.up.pt)
