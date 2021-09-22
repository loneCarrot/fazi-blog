<?php
namespace Classes;

class User
{
    private $id;
    private $full_name;
    private $username;
    private $email;
    private $password;
    private $created_at;

    public function __set($property, $value){
        if (property_exists($this, $property)) {
            $this->$property=$value;
        }
    }

    public function __get($property){
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }


    public function insertUser($dbcon){

        $existing_user=$this->existingUserProcess($dbcon);

        if (($existing_user->rowCount()) < 1) {
            $password=$this->passwordHash();
            $date=gmdate("Y-m-d h:i:s");

            $query="INSERT INTO users SET full_name=:full_name, username=:username, email=:email, password=:password, created_at=:created_at";
            $stmt=$dbcon->prepare($query);
            $stmt->bindParam(":full_name", $this->full_name);
            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":created_at", $date);

            if ($stmt->execute()) {
                return true;
            }

            printf("Error: %s \n",$stmt->error);
        }

        return false;
    }

    public function existingUserProcess($dbcon){
        $query="SELECT * FROM users WHERE email=:email OR username= :username";
        $stmt=$dbcon->prepare($query);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":username", $this->username);
        $stmt->execute();

        return $stmt; 
    }

    public function loginUser($dbcon){
        $query="SELECT * FROM User WHERE email=:email AND password=:password OR username= :username AND password =: password";
        $stmt=$dbcon->prepare($query);
        $stmt->bindParam(":full_name", $this->full_name);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);

        $stmt->execute();
        
        $row=$stmt->fetch(PDO::FETCH_ASSOC);

        if (($stmt->rowCount())>0) {
            $this->id=$row['id'];
            $this->full_name=$row['full_name'];
            $this->username=$row['username'];
            $this->email=$row['email'];
            $this->password=$row['password'];
            $this->created_at=$row['created_at'];
        }
    }

    public function passwordHash(){
        $options=[
            'cost'=>12
        ];

        $password = password_hash($this->password, PASSWORD_BCRYPT, $options);

        return $password;
    }

}
