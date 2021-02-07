<?php include "../db.php"; ?>

<?php 

class DeleteUser{
        var $query;
        var $id;
    public function user_delete(){
        global $conn;
        if(isset($_GET['id'])){
            $this->id=$_GET['id'];
            $this->query=$conn->real_query("DELETE FROM users WHERE id=$this->id");
            header("Location:users.php");
            
        }
       if(!$this->query){
            echo $conn->error;
        }
    }
    
}
$deleteUser=new DeleteUser();
$deleteUser->user_delete();
?>