<?php

require_once("BaseController.php");
require_once("models/User.php");

class UserController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new User());
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            require_once("views/$this->modelName/login.php");
            return;
        }

        $loginUrl = "index.php?model=user&action=login";
        $isRememberMe = $_POST['rememberMe'] ?? false;
        if (empty($_POST['username']) || empty($_POST['password']))
            $this->redirect($loginUrl, Variable::MSG_FAIL_STATUS, Variable::REQUIRE_ERROR_MESSAGE);
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $this->model->login($_POST['username'], $_POST['password'], $isRememberMe))
            $this->redirect("index.php?model=book&action=readAll");
        $this->redirect($loginUrl, Variable::MSG_FAIL_STATUS, "Kiểm tra lại tài khoản và mật khẩu");
    }

    public function signUp()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            require_once("views/$this->modelName/signUp.php");
            return;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $signUpUrl = "index.php?model=user&action=signUp";

            // Validate
            if (empty($password) || empty($username))
                $this->redirect($signUpUrl, Variable::MSG_FAIL_STATUS, Variable::REQUIRE_ERROR_MESSAGE);
            if ($this->model->checkDuplicateUserName($username))
                $this->redirect($signUpUrl, Variable::MSG_FAIL_STATUS, "Tên trùng, vui lòng nhập lại");

            if ($this->model->signUp($username, $password))
                $this->redirect("index.php?model=user&action=login", Variable::MSG_SUCCESS_STATUS, "Đăng kí tài khoản thành công, vui lòng đăng nhập");
            $this->redirect($signUpUrl, Variable::MSG_FAIL_STATUS, Variable::COMMON_ERROR_MESSAGE);
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        setcookie('remember_me_cookie', '', time() - 3600);
        header('Location: index.php?model=user&action=login');
    }
}
