<?php

class Model
{
    protected $db;
    protected $table;

    // Constructor function to set up the database connection
    public function __construct($table)
    {
        $this->table = $table;
        $host = "127.0.0.1";
        $dbname = "mvc-tuto";
        $dbport = "3306";
        $username = "root";
        $password = "";

        try {
            $this->db = new PDO("mysql:host=$host;dbname=$dbname;port=$dbport", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable exception mode
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage()); // Improved error handling
        }
    }

    // Get all records
    public function all()
    {
        $stmt = $this->db->prepare("SELECT * FROM " . $this->table);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get a record by ID
    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM " . $this->table . " WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM " . $this->table . " WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Insert a new record
    public function create($data)
    {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));

        $stmt = $this->db->prepare("INSERT INTO " . $this->table . " ($columns) VALUES ($placeholders)");

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();
        return $this->db->lastInsertId();
    }

    // Update a record by ID
    public function update($id, $data)
    {
        $setClause = "";
        foreach ($data as $key => $value) {
            $setClause .= "$key = :$key, ";
        }
        $setClause = rtrim($setClause, ", ");

        $stmt = $this->db->prepare("UPDATE " . $this->table . " SET $setClause WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();
        return $stmt->rowCount();
    }

    // Delete a record by ID
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM " . $this->table . " WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
}