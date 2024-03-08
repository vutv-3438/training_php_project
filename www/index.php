<?php
// Router
require_once("common/Variable.php");
require_once("common/Policy.php");

$model = $_GET['model'] ?? null;
$action = $_GET['action'] ?? 'read';
$id = $_GET['id'] ?? null;
$controller = null;

switch ($model) {
    case 'book':
        Policy::checkAuthorize();
        require_once("controllers/BookController.php");
        $controller = new BookController();
        switch ($action) {
            case 'create':
                $controller->create();
                break;
            case 'add':
                $controller->add($_POST);
                break;
            case 'read':
                $controller->read($id);
            case 'readAll':
                $controller->readAll();
                break;
            case 'edit':
                $controller->edit($id);
                break;
            case 'update':
                $controller->update($_POST);
                break;
            case 'delete':
                $controller->delete($id);
                break;
        }
        break;
    case 'user':
        require_once("controllers/UserController.php");
        $controller = new UserController();
        switch ($action) {
            case 'login':
                $controller->login();
                break;
            case 'signUp':
                $controller->signUp();
                break;
            case 'logout':
                Policy::checkAuthorize();
                $controller->logout();
                break;
        }
        break;
    default:
        require_once("controllers/BookController.php");
        Policy::checkAuthorize();
        $controller = new BookController();
        $controller->readAll();
}