<?php

class BaseModel
{
    protected mysqli $conn;
    protected string $modelName;
    public function __construct(string $modelName)
    {
        $this->conn = static::connectDb();
        $this->modelName = $modelName;
    }

    public static function connectDb()
    {
        $servername = "mariadb";
        $username = "root";
        $password = "123456789";
        $dbname = "php_project_demo_db";
        $conn = new mysqli($servername, $username, $password, $dbname);
        $conn->set_charset("utf8");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

    public function read(int $id)
    {
        $sql = "SELECT * FROM $this->modelName WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->conn->close();
        return $result->fetch_assoc();
    }

    public function readAll(): array
    {
        $data = array();
        $sql = "SELECT * FROM $this->modelName";
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $this->conn->close();
        return $data;
    }
}