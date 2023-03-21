<?php
class Database
{
 //Render params 
    private $host;
    private $port;
    private $dbname;
    private $username;
    private $password;
    private $conn;


    public function __construct()
    {
        $this->username = getenv('USERNAME');
        $this->password = getenv('PASSWORD');
        $this->dbname = getenv('DBNAME');
        $this->host = getenv('HOST');
        $this->port = getenv('PORT');
    }

    //DB connect 
    public function connect()
    {
        if ($this->conn) {
            return $this->conn;
        } else {
            $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->dbname};";

            try {
                $this->conn = new PDO($dsn, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->conn;
            } catch (PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }
        }
    }
/*
   
    //Local params 
    private $host = 'localhost';
    private $port = '5432';
    private $dbname = 'quotesdb';
    private $username = 'postgres';
    private $password = 'postgres';
    private $conn;


         //local db connection
         public function connect() {
            $this->conn = null;
            $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->dbname}";

            try {
                $this->conn = new PDO($dsn, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOexception $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }
            return $this->conn;
        }*/
}
