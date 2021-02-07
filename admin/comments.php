<?php include "session.php"; ?>
<?php echo "<br><a href='../logout.php'>Logout</a>"; ?>
<?php include "../db.php"; ?>
<?php include "../functions.php"; ?>
<?php include "functions.php"; ?>
<?php include "approve.php"; ?>
<?php $user_name= $_SESSION['username']; ?>

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
        
    
    $this->title=$_POST['title']; 
    $this->text=$_POST['text'];  
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
     <h1>Comments</h1>
     
      <?php          
class View_all_comments{
    var $query;
    var $id;
    var $approved;
    var $comment_id;
    var $comment;
     public function viewComments(){
        global $conn;
        $this->query=$conn->real_query("SELECT users.username,comments.comment_time,comments.comment,comments.id,comments.post_id,comments.comment_approved,posts.title,posts.content,categories.category FROM comments JOIN users ON users.id=comments.user_id JOIN posts ON posts.id=comments.post_id JOIN categories ON categories.id=posts.category_id ORDER BY comment_time DESC");
        $result=$conn->store_result();
        foreach($result as $row){
            printf("<div class='komentar'><h3>Category: %s</h3><h4>%s</h4><p>%s</p><p>Comment by %s</p><p>%s</p><div class='comment_display'><p>%s</p></div></div>",$row['category'],$row['title'],$row['content'],$row['username'],$row['comment_time'],$row['comment']);
            
          $this->id=$row['id'];
          $this->category=$row['category'];
          $this->post=$row['post_id'];
          $this->approved=$row['comment_approved']; 
           
            echo "<a href='comments.php?category=$this->category&p_id=$this->post&comment_id=$this->id&approved=1'>Approve</a>"." ";
            echo "<a href='comments.php?id=$this->id'>Delete</a>";
            
       if($this->approved==1){
           echo " Approved";
      
       }
 
          
        }
    
    }

  
    public function deleteComment(){
       global $conn;
       if(isset($_GET['id'])){
       $this->delete=$_GET['id'];
           
        
       $this->query=$conn->real_query("DELETE FROM comments WHERE comments.id= $this->delete");
     // header('Location:comments.php');
        }
       if(!$this->query){
           echo $conn->error;
           
       }
       
       }
    
 
}
$view_comments=new View_all_comments(); 

$view_comments->viewComments();

$view_comments->deleteComment();
$approve_comment->approve_comm(); 

  ?>

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
    
