<?php

session_start();
include("../connectDB.php");

$email = input($_POST["email"]);
$password = input($_POST["password"]);
$userName = input($_POST["userName"]);
$phone = input($_POST["phone"]);

if(empty($email) || empty($password) || empty($userName) || empty($phone)){
  echo "輸入資料不完整";
}else{
  $sql = "SELECT * FROM `member` WHERE `email` = '$email'";
  $result = $conn->query($sql);
  
  if($result->num_rows){
    echo "Email已被註冊過";
  }else{
    $sql_insert = "INSERT INTO `member` VALUES (NULL, '$email', '$password', '$userName', '$phone')";
    if($conn->query($sql_insert)){

      //id寫入SESSION
      $sql_retrieveId = "SELECT `id` FROM `member` WHERE `email` = '$email'";
      $row = $conn->query($sql_retrieveId)->fetch_assoc();
      $id = $row["id"];
      $_SESSION["member_id"] = $id;

      // Redirect to homepage
      $host  = $_SERVER['HTTP_HOST'];
      $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
      $extra = '../../index.html';
      header("Location: http://$host$uri/$extra");
      exit();
      echo "註冊成功";
    }else{
      echo "Error: ".$conn->error;
    }
  }
}

function input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>