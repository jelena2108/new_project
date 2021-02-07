<?php include "session.php"; ?>
<?php echo "<br><a href='../logout.php'>Logout</a>"; ?>
<?php include "../db.php"; ?>
<?php include "../functions.php"; ?>
<?php include "functions.php"; ?>

<?php $user_name= $_SESSION['username'];?>

<?php if(!isset($_SESSION['username'])){
header('Location:../home');
} ?>
<?php $if_admin->admin_check(); ?>






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

<main class="users">
  
   <table class="table_users">
   <thead>
   <tr>
   <th>Id</th>
   <th>First Name</th>
   <th>Last Name</th>
   <th>Email</th>
   <th>Username</th>
   <th>Password</th>
   <th>Admin</th>
   <th>Subscriber</th><th>User_visitor</th>
   <th>Delete_user</th>
   </tr>
   </thead>
   <tbody>
    <?php 

class UsersTable{
    var $query;
    public function usersDisplay(){
        global $conn;
        $this->query=$conn->real_query("SELECT * FROM users");
        $result=$conn->store_result();
        foreach($result as $row){
  
        printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td><a href=''>%s</a></td><td><a href='user_role.php?subscriber=%s&admins=%s'>%s</a></td><td><a href='user_role.php?id=%s&admin=%s'>%s</a></td><td><a href='delete_user.php?id=%s'>%s</a></td></tr>",$row['id'],$row['first_name'],$row['last_name'],$row['email'],$row['username'],$row['password'],$row['admin'],$row['id'],$row['admin'],$row['subscriber'],$row['id'],$row['admin'],$row['user_visitor'],$row['id'],$row['delete_user']);
        }
        
    }
    
}
$users=new UsersTable();
$users->usersDisplay();
       
       

       
       
?>
       </tbody>
    </table>
     
</main>

 <aside class="admin">
    <p class="nav"><a href="categories.php">Categories</a></p>
    <p class="nav"><a href="posts.php">Posts</a></p>
    <p class="nav"><a href="comments.php">Comments</a></p>   <p class="nav"><a href="users.php">Users</a></p> 

</aside>

<footer>
    <a href="../news.php">Home</a>
        
</footer>
            </div>
            
         
            
            
</body>
</html>
    
