<?php

namespace Classes;

class Post
{
     private $id;
     private $title;
     private $content;
     private $created_at;
     private $thumbnail;
     private $user_id;


    public function __set($property, $value){
        if (property_exists($this, $property)) {
            $this->$property=$value;
        }
        
    }

    public function read($db){
        $query="SELECT 
                    id as p_id,
                    title as p_title,
                    content as p_content,
                    thumbnail as p_thumbnail,
                    created_at as p_createdAt
                FROM 
                    posts 
                ORDER BY posts.created_at DESC";

        $stmt=$db->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function create($db){

        $date=gmdate("Y-m-d h:i:s");
        $query='INSERT INTO Posts SET title= :title, content= :content,created_at= :created_at, thumbnail= :thumbnail';
        $stmt= $db->prepare($query);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':created_at', $date);
        $stmt->bindParam(':thumbnail', $this->thumbnail);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s \n", $stmt->error);
        return false;
    }

    public function edit($db){

        $query='UPDATE Posts SET title= :title, content= :content, thumbnail= :thumbnail WHERE id= :id';
        $stmt= $db->prepare($query);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':thumbnail', $this->thumbnail);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s \n", $stmt->error);
        return false;
    }

    public function remove($db){

        $query='DELETE FROM Posts WHERE id= :id';
        $stmt= $db->prepare($query);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s \n", $stmt->error);
        return false;
    }

}


