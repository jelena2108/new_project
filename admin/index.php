<?php include "session.php"; ?>
<?php echo "<br><a href='../logout.php'>Logout</a>"; ?>
<?php include "../db.php"; ?>
<?php include "../functions.php"; ?>
<?php include "functions.php"; ?>
<?php $user_name= $_SESSION['username']; ?>


<?php if(!isset($_SESSION['username'])){
header('Location:../home');
}
?>
<?php $if_admin->admin_check(); ?>
<?php
class News{
   
    var $title;
    var $text;
    var $cat_id;
    var $query;
    var $user;
    var $author;
    
 public function insert_news(){
      global $conn;  
      global $user_name;
     
    
  if(isset($_POST['submit'])){
        
    
    $this->title=trim($_POST['title']); 
    $this->text=trim($_POST['text']);  
    $this->author=$user_name;
    
   $this->title=mysqli_real_escape_string($conn,$this->title);     
   $this->text=mysqli_real_escape_string($conn,$this->text);   
  
      
   $this->cat_id=$_POST['category'];
    if(isset($_POST['title']) && $_POST['title'] !="" && isset($_POST['text']) && $_POST['text'] !=""  && 
      isset($_POST['category']) && $_POST['category'] > 0){    
        
    $this->query=$conn->real_query("INSERT INTO posts(title,content,time,author,post_approved,category_id) VALUES ('$this->title','$this->text',CURRENT_TIME,'$this->author','0','$this->cat_id') ");
        if(!$this->query){
            echo $conn->error;
        }else{
             echo "Post inserted";
        //   $last_id = $conn->insert_id;
         /*    echo "New record created successfully. Last inserted ID is: " . $last_id."<br>"; */
            
        }
        }else{
        echo "All fields must be filled in!";
    }
       }
    }
}
$news=new News();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <link href="admin_style.css" rel="stylesheet" type="text/css">
       <link rel="shortcut icon" href="favicon-16x16.png">
      
       <title>
           News
       </title>
        </head>
        <body>
             <div class="wrapper">
    <header>
               <img src="news-logo.png" class="logo">
     
    </header>
<main>
        
</main>

<aside class="admin">
    <p class="nav"><a href="categories.php">Categories</a></p>
    <p class="nav"><a href="posts.php">Posts</a></p>
    <p class="nav"><a href="comments.php">Comments</a></p>
    <p class="nav"><a href="users.php">Users</a></p>
      
</aside>
<footer>
        <a href="../news.php">Home</a>
        
</footer>
            </div>
</body>
</html>
    
