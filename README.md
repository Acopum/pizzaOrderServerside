# pizzaOrderServerside

Web application meant to be connected to a MySQL database. Companion application to pizzaOrderMobile.

## Purpose

To build a web application used to service SQL transactions and operations from a MySQL database.

## Repo Contents

* api
  * PHP page for pushing notifications to companion mobile app
* images
  * Contains images used by web application
* ingredientManage
  * PHP pages dedicated to ingredient DB management
* itemManage
  * PHP pages dedicated to order item DB management
* orderManage
  * PHP pages dedicated to order DB management
* notificationManage
  * PHP pages dedicated to notification DB management
* userManage
  * PHP pages dedicated to admin and user info DB management
* styleSheets
  * Contains CSS for web application styling
* ParetoMainMenu.php
  * Main page after login screen
* admins.php
  * Main page for admin management after main menu
* customers.php
  * Main page for user management after main menu
* ingredients.php
  * Main page for ingredient management after main menu
* notifications.php
  * Main page for notification management after main menu
* orders.php
  * Main page for order management after main menu
* paretoLogin.php
  * Simple login page using basic encryption of password

## Description

This web application is meant to be used with a MySQL DB and uses appropriate PHP syntax as a result. Database calls are done right in PHP script. A companion mobile application makes use of notifications packaged by the web application, mainly pertaining to current orders.


