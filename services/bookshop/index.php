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
Router::get('results', 'FindResultsController');
Router::post('register', 'SecurityController');
Router::post('login', 'SecurityController');
Router::post('logout', 'SecurityController');
Router::get('userDashboard', 'UserDashboardController');
Router::get('employeeDashboard', 'employeeDashboardController');
Router::get('adminDashboard', 'adminDashboardController');

Router::run($path);