[![Stories in Ready](https://badge.waffle.io/NickSeagull/restaurant-management.png?label=ready&title=Ready)](https://waffle.io/NickSeagull/restaurant-management)
# Restaurant management system

**This is just a toy project to start fiddling around with PHP**

The requirements were set as an assignment for a subject. So I decided it was
the best way to start trying some things in PHP.

The environment where the assignment is submitted to does not support using
folders in the projects, so dont expect a lot of modularity here.

Also, the only external library I will be using is **atoum** for my tests.

## Requirements

Implement a web application that allows managing a restaurant. Mostly a service
for **waiters** and the **cooks**.

The application will allow managing three types of users:
* Visitor
* Waiter
* Cook

A **visitor** can only access public information about the restaurant, and its
menu (food and drinks), in the latter, the visitor will be able to find any item
by its name. Also, if the client is already registered, he/she will be able to
login.

A **waiter** will be able to do everything that a **visitor** can do, with the
addition of:
* List all the tables, and after selecting one:
  * Start an order
  * Add items to this order
  * Serve dishes/drinks from this order
  * Close and make the bill for this order
  
A **cook** will be able to see all the items that have to be prepared, allowing to say if the item is being prepared or it has been finished.

## Technical matters

**PHP** will be used as the backend programming language, **SQLite** as the DB
manager and for the client app, **Javascript** with the help of **jQuery**.

The database is already provided in the `restaurante.sql` file.
