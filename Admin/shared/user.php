<p ><a style="color : #FF66FF">User: <?php echo isset($_SESSION['user_name_lg'])?$_SESSION['user_name_lg']: ''; ?></a>
    &emsp;<a href=<?php echo '/project/login_logout/dangxuat.php';?> style="color : #FF66FF" >Logout</a>
</p>
<?php
    if(!isset($_SESSION['user_name_lg'])){
        redirect_to('../login_logout/dangnhap.php');
    
    }
    // if(!isset($_SESSION['user_name_lg'])){
    //     redirect_to('login_logout/dangnhap.php');
       
    // }
 ?>