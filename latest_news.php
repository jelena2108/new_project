<?php include "db.php"; ?>
<?php 
class LatestNews{
    var $last_id;
    var $user_id;
    
    
    public function the_latest_news(){
        global $conn;
        
       
        $this->query=$conn->real_query("SELECT posts.id,title,category FROM posts JOIN categories ON categories.id=posts.category_id ORDER BY posts.id DESC LIMIT 5");
         $result=$conn->store_result();
         foreach($result as $row){
              printf( "<li><a href='news.php?category=%s&p_id=%s'>%s</a></li>",$row['category'],$row['id'],$row['title']); 
             
         
             
        
        }
    }
    
}
$latest_news=new LatestNews();

?>