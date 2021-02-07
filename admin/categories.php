<?php include "session.php"; ?>
<?php echo "<br><a href='../logout.php'>Logout</a>"; ?>
<?php include "../db.php"; ?>
<?php include "../functions.php"; ?>
<?php include "functions.php"; ?>
<?php $user_name= $_SESSION['username']; ?>

<?php if(!isset($_SESSION['username'])){
header('Location:../home');
} ?>
<?php $if_admin->admin_check(); ?>
<?php

class InsertCategory{
    var $category;
    var $query;
    var $id;
    
    
    public function category_insert(){
        global $conn;
        if(isset($_POST['category']) && $_POST['category'] !=""){
            $this->category=$_POST['category'];
           $this->category=mysqli_real_escape_string($conn,$_POST['category']);
       $this->query=$conn->real_query("INSERT INTO categories (category) VALUES ('$this->category')");
            if(!$this->query){
            echo $conn->error;
        }else{
             echo "Category inserted";
        }
       
    }
}
    
    public function delete_category(){
        global $conn;
        if(isset($_POST['delete']) && isset($_POST['delete_category']) && ($_POST['delete_category'])>0){
          $this->id=$_POST['delete_category'];
           $this->query=$conn->real_query("DELETE FROM categories WHERE id=$this->id");
             if(!$this->query){
            echo $conn->error;
        }else{
             echo "Category deleted";
        }
        }
    }
    
    
    public function view_categories(){
         global $conn; 
       $this->category=$conn->real_query("SELECT category FROM categories");
         $result=$conn->store_result();
         foreach($result as $row){
            printf( "<li><a href='../news.php?category=%s'>%s</a></li>",$row['category'],$row['category']); 
                
        }
    }
    
    
    
    
}
$newCategory=new InsertCategory();

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
        <h1>Categories</h1>
        <h3 class="categories">Insert category</h3>
        <form action="" method="POST">
     
           <label for="category">Category:</label><br>
            <input class="input" type="text" name="category" id="category">
           <br>
            <br> 
            <input type="submit" class="input" name="submit" value="Insert"> 
         
        </form>
        
        
        <?php   $newCategory->category_insert(); ?>
        
        
         <h3 class="categories">Delete category</h3>
        <form action="" method="POST">
     
        <select class ="input" name="delete_category" id="delete_category">
        <option value="-1">Select</option>
       <?php   $categ->select_category();
         ?>  
          </select>
          
          
          
           <br>
            <br> 
            <input type="submit" onclick="category_delete()" class="input" name="delete" value="Delete"> 
         
        </form>
        
     <?php $newCategory->delete_category();?>
     
     
     <h3 class="categories">View categories</h3>
<!--   <?php  $categ->categories(); ?> -->
      <?php $newCategory->view_categories();?>
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
            
            
 <script>
            
   function category_delete(){
       alert("Are you sure you want to delete this category?");
   }        
            
</script>          
            

</body>
</html>
    
