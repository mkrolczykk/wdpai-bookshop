<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('newBooks', 'NewBooksController');
Router::get('bestsellers', 'BestsellersController');
Router::get('contact', 'ContactController');
Router::get('category', 'BookCategoryController');
Router::get('bookDetail', 'BookDetailController');
Router::get('search', 'FindResultsController');
Router::post('register', 'SecurityController');
Router::post('login', 'SecurityController');
Router::post('logout', 'SecurityController');
Router::get('userDashboard', 'UserDashboardController');
Router::get('explore', 'ExploreBooksController');
Router::get('myFavorites', 'UserFavoritesController');
Router::get('shoppingCart', 'UserShoppingCartController');
Router::get('employeeDashboard', 'EmployeeDashboardController');
Router::get('addBook', 'AddBookController');
Router::get('adminDashboard', 'AdminDashboardController');
Router::get('addEmployee', 'AddEmployeeController');

Router::run($path);