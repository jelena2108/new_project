<?php 
session_start();
if(isset($_SESSION['user_logged'])){
    
 // echo $_SESSION['user_id'];
    
    echo "Hello " .$_SESSION['username'];
   }else{
    echo "You are not authorized. Please <a href='login'</a>login!";
    return;
}

?> 

<?php  echo "<br><a href='logout.php'>Logout</a>" ?>


<?php include "header.php"; ?>
<?php include "functions_comments.php";?>
<?php include "latest_news.php"; ?> 
 <!--  <main> -->
            
            
            
<?php 
$user_name= $_SESSION['username']; 
// echo $user_name;

 class NewsDisplay{
    var $query;
    var $category;
    var $p_id;
    var $num_likes;
     
    var $post_approved;
     
     
     public function news(){
        global $conn;
        global $user_name;
        
        $this->username= $user_name;
        $this->user_id=$_SESSION['user_id'];
        
    if(isset($_GET['category'])) {  
    
    $this->category=$_GET['category']; 
           
    
    $this->query=$conn->real_query("SELECT posts.id,title,author,time,content,post_approved,categories.category FROM posts JOIN categories ON categories.id=posts.category_id WHERE category='$this->category' ORDER BY time DESC");
    $result=$conn->store_result();
  
      foreach($result as $row){
          
         $this->post_approved=$row['post_approved'];
          if($this->post_approved=='1'){
          
          
        printf("<h1><a href='news.php?category=%s&p_id=%s'>%s</a></h1><h5>Category: %s</h5><h5>Author: %s</h5><h5>Posted: %s</h5><p>%s</p>",$row['category'],$row['id'],$row['title'],$row['category'],$row['author'],$row['time'],$row['content']); 
   
          
 printf("<p><a href='likes.php?like=%s&p_id=%s&user_id=%s'>Like<a/></p>",'1',$row['id'],$this->user_id);
          
          }
          
        ?>
     
          
<?php
            }
            
            }
        }
     
     
     
     
}
$news_display=new NewsDisplay();
?>

<!-- <div class="wrapper"> -->
<main>
       
    <div class="log">  
              
    <div class="news_display">
   
<?php 
    if(!isset($_GET['p_id'])){
       $news_display->news(); 
    
      }else{
     
      include "single_news.php";
    } 
         
?>
 
    </div> 
       
        </div>         
     

         
<?php  
$comm->insertComment();
$comm->displayComments();          
$comm->delete_comment();           
            
?> 
    
                                       
</main>       
<aside>  
                <form action="" method="POST">     
                     <input  type="text" name="search_field" placeholder="Search title...">
                     <input type="submit" name="search" value="Search">
                 </form>
    <?php 
class Search{
    var $search; 
    var $query;
    var $title;
        public function search_title(){
                global $conn;
            if(isset($_POST['search'])){
            if(isset($_POST['search_field']) && ($_POST['search_field'])!=""){
             $this->search=$_POST['search_field'];
            }
            $this->query=$conn->real_query("SELECT title,content FROM posts WHERE title LIKE '$this->search%' AND post_approved='1'");
                $result=$conn->store_result();
                foreach($result as $row){
                    $this->title=$row['title'];
                }
                if($this->title){
              //  print_r($this->title);
                    printf("<h1>%s</h1><p>%s</p>",$row['title'],$row['content']);
                }else{
                    echo "No result";
                }
        }
     }
    }
$search_object=new Search();
$search_object->search_title(); 
            ?>
             
              
            <h4>Categories</h4>
<?php $category_sidebar->categories_sidebar(); ?>
           
            <h4>Latest News</h4>
<?php $latest_news->the_latest_news(); ?>
        </aside>
      <?php include "footer.php"; ?>
       
     
        </div>
 </body>
</html>