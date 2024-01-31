<?php
session_start();
include "libraries/authentication.php";
include "libraries/functions.php";
include "libraries/database.php";
unAuthorized();  

$settings_exists = false;
$settings_record = [];
$settings_sql = "SELECT * FROM tbl_user_site_settings WHERE user_id = '".$_SESSION['id']."'";
$settings_query = mysqli_query($connection, $settings_sql);
if( mysqli_num_rows( $settings_query )  === 1 ) {
	$settings_exists = true;
	$settings_record = mysqli_fetch_assoc($settings_query);
}


if( isset($_POST['saved']) ) {   
	
	if( $settings_exists === false ) {
		$sql = "INSERT INTO tbl_user_site_settings SET `user_id`='".$_SESSION['id']."', `title`='".addslashes($_POST['title'])."', `header`='".addslashes($_POST['header'])."', `sub_header`='".addslashes($_POST['sub_header'])."', `social_facebook`='".addslashes($_POST['facebook'])."', `social_twitter`='".addslashes($_POST['twitter'])."', `social_github`='".addslashes($_POST['github'])."',`footer`='".addslashes($_POST['footer'])."' ";
	} else {
		$sql = "UPDATE tbl_user_site_settings SET `user_id`='".$_SESSION['id']."', `title`='".addslashes($_POST['title'])."', `header`='".addslashes($_POST['header'])."', `sub_header`='".addslashes($_POST['sub_header'])."', `social_facebook`='".addslashes($_POST['facebook'])."', `social_twitter`='".addslashes($_POST['twitter'])."', `social_github`='".addslashes($_POST['github'])."',`footer`='".addslashes($_POST['footer'])."' WHERE id='".$settings_record['id']."' ";
	}
	if( mysqli_query($connection, $sql) or die('Error upon saving') ) {
		header('location:?success');
	}else{
		header('location:?error');
	}
}       
		
include "templates/header.php";
?>
<div id="layoutSidenav">
    <?php include "templates/sidebar.php"; ?>
 <div id="layoutSidenav_content">
	<main>
		<div class="container-fluid px-4">
			<h1 class="mt-4">Site Config</h1>
			<form method="POST">
			  
			  <div class="form-group">
				<label for="exampleFormControlSelect1">Title</label>
				<input class="form-control" type="text" name="title" placeholder="Title" value="<?php echo $settings_record['title'] ?? '' ?>">
			  </div>
			  <div class="form-group">
				<label for="exampleFormControlSelect1">Header</label>
				<input class="form-control" type="text" name="header" placeholder="Header" value="<?php echo $settings_record['header'] ?? '' ?>">
			  </div>
			  <div class="form-group">
				<label for="exampleFormControlSelect1">Sub Header</label>
				<input class="form-control" type="text" name="sub_header" placeholder="Sub Header" value="<?php echo $settings_record['sub_header'] ?? '' ?>">
			  </div>
			  <div class="form-group">
				<label for="exampleFormControlSelect1">Facebook</label>
				<input class="form-control" type="text" name="facebook" placeholder="Facebook" value="<?php echo $settings_record['social_facebook'] ?? '' ?>">
			  </div>
			  <div class="form-group">
				<label for="exampleFormControlSelect1">Twitter</label>
				<input class="form-control" type="text" name="twitter" placeholder="Twitter" value="<?php echo $settings_record['social_twitter'] ?? '' ?>">
			  </div>
			  <div class="form-group">
				<label for="exampleFormControlSelect1">GitHub</label>
				<input class="form-control" type="text" name="github" placeholder="GitHub" value="<?php echo $settings_record['social_github'] ?? '' ?>">
			  </div>
			  <div class="form-group">
				<label for="exampleFormControlSelect1">Footer</label>
				<input class="form-control" type="text" name="footer" placeholder="Footer" value="<?php echo $settings_record['footer'] ?? '' ?>">
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
