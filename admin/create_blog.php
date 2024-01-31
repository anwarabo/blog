<?php
include "libraries/authentication.php";
include "libraries/functions.php";
include "libraries/database.php";

    session_start();
    unAuthorized();

    if( isset($_POST['created']) ){

        $filename = rand(1,99).'-'.$_FILES['image']['name'];
        if( $_FILES['image']['type'] !== 'image/jpeg' ){
                header('location:?invalidtype');
                exit;
            }

            if( move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/images/'.$filename)){

                $sql = "INSERT INTO tbl_user_blogs SET `user_id`='".$_SESSION['id']."', `title`='".addslashes($_POST['title'])."', `slug`='".strtolower(str_replace(" ", "-", $_POST['title'] ))."', `subtitle`='".addslashes($_POST['subtitle'])."', `content`='".addslashes($_POST['content'])."', `image`='".$filename."', `date_created`=CURRENT_TIMESTAMP ";
            
                mysqli_query($connection, $sql) or die('Error upon saving') ;
                header('location:?success');
            }else{
                header('location:?error');
            }
        
    }

include "templates/header.php";

?>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
	<?php include "templates/sidebar.php"; ?>
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePage" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                            <div class="collapse" id="collapsePage" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link " href="edit_delete.php">Edit | Delete Blog</a>
                                </nav>       
                            </div> 
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Settings
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link " href="#">Site Title and Footer</a>
                                </nav>       
                            </div>  
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link " href="#">Number of post to display</a>
                                </nav>       
                            </div>          
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link " href="#">Sort order of post</a>
                                </nav>       
                            </div>                               
                        </div>
                    </div>
                    
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as: <?=$fetchUsers['username']?></div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Create Blog</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Create Blog</li>
                        </ol>
            <?php if( isset($_GET['success']) ):?>
                <div class="alert alert-success text-start" role="alert">Your Blog is created.</div>
            <?php endif;?>

            <!-- FORM -->
                        <form method="post" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" name="title" id="title" type="text" placeholder="Title" />
                                        <label for="title">Title</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" name="subtitle" id="subtitle" type="text" placeholder="Subtitle" />
                                        <label for="subtitle">Subtitle</label>
                                    </div>
                                </div>
                                        </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" name="content" id="content" placeholder="Content"></textarea>
                                    <label for="content">Content</label>
                                </div>
                                <div class="mb-3">
                                    <label for="content" >Post Banner</label>
                                    <input type="file" class="form-control" name="image" id="image" placeholder="Image"></textarea>
                                </div>
                              
                                <div class="mt-4 mb-0">
                                <div class="d-grid"><button type="submit" class="btn btn-primary" name="created">Create Blog</button></div>
                            </div>
                        </form>
     <Script>jQuery(document).ready(function() {
            jQuery('.content').richText();
        });</script>
	 
<?php include "templates/footer.php";?>             
