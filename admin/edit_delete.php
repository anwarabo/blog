<?php
session_start();
include "libraries/authentication.php";
include "libraries/functions.php";
include "libraries/database.php";
unAuthorized();  
include "templates/header.php";
?>
<div id="layoutSidenav">
    
            <div id="layoutSidenav_content">
			<?php include "templates/sidebar.php"; ?>
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Edit | Delete</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Edit | Delete</li>
                        </ol>
                        <?php if( isset($_GET['invalidtype']) ):?>
                            <div class="alert alert-danger text-start" role="alert">Invalid image type, please select jpg format.</div>
                        <?php endif;?>

                        <?php if( isset($_GET['deleted']) && $_GET['deleted'] == 1 ):?>
                            <div class="alert alert-success text-start" role="alert">Blog deleted!</div>
                        <?php endif;?>
                        <?php if( isset($_GET['deleted']) && $_GET['deleted'] == 0 ):?>
                            <div class="alert alert-danger text-start" role="alert">Something went wrong.</div>
                        <?php endif;?>
                        <?php if( isset($_GET['success']) ):?>
                            <div class="alert alert-success text-start" role="alert">Update complete.</div>
                        <?php endif;?>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Title</th>
                                            <th>Subtitle</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php
                                        /** @todo: create a general function for these redundant statements,this applys to all. */
                                          
                                            $get_all_blog = fetchBlog();
                                            for( $i=0; $i < mysqli_num_rows($get_all_blog); $i++):
                                                $row = mysqli_fetch_assoc($get_all_blog);
                                        ?>
                                        <tr>
                                            <td><?= $row['id'];?></td>
                                            <td><?= $row['title'];?></td>
                                            <td><?= $row['subtitle'];?></td>
                                            <td><?= $row['date_created'];?></td>
                                            <td><a href="edit_blog.php?id=<?= $row['id'];?>">Edit</a> | <a href="javascript:void(0);" onclick="deleteHistory(<?= $row['id'];?>);" >Delete</a></td>
                                            
                                        </tr>
                                        <?php endfor; ?>   
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>

<?php include "templates/footer.php";?>
