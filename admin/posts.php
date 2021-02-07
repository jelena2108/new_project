<?php include "session.php"; ?>
<?php echo "<br><a href='../logout.php'>Logout</a>"; ?>
<?php include "../db.php"; ?>
<?php include "../functions.php"; ?>
<?php include "functions.php"; ?>
<?php $user_name= $_SESSION['username'];?>

<?php if(!isset($_SESSION['username'])){
header('Location:../home');
} ?>
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

class Newsdisplay{
    var $id;
    var $query;
    var $category;
    var $delete;
    
    
    
    var $post_approve;
    
    
    
    public function allNews(){
        global $conn;
        
        if(isset($_POST['news']) && $_POST['news']>0){
       
        $this->category=$_POST['news'];
        $this->query=$conn->real_query("SELECT posts.id,author,time,title,content,post_approved,categories.category FROM posts JOIN categories ON categories.id=posts.category_id WHERE category_id= $this->category ORDER BY time DESC");
            $result=$conn->store_result();
           
            foreach($result as $row){
                
                
                printf("<h1>%s</h1><p>Category: %s</p><p>Author: %s</p><p>%s</p><p>%s</p>",$row['title'],$row['category'],$row['author'],$row['time'],$row['content']);
                $this->id=$row['id'];
                
                $this->post_approve=$row['post_approved'];
                
                echo "<a href='posts.php?delete=$this->id'>Delete post</a>";
                echo "<br><br>";
                echo "<a href='posts.php?post_approve=$this->id'>Approve post</a>";
                
                if($this->post_approve=='1'){
                    echo " Published";
                }
                
                
            }
           
    }
    
    }
    
   public function deleteNews(){
       global $conn;
       if(isset($_GET['delete'])){
       $this->delete=$_GET['delete'];
           
        
       $this->query=$conn->real_query("DELETE FROM posts WHERE posts.id=$this->delete");
        }
       
       if(!$this->query){
           echo $conn->error;
       }
       }
    
    
    public function approveNews(){
       global $conn;
       if(isset($_GET['post_approve'])){
       $this->post_approve=$_GET['post_approve'];
           
        
       $this->query=$conn->real_query("UPDATE posts SET posts.post_approved='1' WHERE posts.id=$this->post_approve");
           
        }
       
       if(!$this->query){
           echo $conn->error;
       }
       }
    
    
    
    
   }


$display_news=new Newsdisplay();

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
       
       <h3>View posts</h3>
       <form method="POST" action="">
       <label for="news">Select category:</label>
       <select name="news" id="news">
           <option value="-1">---</option>
          <?php $categ->select_category(); ?> 
          
       </select>
       <input type="submit" value="Submit" name="submit">
    </form>
    
 <?php $display_news->allNews(); ?>
 
 <?php $display_news->deleteNews(); ?>  
  
      
<?php $display_news->approveNews(); ?>
       
       
       
        </div>
</main>

<aside class="admin">
    <p class="nav"><a href="categories.php">Categories</a></p>
    <p class="nav"><a href="posts.php">Posts</a></p>
    <p class="nav"><a href="comments.php">Comments</a></p>   <p class="nav"><a href="users.php">Users</a></p> 

</aside>
<footer>
    <a href="../news.php">Home</a>
        
</footer>
            </div>
    </body>
</html>
    
