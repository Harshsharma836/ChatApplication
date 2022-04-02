<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
?>
<?php
class Connection {
    public $server;
    public $username;
    public $password;
    public $dbname;
    public $mysqli;
    public $conn = false;
    private $result = array();
    public function __construct ($server,$username,$password,$dbname) 
    {
        $this->server = $server;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;

    //create connection
    $this->mysqli = new mysqli($server,$username,$password,$dbname);
    $this->conn = true;
    //check connection
    if(!$this->conn)
    {
        die("sorry we failed to connect:".mysqli_connect_error());
    }
    else
    {
       //echo "connection established successfully<br>";
    }
}

    public function connreturn(){
            return $this->mysqli;
        }

    public function insert($table, $params)
    {
            $table_columns = implode(',', array_keys($params));
            $table_values = implode("','", $params);
            $sql = "INSERT INTO $table ($table_columns) VALUES ('$table_values')";

            if ($this->mysqli->query($sql)) {
                array_push($this->result, $this->mysqli->insert_id);
                
                return true;
            } else {
                array_push($this->result, $this->mysqli->error);
                return false;
            }
    }
    
    public function update($table, $params = array(), $where = null)
    {
            $args = array();
            foreach ($params as $key => $value) {
                $args[] = "$key='$value'";
            }
            $sql = "UPDATE $table SET " . implode(',', $args);
            if ($where != null) {
                $sql .= " WHERE $where";
            }
            if ($this->mysqli->query($sql)) {
                array_push($this->result, $this->mysqli->affected_rows);
                return true;
            }
        
    }
    public function delete($table, $where = null)
    {
       
            $sql = "DELETE FROM $table";
            if ($where != null) {
                $sql .= " WHERE $where";
            }
            echo $sql;
            if ($this->mysqli->query($sql)) {
                array_push($this->result, $this->mysqli->affected_rows);
                return true;
            } else {
                array_push($this->result, $this->mysqli->error);
                return false;
            }
            }


    public function select($table, $rows = "*")
    {
        
            $sql = "SELECT $rows FROM $table";
            $query = $this->mysqli->query($sql);
            if ($query) {
               return $query;
                
            } else {
                array_push($this->result, $this->mysqli->error);
                return false;
            }
        
    }
    public function getResult()
    {
        $val = $this->result;
        $this->result = array();
        return $val;
    }
}
    $obj1 = new Connection ("localhost","root","","harshchatbox");
    //echo "connection established on $obj1->server";

?>