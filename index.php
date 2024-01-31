<?php
include "./admin/libraries/database.php";
include "./admin/libraries/authentication.php";
include "./admin/libraries/functions.php";
session_start();

	$settings_sql = "SELECT * FROM tbl_user_site_settings WHERE user_id = '".$_SESSION['id']."'";
	$settings_query = mysqli_query($connection, $settings_sql);
	$settings_record = mysqli_fetch_assoc($settings_query);
	
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?php echo $settings_record['title'] ?? 'Clean Blog' ?>  - Start Bootstrap Theme</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href=		 "https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#"><?php echo $settings_record['title'] ?? 'Start Bootstrap' ?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="menu">
					<?php include "templates/menu.php";?>
				</div>
            </div>
        </nav>
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <h1><?php echo $settings_record['header'] ?? 'Clean Blog' ?></h1>
                            <span class="subheading"><?php echo $settings_record['sub_header'] ?? 'A Blog Theme by Start Bootstrap' ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content-->
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                   
                     <hr class="my-4" />

                <!-- Post preview-->
                    <?php
					
					$sql = "SELECT * FROM tbl_user_history ORDER BY ID desc LIMIT 20 ";
                        $get_all_blog = fetchBlog();
                        for( $i=0; $i < mysqli_num_rows($get_all_blog); $i++):
                            $row = mysqli_fetch_assoc($get_all_blog);
                            
                    ?>
                        <div class="post-preview">
                            <a href="post/<?= $row['slug'];?>">
                                <h2 class="post-title"><?= $row['title']?></h2>
                                <h3 class="post-subtitle"><?= $row['subtitle']?></h3>
                            </a>
                            <p class="post-meta">
                                Posted by
                                <a href="#!"><?= $row['username']?></a>
                                on <?= $row['date_created']?>
                            </p>
                        </div>
                    <?php endfor; ?>        

                    <!-- Divider-->
                    <hr class="my-4" />
                    
                </div>
            </div>
        </div>
		
				
<?php include "templates/footer.php";?> 