<?php
    if( isset($_POST['login']) ){
        $username = addslashes($_POST['username']);
        $password = addslashes($_POST['password']);
        $sql = "SELECT id,username,first_name FROM tbl_users WHERE username='".$username."' AND password='".$password."' LIMIT 1";
        $records = mysqli_query($connection, $sql);
        if( mysqli_num_rows($records) === 1 ){
            $user_info = mysqli_fetch_assoc($records);
            session_start();
            $_SESSION['id'] = $user_info['id'];
            $_SESSION['username'] = $user_info['username'];
            $_SESSION['first_name'] = $user_info['first_name'];
            header('location:/admin/index.php');
        }else{
            header('location:/admin/login.php?error=1');
        }
        
    }