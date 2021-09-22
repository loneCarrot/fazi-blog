<?php
namespace config;
use PDO;

class Database
{
    private $db_host="127.0.0.1";
    private $username="root";
    private $password="";
    private $db_name="fazekasb_blog";

    public function connect(){
        $pdo_connect=null;
        try {
            $pdo_connect = new PDO("mysql:host=".$this->db_host.";dbname=".$this->db_name, $this->username, $this->password);
            $pdo_connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection Error: ".$e->getMessage();
        }

        return $pdo_connect;
    }
}
