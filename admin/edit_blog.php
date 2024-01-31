<?php
include "libraries/authentication.php";
include "libraries/functions.php";
include "libraries/database.php";


session_start();
unAuthorized();

if( !empty( $_GET['id'] ) ){
    
    $sql = "SELECT * FROM tbl_user_blogs WHERE id='".$_GET['id']."' AND user_id='".$_SESSION['id']."' ";
    
    $query = mysqli_query( $connection, $sql );
    $row = mysqli_fetch_assoc( $query );
    
   
    
}

if( isset($_POST['updated']) ){
	//print_r($_FILES);
		
	if($_FILES['image']['tmp_name'] != ''){
		
		$filename = rand(1,99).'-'.$_FILES['image']['name'];
		if( $_FILES['image']['type'] !== 'image/jpeg' ){
			header('location:edit_delete.php?invalidtype');
			exit;
		 }
		 
		 if( move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/images/'.$filename)){
			 $sql = "UPDATE tbl_user_blogs SET `user_id`='".$_SESSION['id']."', `title`='".addslashes($_POST['title'])."', `slug`='".strtolower(str_replace(" ", "-", $_POST['title'] ))."', `subtitle`='".addslashes($_POST['subtitle'])."', `content`='".addslashes($_POST['content'])."', `image`='".$filename."', `date_created`=CURRENT_TIMESTAMP WHERE id='".$_GET['id']."' ";
		 }else{
			 header('location:edit_delete.php?upload-failed');
		 }
			
	}else{
		
		$sql = "UPDATE tbl_user_blogs SET `user_id`='".$_SESSION['id']."', `title`='".addslashes($_POST['title'])."', `slug`='".strtolower(str_replace(" ", "-", $_POST['title'] ))."', `subtitle`='".addslashes($_POST['subtitle'])."', `content`='".addslashes($_POST['content'])."', `date_created`=CURRENT_TIMESTAMP WHERE id='".$_GET['id']."' ";
	
	}
	
	
	if(mysqli_query($connection, $sql)){
		header('location:edit_delete.php?success');
	}else{
		header('location:edit_delete.php?error');
  }
}

include "templates/header.php";
?>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <?php include "templates/sidebar.php"; ?>
    </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Edit Blog</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Edit Blog</li>
                        </ol>
                
                

            <!-- FORM -->
                    <form method="post" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" name="title" id="title" type="text" placeholder="Title" value="<?= $row['title'];?>"/>
                                        <label for="title">Title</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" name="subtitle" id="subtitle" type="text" placeholder="Subtitle" value="<?= $row['subtitle'];?>"/>
                                        <label for="subtitle">Subtitle</label>
                                    </div>
                                </div>
                                        </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" name="content" id="content" placeholder="Content" > <?= $row['content'];?>  </textarea>
                                    <label for="content">Content</label>
                                </div>
                                <div class="mb-3">
                                    <label for="content" >Post Banner</label>
                                    <input type="file" class="form-control" name="image" id="image" placeholder="Image" >
                                </div>
                              
                                <div class="mt-4 mb-0">
                                <div class="d-grid"><button type="submit" class="btn btn-primary" name="updated">Edit Blog</button></div>
                            </div>
                        </form>
                    
                </main>

<?php include "templates/footer.php";?>