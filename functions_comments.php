<?php  class Comment{
    var $comment;
    var $news_id;
    var $user_id;
    var $username;
    var $query;
    var $com;
    var $coment;
    var $approved=0;
    var $user;
  
    public function insertComment(){
        global $conn;
        global $user_name;
        
        
        $this->approved=0;
        if(isset($_POST['comment'])){
        $this->comment=mysqli_real_escape_string($conn,$_POST['comment']);
       
        }
        if(isset($_GET['p_id'])){
        $this->news_id=$_GET['p_id'];
             
        }

        $this->username= $user_name;
        $this->user_id=$_SESSION['user_id'];
   
        
        if(isset($_POST['post_comment']) && $_POST['comment'] !=""){
            
     $this->query=$conn->real_query("INSERT INTO comments (comment,comment_time,post_id,user_id,comment_approved) VALUES ('$this->comment',CURRENT_TIMESTAMP,'$this->news_id','$this->user_id','$this->approved')"); 
        if(!$this->query){
            echo $conn->error;
        }else{
            echo "inserted";
        }
        }
    }
    public function displayComments(){
        global $conn;
        global $user_name;
        
        if(isset($_GET['category']) && isset($_GET['p_id'])){
        $this->category=$_GET['category'];
     
        $this->p_id=$_GET['p_id'];
        
        $this->query=$conn->real_query("SELECT users.username,comments.id,comments.comment_time,comments.comment,categories.category,comments.post_id FROM comments JOIN users ON users.id=comments.user_id JOIN posts ON posts.id=comments.post_id JOIN categories ON categories.id=posts.category_id WHERE category='$this->category' AND post_id=$this->p_id AND comment_approved='1' ORDER BY time DESC");
         $result=$conn->store_result();
        foreach($result as $row){
            printf("<div class='komentar'><p>Comment by %s</p><p>%s</p><div class='comment_display'><p>%s</p></div></div>",$row['username'],$row['comment_time'],$row['comment']);
            $this->com=$row['id'];
             echo "<a href='news.php?id=$this->com'>Delete</a>";
    }
        }
}
    
    
    public function delete_comment(){
        global $conn;
        global $user_name;
        if(isset($_GET['id'])){
        $this->coment=$_GET['id'];}
       $this->user=$conn->real_query("SELECT users.username FROM comments JOIN users ON users.id=comments.user_id JOIN posts ON posts.id=comments.post_id JOIN categories ON categories.id=posts.category_id WHERE comments.id='$this->coment'");
        $result=$conn->store_result();
        foreach($result as $user){
            $this->user=$user['username'];
        }
        
        if(isset($_GET['id'])){
            
        if($user_name===$this->user){
           
         //   $this->coment=$_GET['id'];
            $this->query=$conn->real_query("DELETE  FROM comments WHERE comments.id='$this->coment'");
            header('Location:news.php');
        }else{ 
            echo "You are not allowed to delete this comment";
           
        }
    }
            if(!$this->query){
            echo $conn->error;
            }
        
    }
}
    
$comm=new Comment(); 
?>