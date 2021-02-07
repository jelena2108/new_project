<?php include "../db.php"; ?>


<?php 

class ApproveComment{
    var $query;
    public function approve_comm(){
        global $conn;
        if(isset($_GET['category'])){
            $this->category=$_GET['category'];
        }
        if(isset($_GET['p_id'])){
            $this->post=$_GET['p_id'];
        }
        if(isset($_GET['comment_id'])){
            $this->comment=$_GET['comment_id'];
        }
        if(isset($_GET['approved']) && $_GET['approved']=1){
         $this->query=$conn->real_query("UPDATE comments SET comment_approved=1 WHERE  id='$this->comment'");
            
        }
        if(!$this->query){
            echo $conn->error;
        }
    }
}
$approve_comment=new ApproveComment();

?>