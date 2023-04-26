[![Open in Visual Studio Code](https://classroom.github.com/assets/open-in-vscode-c66648af7eb3fe8bc4f294546bfd86ef473780cde1dea487d3c4ff354943c9ae.svg)](https://classroom.github.com/online_ide?assignment_repo_id=10631618&assignment_repo_type=AssignmentRepo)
# CW1
## Idea: Papa's Pizza Restaurant
A restaurant website that sells pizza.
Users can sign up, put items in their cart, edit their cart, checkout, and track past orders.
<br>
demo goes here
<br><br>
Important Features:
+ Signup/Login Modal Box
+ Home Page
+ Cart System
+ Cart Page
+ Checkout Page
+ Account Info Page
+ Track Orders Page
+ Admin View (update and delete orders from database) 
<br>
<p align="center">
<img src="https://user-images.githubusercontent.com/114566375/234657034-9663eb1c-91b5-45a3-9552-67d39257b1b5.png" width="900"><br>
<em>Sign Up/In</em>
<br><br>
<img src="https://user-images.githubusercontent.com/114566375/234656835-a0fe6405-45fa-4c54-9d8e-9ff0a37d7f29.png" width="900"><br>
<em>Checkout Page</em>
<br><br>
<img src="https://user-images.githubusercontent.com/114566375/234657418-3e3b1a3d-ed8e-445b-9866-7d7c14e8a57b.png" width="900"><br>
<em>Menu</em>
<br><br>
<img src="https://user-images.githubusercontent.com/114566375/234657753-33aa8ab7-b372-4a8d-93b4-faa9841e777b.png" width="900"><br>
<em>Cart</em>
<br><br>
</p>

## Database Structure
The database structure is illustrated in the figure below: 
<br><br>
<img src="https://user-images.githubusercontent.com/114566375/234658095-5e96c55d-b3b9-4a55-9494-19c51b67730f.png">
<br>
Information about the restaurant products are stored in the `pizzas` table, where each product is given a unique id (primary key), a unique name, ingredients, base price and image (stored as a mediumblob). Furthermore, sizes and their price increase percentage are stored in the `sizes` table and given a unique id (primary key).
<br>
When a user first signs up, their email, name, and password (hashed) are stored in the `person` table, and they are assigned a unique id (primary key). 
When the user places an order, the user’s address is stored in the `person_address` table along with the user’s id (to be used as a foreign key and link that address to the user) and the address is given a unique key. If the user inputs a card, it will be stored (hashed) in the `cards` table along with the user id in a similar manner to the `person_address` table.
<br>
Then, the order is stored in the `order` table along with the user id, address id and other info like delivery notes, time created, order status, payment method and order total. Then the order is assigned a unique id.
<br>
The order id is then stored in the `order_details` table, which contains the id for the products, the id for the size, the individual item price, and the quantity. This information is separated from the `orders` table to prevent clutter and make the tables more readable.
<br>
With the aforementioned structure, data is well organized and PHP scripts can easily access and navigate information. In the following section, the mechanism of the server-side scripts will be explained in detail.

## PHP

### Sessions
Using PHP, users can sign up/in and start a session using forms that ‘POST’. First, PHP validates user input in the sign up/in page, and then stores the data/checks if it is already present in the database.
<br>
![image](https://user-images.githubusercontent.com/114566375/234660068-5925b9ee-66d3-48ab-93df-0f8ddbe52c72.png)
`Snippet of email and password validation`
<br><br>
![image](https://user-images.githubusercontent.com/114566375/234660136-a905dfa0-c304-4c27-9b0a-64dcf4294a09.png)
`Inserting account to db`
<br><br>
The user email and username are then added to the `$_SESSION` super global variable.
![image](https://user-images.githubusercontent.com/114566375/234660419-24dc7e2d-c4a5-49a6-b5f0-bc904deeda09.png)
<br>
`getting current username and email`
<br><br>

### SELECT Operations (READ)
Moving to the menu page, the PHP script grabs all data about the products and available sizes, then uses a loop to write all the products in the form of cards in the menu page.
<br>
![image](https://user-images.githubusercontent.com/114566375/234660852-290a012a-2d0f-4013-ba07-ac20edccd682.png)
<br>
`getting product infor from db`
<br><br>
![image](https://user-images.githubusercontent.com/114566375/234661074-1d8d0240-4386-4dd9-bbab-255e30bfa359.png)
<br>
`Snippet of menu`
<br><br>
The user can then add items to their cart. Cart items are stored in the `$_SESSION[‘cart’]` super global variable. They are stored using only the product id, and the size the user chose. Since the database is well organized, PHP can grab the rest of the information from the database easily without having to store too much information in the `$_SESSION` variable.
<br>
![image](https://user-images.githubusercontent.com/114566375/234661702-9c2a6311-2773-416c-9ffb-6e3147bdd256.png)
<br>
`adding items to $_SESSION['cart'] when user presses add to cart`
<br><br>
The user can then edit or remove items from their cart operations.
