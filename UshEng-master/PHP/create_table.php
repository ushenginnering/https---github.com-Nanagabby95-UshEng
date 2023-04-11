<?php
	session_start();
	include 'connect.php';
	         //   create user table
      $visits = 'users_added';
         $sql ="CREATE TABLE $visits ( 
            id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT ,
            name VARCHAR(225) NOT NULL ,
            email VARCHAR(70) NOT NULL ,
            phone varchar(20) NOT NULL ,
            school VARCHAR(225) NOT NULL,
            role VARCHAR(225) NOT NULL,
            added_date VARCHAR(225) NOT NULL)"; 
         if(mysqli_query($conn, $sql)){
             echo 'db created <br>';
         }else{
             echo 'db failed for some unknown reason never be<br>';
         }  

         $vis = 'AI4T_confrence';
         $sql ="CREATE TABLE $vis ( 
            id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT ,
            user_id VARCHAR(225) NOT NULL ,
            wait_list VARCHAR(225) NOT NULL )";
         if(mysqli_query($conn, $sql)){
             echo 'db created<br>';
         }else{
             echo 'db failed for some unknown reason never be<br>';
         }  

         $vis = 'resources';
         $sql ="CREATE TABLE $vis ( 
            id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT ,
            resource_link VARCHAR(225) NOT NULL ,
            resource_description VARCHAR(225) NOT NULL ,
            watch_count INT(25) NOT NULL )";
         if(mysqli_query($conn, $sql)){
             echo 'db created<br>';
         }else{
             echo 'db failed for some unknown reason never be<br>';
         }  

?>