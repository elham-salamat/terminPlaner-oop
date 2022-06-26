<?php

class databank
{
    public $serverName;
    public $dbName;
    public $userName;
    public $password;
    public $charset;
    public $dbConnection;
   
    public function __construct()
    {
        $this -> serverName = "localhost";
        $this -> dbName = "test";
        $this -> userName = "root";
        $this -> password = "";
        $this -> charset = "utf8mb4";

        try
        {
            $dataSourceName = "mysql:host=".$this -> serverName.";dbname=".$this -> dbName.";charset=".$this -> charset;
            $connection = new PDO($dataSourceName, $this -> userName, $this -> password);
            $connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $this -> dbConnection = $connection;
        }
        catch (PDOException $exception)
        {
            echo "Connection failed: ".$exception ->getMessage();
        }
    }

    public function __destruct()
    {
        
    }

    public function sqlQuery($sqlCommand, $inputs = array())
    {
        $statement = $this -> dbConnection -> prepare($sqlCommand);
        $statement -> execute($inputs);
        return $statement;
    }
        
    public function read($sqlCommand, $inputs = array())
    {
        $antwort = $this -> sqlQuery($sqlCommand, $inputs);
        $results = $antwort -> fetchAll();
        return $results;
    }    
    
    public function create($sqlCommand, $inputs = array())
    {
        $antwort = $this -> sqlQuery($sqlCommand, $inputs); 
        if ($this -> dbConnection -> lastInsertId() > 0)
        {
            return $this -> dbConnection -> lastInsertId();
        }
        else
        {
            return "There is an error in ". $sqlCommand;
        }    
    }

    public function delete($sqlCommand, $inputs = array())
    {
        $antwort = $this -> sqlQuery($sqlCommand, $inputs); 
        if ($antwort == true)
        {
            $string = "Successfully deleted:";
            $string .= $antwort -> rowCount();
            return $string;
        }
        else
        {
            return "There is an error in ". $sqlCommand;
        }
    }

    public function update($sqlCommand, $inputs = array())
    {
        $antwort = $this -> sqlQuery($sqlCommand, $inputs); 
        if ($antwort == true)
        {
            $string = "Successfully deleted:";
            $string .= $antwort -> rowCount();
            return $string;
        }
        else
        {
            return "There is an error in ". $sqlCommand;
        }

    }
}

