<?php include "db.php"; ?>
<?php  include "functions.php";  ?> 

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
        <img src="news-logo.png" class="logo">
              
        <nav>
            <ul> 
                <li><a href="home">Home</a></li> 
                <li><a href="admin/index.php">Admin</a></li>
                <li><a href="subscriber/insertPost.php">Subscriber</a></li>
<?php $categ->categories();  ?>                      
            </ul>
        </nav>
                
    </header>