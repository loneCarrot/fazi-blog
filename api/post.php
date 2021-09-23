<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, PUT, PATCH, GET, DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once "../config/Database.php";
require_once "../Classes/Post.class.php";

$db=new config\Database;
$posts = new Classes\Post;
$conn=$db->connect();


//listing all post
if ($_SERVER['REQUEST_METHOD']=="GET") {
  if (isset($_GET['posts'])) {
    $read = $posts->read($conn);

  
    if (($read->rowCount())>0) {
      $post_array=array();
      $post_array['data']=array();
    
      while($row=$read->fetch(PDO::FETCH_ASSOC)){
        $post_item=array(
          'id'=>$row['p_id'],
          'title'=>$row['p_title'],
          'content'=>$row['p_content'],
          'thumbnail'=>$row['p_thumbnail'],
          'createAt'=>$row['p_createdAt']
        );
    
        array_push($post_array['data'],$post_item);
      }
      echo json_encode($post_array);
    }else{
      echo json_encode(array(
        'message'=>"No post found!"
      ));
    }
  }
}


//create a new blog post
if ($_SERVER['REQUEST_METHOD']=="POST") {
  $data=json_decode(file_get_contents("php://input"));

  $posts->title=strip_tags(html_entity_decode($data->title));
  $posts->content=strip_tags(html_entity_decode($data->content));
  $posts->thumbnail=strip_tags(html_entity_decode($data->thumbnail));

  if ($posts->create($conn)) {
    echo json_encode(array(
      "message"=>"Post created!"
    ));
  }else{
    echo json_encode(array(
      "message"=>"Post not created!"
    ));
  }
}

//edit a blog post
if ($_SERVER['REQUEST_METHOD']=="PUT") {
    $data=json_decode(file_get_contents("php://input"));
    $posts->id=$data->id;
    $posts->title=$data->title;
    $posts->content=$data->content;
    $posts->thumbnail=$data->thumbnail;

    if ($posts->edit($conn)) {
      echo json_encode(array(
        "message"=>"Post Edited!"
      ));
    }else{
      echo json_encode(array(
        "message"=>"Post not edited!"
      ));
    }
}

//delete a blog post
if ($_SERVER['REQUEST_METHOD']=="DELETE") {
  $data=json_decode(file_get_contents("php://input"));

  $posts->id=$data->id;

  if ($posts->remove($conn)) {
    echo json_encode(array(
      "message"=>"Post removed!"
    ));
  }else{
    echo json_encode(array(
      "message"=>"Post not removed!"
    ));
  }
}


