<?php

require_once("BaseModel.php");

class Book extends BaseModel
{
    public function __construct()
    {
        parent::__construct("books");
    }

    public function update($data): bool
    {
        try {
            $name = $data['name'];
            $author = $data['author'];
            $price = $data['price'];
            $id = $data['id'];

            $sql = "UPDATE $this->modelName SET name = ?, author = ?, price = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssdi", $name, $author, $price, $id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function delete(int $id): bool
    {
        try {
            $sql = "DELETE FROM $this->modelName WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function add($data): bool
    {
        try {
            $name = $data['name'];
            $author = $data['author'];
            $price = $data['price'];

            $sql = "INSERT INTO $this->modelName (name, author, price) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssd", $name, $author, $price);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}