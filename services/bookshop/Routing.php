<?php

require_once 'src/controller/DefaultController.php';
require_once 'src/controller/SecurityController.php';
require_once 'src/controller/NewBooksController.php';
require_once 'src/controller/BestsellersController.php';
require_once 'src/controller/ContactController.php';
require_once 'src/controller/BookCategoryController.php';
require_once 'src/controller/BookDetailController.php';
require_once 'src/controller/FindResultsController.php';
require_once 'src/controller/UserDashboardController.php';
require_once 'src/controller/ExploreBooksController.php';
require_once 'src/controller/UserShoppingCartController.php';
require_once 'src/controller/UserFavoritesController.php';
require_once 'src/controller/AdminDashboardController.php';
require_once 'src/controller/EmployeeDashboardController.php';

class Router {

    public static $routes;

    public static function get($url, $view)
    {
        self::$routes[$url] = $view;
    }

    public static function post($url, $view)
    {
        self::$routes[$url] = $view;
    }

    public static function run($url)
    {

        $urlParts = explode("/", $url);
        $action = $urlParts[0];

        if (!array_key_exists($action, self::$routes)) {
            die("Wrong url!");
        }

        $controller = self::$routes[$action];
        $object = new $controller;
        $action = $action ?: 'index';

        $id = $urlParts[1] ?? '';

        $object->$action($id);
    }
}