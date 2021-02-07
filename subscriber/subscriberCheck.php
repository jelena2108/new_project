<?php 
class IfSubscriber{
    var $subscriber;
    public function subscriber_check(){
        global $conn;
        global $user_name;
    
        $this->query=$conn->real_query("SELECT users.subscriber FROM users WHERE username='$user_name'");
        $result=$conn->store_result();
        foreach($result as $row){
            $this->subscriber=$row['subscriber'];
        }
        // echo $this->subscriber;
        if($this->subscriber=='0'){
        // die(header('Location:../notice1.php'));
        echo "<script>window.location.replace('../notice1.php')</script>";    
        }
    }
    
}
$if_subs=new IfSubscriber();
?>