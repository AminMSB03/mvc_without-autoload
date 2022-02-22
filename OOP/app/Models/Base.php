<?php 



class Base
{
    private $servername = "localhost";
    private $username = "Amine";
    private $password = "teste123";
    private $database = "patients";
    private $conn;


    public function __construct()
    {
        try{
            $this->conn = new PDO("mysql:host=$this->servername;dbname=movies",$this->username, $this->password);
        }
        catch(PDOException $e){ 
            echo "Connection false : ".$e->getMessage();
        }
        
    }

    public function insert($table, $tableColone, $tableVal )
    {      
        

        $names = implode(",",$tableColone);
        $values = implode(",",$tableVal);

        $str = "INSERT INTO `$table`($names)VALUES($values)";
        $query = $this->conn->prepare($str);
        $query->execute();
    }



    public function selectAll($table)
    {
        $str = "SELECT * FROM $table";
        $query  = $this->conn->prepare($str);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }



    public function update($table, $tableColone, $tableVal,$id){
        $separator ="";
        $names ="";
        for ($i=0; $i <count($tableColone) ; $i++) { 
            if($i > 0)
            {
                $separator = ",";
            }
            $names .= $separator.$tableColone[$i]."=". "'$tableVal[$i]'"; 
        }
        $str = "UPDATE $table SET $names WHERE id = $id";
        $query = $this->conn->prepare($str);
        $query->execute();
    }



    public function delete($table, $id)
    {
        $str = "DELETE FROM $table WHERE id = $id";
        $query = $this->conn->prepare($str);
        $query->execute();
    }

    public function join($id)
    {
        $str = "SELECT posts.img_src, posts.description FROM users LEFT JOIN posts ON posts.id_creator = user.id ";
        $query  = $this->conn->prepare($str);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    


}








?>