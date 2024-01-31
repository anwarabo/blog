<?php
include "libraries/database.php";
include "libraries/authentication.php";
include "libraries/functions.php";

session_start();
$authorization = unAuthorized();

if( isset($_POST['updated']) ){

    $filename = rand(1,99).'-'.$_FILES['avatar']['name'];
   if( $_FILES['avatar']['type'] !== 'image/jpeg' ){
        //header('location:?invalidtype');
		print_r($_FILES);
        exit;
    }
    if( move_uploaded_file($_FILES['avatar']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/avatars/'.$filename)){
        
        $sql = "UPDATE tbl_users SET `username`='".$_POST['username']."', `email`='".$_POST['email']."', `password`='".$_POST['password']."', `avatar`='".$filename."' WHERE id='".$_SESSION['id']."' ";
        
        mysqli_query($connection, $sql) or die('Error upon saving') ;
        header('location:index.php?updated');
    }else{
        header('location:?error');
    }
}
        $user_sql = "SELECT * FROM tbl_users WHERE id='".$_SESSION['id']."' ";
        $user_records = mysqli_query($connection, $user_sql);
        $user_row = mysqli_fetch_assoc($user_records);
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7 mb-5 mt-0">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Edit Account</h3></div>
                                    <div class="card-body">

                                        <form method="post" enctype="multipart/form-data">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="first_name" name="first_name" type="text" placeholder="Enter your first name" value="<?= $user_row['first_name']?>"  />
                                                        <label for="inputFirstName">First name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="last_name" name="last_name" type="text" placeholder="Enter your last name" value="<?= $user_row['last_name']?>"  />
                                                        <label for="inputLastName">Last name</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="username" name="username" type="text" placeholder="Enter username" value="<?= $user_row['username']?>"/>
                                                <label for="inputUsername">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="email" name="email" type="email" placeholder="name@example.com" value="<?= $user_row['email']?>"/>
                                                <label for="inputEmail">Email address</label>
                                            </div>
                                            <div class="mb-3">
                                                <label for="avatar" class="form-label">Avatar</label>
                                                <input type="file" id="avatar" name="avatar" class="form-control" aria-decscribeby="avatar">
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="password" name="password" type="password" placeholder="Create a password" />
                                                        <label for="inputPassword">Password</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="password" name="password" type="password" placeholder="Confirm password" />
                                                        <label for="inputPasswordConfirm">Confirm Password</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid"><button type="submit" name="updated" class="btn btn-primary">Update</button></div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
