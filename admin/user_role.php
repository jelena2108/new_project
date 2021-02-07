<?php include "../db.php"; ?>


<?php
class UserRole{
    var $query;
    var $id;
    var $subscriber;
    public function role_change(){
        global $conn;
        
        if(isset($_GET['id']) ){
        $this->id=$_GET['id'];
       
   
        $this->query=$conn->real_query("UPDATE users SET user_visitor=0,subscriber=1 WHERE id=$this->id");
        $result=$conn->store_result();
            header("Location:users.php");
        
    }
        
    }
    
     public function roleChange(){
        global $conn;
        if(isset($_GET['subscriber'])){
        $this->id=$_GET['subscriber'];
            
       
         $this->subscriber=$conn->real_query("SELECT subscriber FROM users WHERE id=$this->id");    $result=$conn->store_result();
            
       if($this->subscriber==1){
        
        $this->query=$conn->real_query("UPDATE users SET subscriber=0,user_visitor=1 WHERE id=$this->id");
        $result=$conn->store_result();
            header("Location:users.php");
       }
    }
        
    }
    
    
    
    
    
}
$role=new UserRole();

$admin=0;
if(isset($_GET['admin']) && $_GET['admin']==$admin){
$role->role_change();
}else{
    header("Location:users.php");
}

if(isset($_GET['admins']) && $_GET['admins']==$admin){
 $role->roleChange();
}else{
    header("Location:users.php");
}
?>