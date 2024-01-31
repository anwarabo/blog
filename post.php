<?php
include "admin/libraries/database.php";
include "admin/libraries/authentication.php";
include "admin/libraries/functions.php";

    session_start();
    $authorization = unAuthorized();

    if( !empty( $_GET['slug'] ) ){
                
        $sql = "SELECT * FROM tbl_user_blogs WHERE slug='".$_GET['slug']."' ";
        $query = mysqli_query( $connection, $sql );
        $row = mysqli_fetch_assoc( $query );
        
        if(mysqli_num_rows( $query ) == 0 ){
            exit('404 Post not found');
        }
    
        $user_sql = "SELECT username FROM tbl_users WHERE id='".$row['user_id']."' ";
        $user_records = mysqli_query($connection, $user_sql);
        $user_row = mysqli_fetch_assoc($user_records);
    }
	
	$settings_sql = "SELECT * FROM tbl_user_site_settings WHERE user_id = '".$_SESSION['id']."'";
	$settings_query = mysqli_query($connection, $settings_sql);
	$settings_record = mysqli_fetch_assoc($settings_query);
	
    include "templates/post_header.php";
?>

       
        <!-- Post Content-->
        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <p><?= $row['content']?> </p>
                    </div>
                </div>
            </div>
        </article>
<?php include "templates/footer.php";?>       
