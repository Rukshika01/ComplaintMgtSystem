<?php
if (isset($_SESSION['username'])===true) {

    header('Location:admin/admin-profile.php');

}elseif(isset($_SESSION['name'])===true){

  header('Location:officer/profile.php');

}elseif(isset($_SESSION['email'])===true){

  header('Location:profile.php');

}else{

}

?>
