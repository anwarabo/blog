<?php

include "libraries/database.php";
include "libraries/authentication.php";
include "libraries/functions.php";
    session_start();
    unAuthorized();
    
include "templates/header.php";
?>

<style>
   .chat{
background-color: #82c2d1;
padding:20px 30px;

border-radius:50rem;
border-bottom-right-radius:0;

position: relative;
}
.chat::after{
    content:'';
    display:block;
    position:absolute;
    right:0;
    top:100%;
    width:25px;
    height:10px;

    background-color:inherit;
    clip-path: polygon(0 0, 100% 0, 100% 100%);
}
.chat:hover{
    cursor:pointer;
    background-color: #4e9eb1;
}
.chat image.rounded-circle{
    position:absolute;
    top: 0rem;
    left: 0rem;
    width: 4rem;
    height: 4rem;
    
}

a.index:link {
  color: #000066;
  background-color: transparent;
  text-decoration: none;
}
a.index:visited {
  color: #000099;
  background-color: transparent;
  text-decoration: none;
}
a.index:hover {
  color:#003399;
  background-color: transparent;
  text-decoration: underline;
}
a.index:active {
  color: #00CCFF;
  background-color: transparent;
  text-decoration: underline;
}
</style>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <?php include "templates/sidebar.php"; ?>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Home</h1>
                <ol class="breadcrumb mb-4">
                    
                    <?php if( isset($_GET['updated']) ):?>
                        <li class="text-success breadcrumb-item">Account is updated!</li>
                    <?php endif;?>
                </ol>
                <?php
                    $get_all_blog = fetchBlog();
                    for( $i=0; $i < mysqli_num_rows($get_all_blog); $i++):
                        $row = mysqli_fetch_assoc( $get_all_blog);
                        
                ?>
                <div class="chat mb-3">
                    <i><?= $row['username']?></i> has created a new post titled <b><?= $row['title']?></b> last <?= $row['date_created'] ?> | <a class="index" href="../post.php?slug=<?= $row['slug'];?>" target="_new"> View Post</a>
                </div>
                <?php endfor; ?>   

<?php include "templates/footer.php";?>
