# Fresh Market

Fresh Market is a fully functional, small-scale e-commerce web application that allows users to register accounts, browse and search for products, add items to their cart, place orders, and provide feedback or suggestions. Additionally, administrators are responsible for managing orders, including marking them as delivered once they have been sent to the customer.

## Core Features

A Customer can:

- Sign Up: Allows users to create a new account.
- Login: Users can log in with their registered credentials.
- Product Search: Users can search for products by name.
- Product Filtering: Products are filtered by categories for easier browsing.
- View Product Details: Displays detailed information about selected product.
- Add to Cart: Users can add products to their shopping cart.
- Manage Selections: Users can view and edit items in their cart.
- Checkout: Add delivery location & choose payment method to complete the order.
- View Previous Orders: Customers can view the history of their past orders & pending orders.
- Make Reviews: Customers can leave feedback or reviews on purchased products.

An Admin can:

- Add Products: Admins can add new products.
- Delete Products: Admins can remove products.
- Edit Products: Admins can update the quantity of existing products.
- View All Orders: Admins can view a list of all customer orders.
- Mark Orders as Delivered: Admins can mark orders as delivered once they have been shipped to the customer.

## Development Approach

This project uses **Server-Side Rendering (SSR)** approach.

## Tech Stack

**Database:** MySQL

**Backend:** PHP

**Frontend:** HTML, CSS, & JS

**Version Control:** Git and Github


## Installation

Clone the Repository

```bash
  git clone https://github.com/HadySafa/Fresh-Market
```
Import the SQL File in XAMPP

- Start XAMPP and ensure Apache and MySQL are running.

- Open phpMyAdmin in your browser (http://localhost/phpmyadmin).

- Create a new database.

- Select the newly created database and click on the "Import" tab.

- Choose the SQL file from the cloned repository (found in Design-Docs folder) and click "Go" to import it.

- Browse the application through the following URL (http://localhost/freshmarket).
    
## Future Work

- Enhance the actions available to customers & admins.
- Integrate additional and improved payment methods.
- Implement notifications for order updates and alerts.
- Incorporate maps for selecting delivery locations.

## Note

For simplicity, it is assumed that product names are unique, without considering brand or weight specifications.

