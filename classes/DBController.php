<?php 

    class DBController {
    public $dbHost = "ec2-34-242-84-130.eu-west-1.compute.amazonaws.com";
    public $dbUser = "atoggxppbtixfi";
    public $dbPassword = "846a40787b4d0f58e1052829c8eac2e21854f7f086f7801ff9fdaf890047ab19";
    public $dbName = "dd4df335g7oksa";
    public $connection;

    public function openConnection()
    {
        $this->connection = new mysqli($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName);
        if ($this->connection->connect_error) {
            echo " Error in Connection : " . $this->connection->connect_error;
            return false;
        } else {
            return true;
        }
    }

    public function closeConnection()
    {
        if ($this->connection) {
            // TODO: Check if this is still breaking the code
            //$this->connection->close();
        } else {
            echo "Connection is not opened";
        }
    }

    public function select($qry)
    {
        $result = $this->connection->query($qry);
        if (!$result) {
            echo "Error : " . mysqli_error($this->connection);
            return false;
        } else {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }

    public function insert($qry)
    {
        $result = $this->connection->query($qry);
        if (!$result) {
            echo "Error : " . mysqli_error($this->connection);
            return false;
        } else {
            return true;
        }
    }

    public function delete($query)
    {
        $result = $this->connection->query($query);
        if (!$result) {
            echo "Error : " . mysqli_error($this->connection);
            return false;
        } else {
            return $result;
        }
    }
}

?>