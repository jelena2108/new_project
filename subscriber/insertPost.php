<?php session_start();
if(isset($_SESSION['user_logged'])){
  //  echo $_SESSION['user_id'];
    echo "Hello " . $_SESSION['username'];
   }else{
    echo "You are not authorized. Please <a href='../login.php'</a>login!";
    return;
}
?>
<?php 
echo "<br><a href='../logout.php'>Logout</a>"; 
?>
<?php include "../db.php"; ?>
<?php include "../functions.php"; ?>
<?php include "subscriberCheck.php"; ?>
<?php $user_name= $_SESSION['username']; 
?>


<?php if(!isset($_SESSION['username'])){
header('Location:../home');
}
?>
<?php 
$if_subs->subscriber_check();
?>

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
        
    if(isset($_POST['title'])){
    $this->title=$_POST['title'];
    }
      if(isset($_POST['text'])){
    $this->text=$_POST['text']; 
      }
    $this->author=$user_name;
    
   $this->title=mysqli_real_escape_string($conn,$this->title);     
   $this->text=mysqli_real_escape_string($conn,$this->text);   
  
    if(isset($_POST['category'])){  
   $this->cat_id=$_POST['category'];
    }
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
       <link href="../style.css" rel="stylesheet" type="text/css">
       <link rel="shortcut icon" href="favicon-16x16.png">
       
       <title>
           News
       </title>
</head>
<body>
    <div class="wrapper">
              
<header>
    <img src="../news-logo.png" class="logo">
     
</header>
<main>
   
    <div class="log">
    <h1>Posts</h1>
    <h3>Insert post</h3>
    <form action="" method="POST">
        <!--  <label for="author">Author:</label><br>
            <input class="input" type="text" name="author" id="author">
           <br>
            <br>-->
        <label for="title">Title:</label><br>
        <input class="input" type="text" name="title" id="title">
        <br>
        <br>  
         <label for="text">Text:</label><br>
        <textarea class ="input" name="text" id="text"></textarea>
        <br> 
        <br>
        <label for="category">Category:</label><br>      
        <select class="input" name="category">
        <option value="-1">-----</option>
        <?php $categ->select_category(); ?>
        </select><br>
            <br>
            <br>
        <input class="input" type="submit" value="Insert" name="submit">
    </form>
<?php $news->insert_news(); ?>
       
        </div>
      
</main>


<footer>
    <a href="../news.php">Home</a>
       <p>Copyright &copy;News</p>
        
</footer>
            </div>
    </body>
</html>
    


