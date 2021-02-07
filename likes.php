<?php session_start();
if(isset($_SESSION['user_logged'])){
  //  echo $_SESSION['user_id'];
    echo "Hello " . $_SESSION['username'];
   }else{
    echo "You are not authorized. Please <a href='login.php'</a>login!";
    return;
}
?>
<?php echo "<p><a href='logout.php'>Logout</p>"; ?>
<?php include "db.php"; ?>

<?php 

if(isset($_GET['p_id'])){
    $p_id=$_GET['p_id'];
    $conn->real_query("SELECT id FROM posts WHERE id=$p_id"); 
     $res=$conn->store_result();
     foreach($res as $row){
         $post=$row['id'];
     }
    if($post){
       //  session_start();
        $_SESSION['p_id']=$post;
      //  echo $post;
    }
}

$user_name= $_SESSION['username'];
$userId=$_SESSION['user_id'];

if(isset($_GET['p_id'])){
$post_id=$_SESSION['p_id'];
}



class Likes {
    var $like;
    var $p_id;
    var $user_id;
    var $query;
    
    public function insert_like(){
        global $conn;
        global $userId;
        global $post_id;
        
if(isset($_GET['like']) && ($_GET['p_id']) && ($_GET['user_id']) ){
    $this->like=$_GET['like'];
   
    
    if($userId==$_GET['user_id']){
        $this->user_id=$userId;
       
    }
    if($post_id==$_GET['p_id']){
        $this->p_id=$post_id;
       
    }
    
    
    $this->like=mysqli_real_escape_string($conn, $this->like);
    $this->p_id=mysqli_real_escape_string($conn, $this->p_id);
    $this->user_id=mysqli_real_escape_string($conn, $this->user_id);
    
    if($this->like !="" && $this->p_id !="" && $this->user_id !=""){
    $this->query=$conn->real_query("INSERT INTO likes (likes,id_user,id_post) VALUES ($this->like,$this->user_id,$this->p_id)");
    }
    if($this->query){
       // echo "inserted";
        header("Location:news.php?p_id=$this->p_id");
    }else {
        echo $conn->error;
    }
}
}
    
    
     
    
}
$new_like=new Likes();
$new_like->insert_like();

?>