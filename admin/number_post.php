<?php
session_start();
include "libraries/authentication.php";
include "libraries/functions.php";
include "libraries/database.php";
unAuthorized();  

if( isset($_POST['saved']) ){

        $sql = "UPDATE tbl_users SET `number_post`='".$_POST['number_post']."', `sort`='".$_POST['sort']."' WHERE id='".$_SESSION['id']."' ";
        
        mysqli_query($connection, $sql) or die('Error upon saving') ;
        header('location:number_post.php?saved');
    }else{
       // header('location:?error');
    }

		$user_sql = "SELECT * FROM tbl_users WHERE id='".$_SESSION['id']."' ";
        $user_records = mysqli_query($connection, $user_sql);
        $user_row = mysqli_fetch_assoc($user_records);
		
include "templates/header.php";
?>
<div id="layoutSidenav">
    <?php include "templates/sidebar.php"; ?>
 <div id="layoutSidenav_content">
	<main>
		<div class="container-fluid px-4">
			<h1 class="mt-4">Number of Posts</h1>
			<form method="POST">
			  
			  <div class="form-group">
				<label for="exampleFormControlSelect1">Number of blog to show on homepage</label>
				<input type="number" name="number_post" id="typeNumber" class="form-control" value="<?= $user_row['number_post'] ?? 0 ?>"/>
			  </div>
			  <br>
			  <div class="input-group mb-3 mr-3">
				  <div class="input-group-prepend">
					<label class="input-group-text" for="inputGroupSelect01">Sort blog post by</label>
				  </div>
				  <select class="custom-select" id="inputGroupSelect01" name="sort">
					<option value="desc">Latest Blogs</option>
					<option value="asc">Old Blogs</option>
					
				  </select>
				</div>
			  <div class="mt-4 mb-0">
                <div class="d-grid">
					<button type="submit" class="btn btn-primary" name="saved">Save</button>
				</div>
              </div>
			  
			</form>
		</div>	
	</main>
</div>
<?php include "templates/footer.php";?>
