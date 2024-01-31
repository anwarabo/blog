<?php
if( !function_exists( 'unAuthorized' ) ){
    function unAuthorized(){
        if(!isset($_SESSION['id'])){
            header('location:/admin/login.php?access=unauthorized');
        }
    }
}

if( !function_exists( 'fetchTblUsers' ) ){
    function fetchTblUsers(){
        global $connection;
        
            $user_sql = "SELECT * FROM tbl_users WHERE id='".$_SESSION['id']."' ";
            $user_records = mysqli_query($connection, $user_sql);
            $user_row = mysqli_fetch_assoc($user_records);
            return $user_row;
            
    }
    
}

if( !function_exists( 'fetchBlog' ) ){
    function fetchBlog(){
        global $connection;
		$id =   $_SESSION['id'] ?? 0 ;
		
		$number_post_sql = "SELECT number_post, sort FROM tbl_users WHERE id='".$_SESSION['id']."' ";
        $number_post_records = mysqli_query($connection, $number_post_sql);
        $number_post = mysqli_fetch_assoc($number_post_records);
		
		
			
			
        $sql= "SELECT tbl_users.username,  tbl_user_blogs.* FROM tbl_users LEFT JOIN tbl_user_blogs ON tbl_users.id=tbl_user_blogs.user_id WHERE tbl_users.id='". $id ."' ORDER BY ID ".$number_post['sort']." LIMIT ". $number_post['number_post'] ;
        //$sql = "SELECT * FROM tbl_user_blogs WHERE user_id='".$_SESSION['id']."' ";
        $records = mysqli_query($connection, $sql);
        return $records;
    }
}
