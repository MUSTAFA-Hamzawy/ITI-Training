<?php 

class Database
{
    private $pdo;

    public function connect($host, $dbname, $username, $password)
    {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            // echo "connected to db.";
        } catch (PDOException $e) {
            echo "Failed to connect to db.";
            die;
        }
    }

    public function insert($table, $columns, $values)
    {
        try {
            $columns_as_string = implode(", ", $columns);
            $placeholders = rtrim(str_repeat("?, ", count($values)), ", ");     // rtrim to remove the last comma
            $sql = "INSERT INTO $table ($columns_as_string) VALUES ($placeholders)";
            $prepared = $this->pdo->prepare($sql);
            for ($i = 0; $i < count($values); $i++) {
                $prepared->bindParam($i + 1, $values[$i]);
            }

            $prepared->execute();

            return true;
        } catch (PDOException $e) {
            echo "Failed to insert the data.";
            die;
        }
    }

    public function select($table)
    {
        try {
            $sql = "SELECT * FROM $table";
            $prepared = $this->pdo->prepare($sql);
            $prepared->execute();
            return $prepared->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Failed to retrieve the data.";
            die;
        }
    }

    public function selectWhere($table, $attribute, $value)
    {
        try {
            $sql = "SELECT * FROM $table where $attribute = '$value'";
            $prepared = $this->pdo->prepare($sql);
            $prepared->execute();
            return $prepared->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Failed to retrieve the data.";
            die;
        }
    }

    public function update($table, $id, $fields)
    {
        try {
            $updates = [];
            foreach ($fields as $column => $value) {
                $updates[] = "$column = :$column";
            }
            $updates_as_string = implode(", ", $updates);
            $sql = "UPDATE $table SET $updates_as_string WHERE id = :id";
            $prepared = $this->pdo->prepare($sql);
            foreach ($fields as $column => &$value) {
                $prepared->bindParam(":$column", $value);
            }
            $prepared->bindParam(":id", $id);
            $prepared->execute();
            return true;
        } catch (PDOException $e) {
            echo "Failed to update the data.";
            die;
        }
    }

    public function delete($table, $id)
    {
        try {
            $sql = "DELETE FROM $table WHERE id = :id";
            $prepared = $this->pdo->prepare($sql);
            $prepared->bindParam(":id", $id);
            $prepared->execute();
            return true;
        } catch (PDOException $e) {
            echo "Failed to delete the data.";
            die;
        }
    }

    public function __destruct(){
        $this->pdo = null;
    }
}