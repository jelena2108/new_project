<?php 
class IfAdmin{
    var $admin;
    public function admin_check(){
        global $conn;
        global $user_name;
       
        $this->admin=$conn->real_query("SELECT users.admin FROM users WHERE username='$user_name'");
        $result=$conn->store_result();
        foreach($result as $row){
            $this->admin=$row['admin'];
        }
        if($this->admin==='0'){
       // die(header('Location:../notice.php'));
            echo "<script>window.location.replace('../notice.php')</script>";
        }
    }
    
}
$if_admin=new IfAdmin();
?>