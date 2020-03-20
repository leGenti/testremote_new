<?php


class Taak
{
    // Database connection and table name

    private $conn;
    private $table_name = "taak";

    // Object properties

    public $taa_id;
    public $taa_datum;
    public $taa_omschr;

    // Contstructor with $db as database connection

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Read Taken

    public function read() {
        $sql = 'SELECT * FROM ' . $this->table;

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt;
    }

    // Create TAAK using POST

    public function create(){
        $sql = 'INSERT INTO ' . $this->table_name . ' SET taa_datum = :taa_datum, taa_omschr = :taa_omschr';

        // prepare SQL statement
        $stmt = $this->conn->prepare($sql);

        // Sanitize

        $this->taa_omschr = htmlspecialchars(strip_tags($this->taa_omschr));

        //Bind values

        $stmt->bindParam(':taa_omschr', $this->taa_omschr);
        $stmt->bindParam(':taa_datum', $this->taa_datum);

        //Execute query

        if($stmt->execute()) {
            return true;
        } return false;

    }

    // Read One taak using ID

    public function readOne() {
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE taa_id = ' . $this->taa_id;

        // Prepate SQL statement

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        // Get retrieved row

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set values to object properties

        $this->taa_id = $row['taa_id'];
        $this->taa_datum = $row['taa_datum'];
        $this->taa_omschr = $row['taa_omschr'];
    }

    public function update()
    {
        $sql = 'UPDATE ' . $this->table_name . ' SET taa_datum = :taa_datum, taa_omschr = :taa_omschr WHERE taa_id = :taa_id';

        // prepare SQL statement

        $stmt = $this->conn->prepare($sql);

        // Sanitize

        $this->taa_omschr = htmlspecialchars(strip_tags($this->taa_omschr));
        $this->taa_id = htmlspecialchars(strip_tags($this->taa_id));

        //Bind new values

        $stmt->bindParam(':taa_omschr', $this->taa_omschr);
        $stmt->bindParam(':taa_datum', $this->taa_datum);
        $stmt->bindParam(':taa_id', $this->taa_id);

        //Execute query

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete the taak

    public function delete() {
        $sql = 'DELETE FROM ' . $this->table_name . ' WHERE taa_id = :taa_id';

        $stmt = $this->conn->prepare($sql);

        // Sanitize
        $this->taa_id = htmlspecialchars(strip_tags($this->taa_id));

        // Bind new value
        $stmt->bindParam(':taa_id', $this->taa_id);

        //Execute query
        if($stmt->execute()) {
            return true;
        } return false;

    }

}