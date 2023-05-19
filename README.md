[![Open in Visual Studio Code](https://classroom.github.com/assets/open-in-vscode-c66648af7eb3fe8bc4f294546bfd86ef473780cde1dea487d3c4ff354943c9ae.svg)](https://classroom.github.com/online_ide?assignment_repo_id=10631618&assignment_repo_type=AssignmentRepo)
<a name="readme-top"></a>

# Papa's Restaurant

###### CW1 for intro to web dev. module at TKH-Coventry University

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li><a href="#usage">Usage</a></li>
    <ul>
        <li><a href="#admin-account-credentials">Admin Account Credentials</a></li>
        <li><a href="#file-structure">File Structure</a></li>
      </ul>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
        <li><a href="#important-features">Important Features</a></li>
      </ul>
    </li>
    <li><a href="#database">Database</a></li>
    <li><a href="#php">PHP</a></li>
    <ul>
      <li><a href="#sessions">Sessions</a></li>
      <li><a href="#select-operations-read">SELECT Operations (READ)</a></li>
      <li><a href="#insert-operations-create">INSERT Operations (CREATE)</a></li>
      <li><a href="#update-and-delete-operations">UPDATE and DELETE Operations</a></li>
      <li><a href="#cookies">Cookies</a></li>
    </ul>
    <li><a href="#frontend">Frontend</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>

## Usage
To run this project:
+	Clone the GitHub directory into xampp/htdocs folder (or your path if the default folder has been changed).
+	Then import the database into phpMyAdmin.

### Admin Account Credentials
Email: admin@admin.com
<br>
Password: Admin123@

### File Structure
All pages that can be visited are found in the main directory:
<ul>
  <li>	index.php: home page </li>
  <li>	index_a.php: admin only home page </li>
  <li>	menu.php:  menu </li>
  <li>	cart.php: view cart page </li>
  <li>	orders.php: see all placed orders // displays delete and change status in administrative mode </li>
  <li>	checkout.php: chechout page </li>
  <li>	search.php: search page </li>
</ul>
Scripts (JS) are found in the scripts directory. <br>
CSS style sheets are found in the styles directory. <br>
Commonly used code (like nav bar, footer, sign up/log in, user / cart icons) are found in templates:
<ul>
  <li>	footer.php </li>
  <li>	logo.php </li>
  <li>	logout.php </li>
  <li>	nav.php </li>
  <li>	user_cart.php: contains the login modal box and the cart + user icons </li>
</ul>
PHP dependencies of the pages can be found in includes directory. <br>
Images and other cosmetics are found in the images directory. <br>
The database connection is found in config directory. <br>
<p align="right">(<a href="#readme-top">back to top</a>)</p>


## About the Project
A restaurant website that sells pizza.
Users can sign up, put items in their cart, edit their cart, checkout, and track past orders.


https://user-images.githubusercontent.com/114566375/234685769-47b36263-749c-4cdb-9dc0-88abc3d68152.mp4


<br><br>
### Built With
+ <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white">
+ <img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white">
+ <img src="https://img.shields.io/badge/JavaScript-323330?style=for-the-badge&logo=javascript&logoColor=F7DF1E">
+ <img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white">
+ <img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white">

### Important Features:
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
<p align="right">(<a href="#readme-top">back to top</a>)</p>

## Database
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
<p align="right">(<a href="#readme-top">back to top</a>)</p>

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
The user can then edit or remove items from their cart.
<br>
![image](https://user-images.githubusercontent.com/114566375/234668538-e0009121-5212-4e91-b3f8-9e8a0fd24a7a.png)
<br>
`Remove and update items in cart`
<br><br>
When the user wants to checkout, they need to press the checkout button to get permission to access the checkout page.
<br>
![image](https://user-images.githubusercontent.com/114566375/234668781-d524d5a7-22c5-48e9-b6a7-05cace44bb01.png)
<br>
`gaining permission`
<br><br>
![image](https://user-images.githubusercontent.com/114566375/234669015-71ed4b4f-bdca-465a-b40d-f28ef710e21b.png)
<br>
`checking permission on checkout page`
<br><br>

### INSERT Operations (CREATE)
The user can then input their address and card details if they wish to pay by card (the inputs are validated in the back-end similar to the sign-up process). After the order is confirmed, PHP inserts that data into the database following the structure mentioned in the previous section.
<br>
![image](https://user-images.githubusercontent.com/114566375/234669481-cdfa10b7-4c0c-4bdc-b34c-4f451e7b5837.png)
![image](https://user-images.githubusercontent.com/114566375/234669571-d683b6f9-7b05-46e4-96de-33553c3bff7c.png)
`inserting information into database`
<br><br>
The user is then redirected to their orders page where PHP fetches info about all their past orders and displays it.
<br>
![image](https://user-images.githubusercontent.com/114566375/234669767-19c978c3-1400-4a64-900d-04aca0fffa58.png)
<br>
`getting orders info using user id`
<br><br>

### UPDATE and DELETE Operations
If the user has admin privileges, they can update or remove orders from the database using UPDATE and DELETE operations in MYSQL. With admin privileges, the user can access a page that was previously restricted and edit orders (admin credentials found above).
<br>
![image](https://user-images.githubusercontent.com/114566375/234671677-3bd031ba-c378-4a20-9311-feb633d11252.png)
<br>
`UPDATE and DELETE operations`

### Cookies
The search function of the website utilizes reading data from the database and cookies to store user’s recent searches to improve user experience.
<br>
![image](https://user-images.githubusercontent.com/114566375/234671879-645bd293-ff1a-4233-8389-7582a552d30d.png)
<br>
`cookies and search`
<br><br>
<p align="right">(<a href="#readme-top">back to top</a>)</p>

## Frontend
The goal of front-end development is to give users a friendly interface through which they can use the application. HTML was used to create the basic website and CSS was used to stylize it and give it a unique touch. JavaScript functions were used to create a dynamic web experience that suits the user.

### JavaScript Functions
Some JavaScript functions used on the website include:
+ addRed() which alerts the user if the PHP validation returned any problems. <br>
![image](https://user-images.githubusercontent.com/114566375/234672361-394947f3-24c0-4f7d-bcc6-79ffa2a5e82e.png)
![image](https://user-images.githubusercontent.com/114566375/234672464-e0326d13-4196-4610-a6fa-bd6fa814762a.png)
`addRed() Function`
+ •	forceLogin() which does not allow user to press checkout if they are not logged in. <br>
![image](https://user-images.githubusercontent.com/114566375/234672686-30349fd3-39bd-45ef-9b76-1e146914b46b.png)
`forceLogin() Function`
+	sizePrice() which dynamically calculates the price of different sized items when user changes size. <br>
![image](https://user-images.githubusercontent.com/114566375/234673261-8437608c-fed2-46b3-8640-6b68af493bb1.png)
`sizePrice() Function`
+	Function that restores scroll position when page refreshes after item is added to cart, so that user can have an uninterrupted shopping experience. <br>
![image](https://user-images.githubusercontent.com/114566375/234673471-022161f9-8447-4f48-845e-19a2444fc683.png)
+ Function that shows/hides the credit card information form according to user’s choice. <br>
![image](https://user-images.githubusercontent.com/114566375/234673630-7171a642-7769-4cea-a854-51f3827ef184.png)
<p align="right">(<a href="#readme-top">back to top</a>)</p>

## Contact

Arwa Essam Abdelaziz - aa2101585@tkh.edu.eg

Project Link: [https://github.com/Coventry-TKH/coursework-1-IryVk](https://github.com/Coventry-TKH/coursework-1-IryVk)
<p align="right">(<a href="#readme-top">back to top</a>)</p>



