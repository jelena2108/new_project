<?php include"db.php"; ?>




<?php
  class SingleNews {
    var $post;
    public function single_news(){
        global $conn;
      
       
       
        
        
        if(isset($_GET['p_id'])){
      $this->post=$_GET['p_id'];
       
      $this->query=$conn->real_query("SELECT posts.title,posts.author,posts.time,posts.content,categories.category FROM posts JOIN categories ON categories.id=posts.category_id WHERE posts.id='$this->post'");
         
        $result=$conn->store_result();
    foreach($result as $row){
        
        printf("<h1>%s</h1><h5>Category:%s</h5><h5>Author: %s</h5><h5>Posted: %s</h5><p>%s</p>",$row['title'],$row['category'],$row['author'],$row['time'],$row['content']);
        
    /*    echo "<p><a href=''>Unlike</a></p>";
       */
       
       
    /* <p><a href="likes.php?like=1&p_id=<?php echo $_GET['p_id']; ?>&user_id=">Like</a></p> 
     */   
        
        
      
        $conn->real_query("SELECT * FROM likes JOIN posts ON posts.id=likes.id_post WHERE id_post=$this->post"); 
  $res=$conn->store_result();
        $this->num_likes=mysqli_num_rows($res);
      echo "Likes: ".$this->num_likes;
        
        
        
        
        
     ?> 
<form method="POST" action="">
    <textarea type="text" name="comment" class=" search" id="comment" placeholder="Your comment"></textarea>
    <br>
    <input type="submit" class="search" name="post_comment" value="Post Comment">
 
    </form>
          <?php       
    
}
    }
}
}
$single_news_display=new SingleNews();
 
$single_news_display->single_news(); 


class DisplayComment{
    var $approved;
    var $post_title;
    public function viewComment(){
        global $conn;
        
        if(isset($_GET['approved'])){
        $this->approved=$_GET['approved'];
        $this->post=$_GET['p_id'];
        $this->query=$conn->real_query("SELECT users.username,comments.time,comments.comment,comments.id,comments.post_id,categories.category FROM comments JOIN users ON users.id=comments.user_id JOIN posts ON posts.id=comments.post_id JOIN categories ON categories.id=posts.category_id WHERE comments.id='$this->approved' AND post_id='$this->post'");
        $result=$conn->store_result();
        foreach($result as $row){
            printf("<div class='komentar'><p>Comment by %s</p><p>%s</p><div class='comment_display'><p>%s</p></div></div>",$row['username'],$row['time'],$row['comment']);
          
           
        }
          
        }
      
    }
    
}
$display_comm=new DisplayComment();
?>  
  <?php $display_comm->viewComment(); ?>    
          
     

      
    