<?php include "db.php"; ?>
<?php

class User {
    var $firstName;
    var $lastName;
    var $email;
    var $username;
    var $password;
    var $admin=0;
    var $subscriber=0;
    var $user_visitor=1;
    var $user;
    var $query;
    var $e_mail;
    var $delete_user;
    public function register(){
    global $conn;

if(isset($_POST['firstName'])&& isset($_POST['lastName']) && isset($_POST['username'])&&
isset($_POST['email'])&&   
isset($_POST['password'])){
        if(isset($_POST['firstName'])&&
            $_POST['firstName'] !=""){
        $_POST['firstName']=filter_var($_POST['firstName'],FILTER_SANITIZE_STRING);
            if($_POST['firstName']==""){
                echo "<p>Not a valid first name!</p>";
                return;
            }else{ 
                $this->firstName=$_POST['firstName'];
                }
        }else{
            echo "<p>All fields must be filled in</p><br>";
            return;
        }
    }

if(isset($_POST['firstName'])&& isset($_POST['lastName']) && isset($_POST['username'])&&
   isset($_POST['email'])&&
   isset($_POST['password'])){
        if(isset($_POST['lastName'])&&
            $_POST['lastName'] !=""){
            $_POST['lastName']=filter_var($_POST['lastName'],FILTER_SANITIZE_STRING);
            if($_POST['lastName']==""){
                echo "<p>Not a valid last name!</p>";
                return;
            }else{ 
                $this->lastName=$_POST['lastName'];
                }
        }else{
            echo "<p>All fields must be filled in</p><br>";
            return;
        }
    }


if(isset($_POST['firstName'])&& isset($_POST['lastName']) && isset($_POST['username'])&&
   isset($_POST['email'])&&
   isset($_POST['password'])){
        if(isset($_POST['username'])&&
            $_POST['username'] !=""){
            $_POST['username']=filter_var($_POST['username'],FILTER_SANITIZE_STRING);
            if($_POST['username']==""){
                echo "<p>Not a valid username!</p>";
                return;
            }else{ 
                $this->username=$_POST['username'];
                }
        }else{
            echo "<p>All fields must be filled in</p><br>";
            return;
        }
    }

 
if(isset($_POST['firstName'])&& isset($_POST['lastName']) && isset($_POST['username'])&&
   isset($_POST['email'])&&
   isset($_POST['password'])){
        if(isset($_POST['email'])&&
            $_POST['email'] !=""){
            $_POST['email']=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
            if($_POST['email']==""){
                echo "<p>Not a valid email!</p>";
                return;
            }else{ 
                $this->email=$_POST['email'];
                }
        }else{
            echo "<p>All fields must be filled in</p><br>";
            return;
        }
    }       
        
        
        
        

if(isset($_POST['firstName'])&& isset($_POST['lastName']) && isset($_POST['username'])&&
   isset($_POST['email'])&&
   isset($_POST['password'])){
        if(isset($_POST['password'])&& $_POST['password'] !=""){
$_POST['password']=filter_var($_POST['password'],FILTER_SANITIZE_STRING);
            if($_POST['password']=="" || strlen($_POST['password'])<3){
                echo "<p>Not a valid password!</p>";
                return;
            }else{ 
                $this->password=$_POST['password'];
                }
        }else{
            echo "<p>All fields must be filled in</p><br>";
            return;
        }
    }


if(isset($_POST['submit'])){
    $firstName=mysqli_real_escape_string($conn,$this->firstName);
   $lastName=mysqli_real_escape_string($conn,$this->lastName);
    
   $email=mysqli_real_escape_string($conn,$this->email);
   $username=mysqli_real_escape_string($conn,$this->username);

    $password=mysqli_real_escape_string($conn,$this->password);
   
   

if($stmt=$conn->prepare("INSERT INTO users VALUES (null,?,?,?,?,?,?,?,?,?)")){
    $this->firstName=$_POST['firstName'];
    $this->lastName=$_POST['lastName'];
    $this->username=$_POST['username'];
    
    $this->password=md5($_POST['password']);
    
    $this->delete_user="delete";
    
    $this->query=$conn->real_query("SELECT username,email FROM users");
    $result=$conn->store_result();
    foreach($result as $row){
        $this->user=$row['username'];
        $this->e_mail=$row['email'];
    
    if($this->username !== $this->user){
        $this->username=$_POST['username'];
    }else{
        echo "Username is already in use!Try again!";
       return;
    }
      if($this->email !== $this->e_mail){
        $this->email=$_POST['email'];
    }else{
        echo "Email is already in use!";
       return;
    }  
    }
    
    // $this->password=$_POST['password'];
    
    
    $stmt->bind_param("sssssiiis", $this->firstName, $this->lastName,$this->email,$this->username,  $this->password,$this->admin,$this->subscriber,$this->user_visitor,$this->delete_user);
    $stmt->execute();
    $stmt->close();
    
    echo "Registration is successfull. Please,<a href='login.php'>Login</a>";

}else{
       //echo $conn->error; 
        echo "Registration failed!";
    }


  $conn->close();  
    }

  }
}


    $reg=new User();
    $reg->register();
   
?>

<!DOCTYPE html>
<html lang="en">
    <head>
       <meta charset="UTF-8">
       <link href="style.css" rel="stylesheet" type="text/css">
        <link rel="shortcut icon" href="favicon-16x16.png">
       <title>
           News
       </title>
    </head>
    <body>
       <div class="wrapper">
        <header>
          <img src="news-logo.png" alt="news" class="logo">
      </header> 
      
         <main class="index">
          <h2 class="heading">Registration</h2>
           <form action="registration" method="POST" name="form"  id="form">
              
               <input type="text" onblur="validateText(this)" name="firstName" id="firstName" class="input" placeholder="First name" ><br>
               <input type="text" onblur="validateText(this)" name="lastName" id="lastName" class="input" placeholder="Last name" ><br>
                 <input type="email" onblur="validateText(this)" name="email" id="email" class="input" placeholder="Email" ><br>
               <input type="text" onblur="validateText(this)" name="username" id="username" class="input" placeholder="Username"><br>
              <input type="password" onblur="validateText(this)" name="password" id="password" class="input" placeholder="Password" ><br>
              <input type="submit" name="submit" value="REGISTER" class="input">                        
           </form>
            <a href="home">Back</a>
           <script>
               function validateText(f){
                   if(f.value==""){
                      f.style.borderColor="red";
                   
                      }else{
                          f.style.borderColor="";
                      }
               }
               
           </script>
           </main>
           <?php include "footer.php"; ?>
        </div>
        
    </body>
</html>