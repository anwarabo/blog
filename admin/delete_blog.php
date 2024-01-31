<?php
include "libraries/database.php";
include "libraries/authentication.php";

session_start();
if( !empty($_GET['id'])){
    
    $sql = "DELETE FROM tbl_user_blogs WHERE id='".$_GET['id']."' AND user_id='".$_SESSION['id']."' ";
   
    if( mysqli_query($connection, $sql)){
        header('location:edit_delete.php?deleted=1');
        exit;
    }else{
        header('location:edit_delete.php?deleted=0');
    } 
}