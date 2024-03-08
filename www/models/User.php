<?php

require_once("BaseModel.php");

class User extends BaseModel
{
    public function __construct()
    {
        parent::__construct("users");
    }

    public function signUp(string $userName, string $password)
    {
        try {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert_sql = "INSERT INTO $this->modelName (username, password_hash) VALUES (?, ?)";
            $insert_stmt = $this->conn->prepare($insert_sql);
            $insert_stmt->bind_param("ss", $userName, $hashed_password);
            $insert_stmt->execute();
            $insert_stmt->close();
            $this->conn->close();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function checkDuplicateUserName(string $username)
    {
        $check_username_sql = "SELECT id FROM $this->modelName WHERE username = ?";
        $check_username_stmt = $this->conn->prepare($check_username_sql);
        $check_username_stmt->bind_param("s", $username);
        $check_username_stmt->execute();
        $check_username_result = $check_username_stmt->get_result();
        return $check_username_result->num_rows > 0;
    }

    public function login(string $userName, string $password, bool $isRememberMe)
    {
        $sql = "SELECT * FROM $this->modelName WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $userName);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->conn->close();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password_hash'])) {
                session_start();
                $_SESSION['user_name'] = $userName;
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                if ($isRememberMe) $this->rememberMe($userName, $password);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function checkCredentials(string $userName, string $password)
    {
        $sql = "SELECT * FROM $this->modelName WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $userName);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->conn->close();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            return password_verify($password, $user['password_hash']);
        } else {
            return false;
        }
    }

    public function rememberMe(string $userName, string $password)
    {
        $cookie_value = base64_encode($userName . ':' . $password);
        setcookie('remember_me_cookie', $cookie_value, time() + (60 * 60 * 24 * 7 * 1)); // one week
    }
}