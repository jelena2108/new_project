<?php include "db.php"; ?>
<?php 
class Category {
    
    var $id;
    var $category;

   public function categories(){
       global $conn; 
       $this->category=$conn->real_query("SELECT category FROM categories");
         $result=$conn->store_result();
         foreach($result as $row){
            printf( "<li><a href='news.php?category=%s'>%s</a></li>",$row['category'],$row['category']); 
                
        }
    
    }
    
  
    public function all_categories(){
       global $conn; 
       $this->category=$conn->real_query("SELECT category FROM categories");
         $result=$conn->store_result();
         foreach($result as $row){
            printf( "<li><a href='news.php'>%s</a></li>",$row['category']); 
                
        }
    
    }
    
   
    public function select_category(){
        global $conn; 
       $this->category=$conn->real_query("SELECT id,category FROM categories");
         $result=$conn->store_result();
         foreach($result as $row){
              printf("<option value='%s'>%s</option>",$row['id'],$row['category']);
         }
    }
  
}
$categ=new Category();


 class Category_sidebar{
    var $category;
     public function categories_sidebar(){
       global $conn; 
       $this->category=$conn->real_query("SELECT category FROM categories");
         $result=$conn->store_result();
         foreach($result as $row){
              printf( "<li><a href='news.php?category=%s'>%s</a></li>",$row['category'],$row['category']); 
        
        }
    
    
    }
           }    
$category_sidebar=new Category_sidebar(); 









?>