<?php

class Converter
{
    // Source database variables
    private $source_db_type;
    private $source_db_server;
    private $source_db_user;
    private $source_db_pass;
    private $source_db_name;

    // Target database variables
    private $target_db_type;
    private $target_db_server;
    private $target_db_user;
    private $target_db_pass;
    private $target_db_name;

    // Constructor
    function __construct($source_db_type, $source_db_server, $source_db_user, $source_db_pass, $source_db_name, $target_db_type, $target_db_server, $target_db_user, $target_db_pass, $target_db_name)
    {
        $this->source_db_type = $source_db_type;
        $this->source_db_server = $source_db_server;
        $this->source_db_user = $source_db_user;
        $this->source_db_pass = $source_db_pass;
        $this->source_db_name = $source_db_name;
        $this->target_db_type = $target_db_type;
        $this->target_db_server = $target_db_server;
        $this->target_db_user = $target_db_user;
        $this->target_db_pass = $target_db_pass;
        $this->target_db_name = $target_db_name;
    }

    // Main method for database conversion
    public function convert()
    {
        if ($this->source_db_type == "mysql" && $this->target_db_type == "mysql") {
            $this->mysql2mysql();
        } elseif ($this->source_db_type == "mysql" && $this->target_db_type == "sql") {
            $this->mysql2sql();
        } elseif ($this->source_db_type == "sql" && $this->target_db_type == "mysql") {
            $this->sql2mysql();
        } elseif ($this->source_db_type == "sql" && $this->target_db_type == "sql") {
            $this->sql2sql();
        }
    }

    // Database conversion mysql to mysql
    private function mysql2mysql()
    {
        $this->mysqlCreateDb();
    }

    // Database conversion mysql to sql
    private function mysql2sql()
    {
        $this->sqlCreateDb();
    }

    // Database conversion sql to mysql
    private function sql2mysql()
    {
        $this->mysqlCreateDb();
    }

    // Database conversion sql to sql
    private function sql2sql()
    {
        $this->sqlCreateDb();
    }

    // Creates mysql database if it doesn't exist
    private function mysqlCreateDb()
    {
        $conn = mysqli_connect($this->target_db_server, $this->target_db_user, $this->target_db_pass);
        $sql = "CREATE DATABASE IF NOT EXISTS $this->target_db_name";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
    }

    // Creates sql database if it doesn't exist
    private function sqlCreateDb()
    {
        $info = array("UID" => "$this->target_db_user", "PWD" => "$this->target_db_pass");
        $conn = sqlsrv_connect($this->target_db_server, $info);
        $sql = "IF NOT EXISTS(SELECT * FROM sys.databases WHERE name = '$this->target_db_name') BEGIN CREATE DATABASE [$this->target_db_name] END";
        sqlsrv_query($conn, $sql);
        sqlsrv_close($conn);
    }



}