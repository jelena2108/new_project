<?php include "db.php"; ?>
<?php
   class User {
    var $firstName;
    var $lastName;
    var $username;
    var $password;
    var $admin;
    var $user_id;  
       //Metod za logovanje korisnika
    
   public function logIn(){
        global $conn;
       
       
       if(isset($_POST['bt_submit']) && $_POST['userName'] !="" && $_POST['passWord'] !=""){
           $this->username=mysqli_real_escape_string($conn,$_POST['userName']);
            $this->password=mysqli_real_escape_string($conn,$_POST['passWord']); 
            $this->password=md5($_POST['passWord']); 
           
            $conn->real_query("SELECT * FROM users WHERE username='$this->username' AND password='$this->password'"); 
            
            $res=$conn->store_result();
            
           $korisnik=$res->fetch_object("User");
         
              if($korisnik){
                   
                   session_start();
                    $_SESSION['user_logged']=true;
                    $_SESSION['username']=$korisnik->username;
                    $_SESSION['admin']=$korisnik->admin;
                  
                    $_SESSION['user_id']=$korisnik->id;
                  
                    $this->admin= $_SESSION['admin'];
                //  echo $this->admin;
                  if($this->admin=='1'){
              header("Location:admin/index.php");
                  }else if($this->admin=='0'){
                      header("Location:news");
                  } 
                                
              }else{
                    echo "User does not exist";
        
                }
           
   
            
   } else{
                echo "All fields must be filled in!";
            
            } 
   
//$conn->close();
    }
   
}

    $reg=new User();
    
    $reg->logIn();
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
         <h2 class="heading">Login</h2>
          <div class="form">
           <form action="login" method="POST" name="form" id="form">
              
               
            <input type="text" onblur="validateText(this)" id="username" name="userName" class="input" placeholder="Username"><br>
            <input type="password" onblur="validateText(this)" id="password" name="passWord" class="input" placeholder="Password" ><br>
            <input type="submit" name="bt_submit" value="LOGIN" class="input">
           
                                     
           </form>
          </div>
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
    <?php include "footer.php";?>
           </div>
           
    </body>
</html>