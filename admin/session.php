<?php session_start();
if(isset($_SESSION['user_logged'])){
  //  echo $_SESSION['user_id'];
    echo "Hello " . $_SESSION['username'];
   }else{
    echo "You are not authorized. Please <a href='../login.php'</a>login!";
    return;
}
?>