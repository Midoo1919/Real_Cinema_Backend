
<?php

class Db{
private $host = "localhost";
private $user = "root";
private $pwd = "";
private $dbName = "cinemadb" ;
public $connection;

    public function connect(){
        $this->connection=new mysqli($this->host,$this->user,$this->pwd,$this->dbName);
        if($this->connection->connect_error){
            echo"error in connection : ".$this->connection->connect_error ; 
            return false; 
        }
        else{
            return true;
        }
    }   
    public function closeConnection()
    {
        if($this->connection)
        {
            $this->connection->close();
        }
        else
        {
            echo "Connection is not opened";
        }
    }

    public function select($qry)
    {
        $result=$this->connection->query($qry);
        if(!$result)
        {
            echo "Error : ".mysqli_error($this->connection);
            return false;
        }
        else
        {
             return $result->fetch_all(MYSQLI_ASSOC);
        }

    }
    public function insert($qry)
    {
        $result=$this->connection->query($qry);
        if(!$result)
        {
            echo "Error : ".mysqli_error($this->connection);
            return false;
        }
        else
        {
             return $this->connection->insert_id;
        }

    }
    public function delete($qry)
    {
        $result=$this->connection->query($qry);
        if(!$result)
        {
            echo "Error : ".mysqli_error($this->connection);
            return false;
        }
        else
        {
             return $result;
        }

    }
    }
