<?php
    require 'core/session.php';
    require 'core/config.php';
    include 'core/user_key.php';
    //for session
    $session=$_SESSION['email'];
    $ref = rand (3858558,100000);$error = "";$message = "";$alpha="U S E R ";
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CPMS  </title>
    <link rel="shortcut icon" href="files/img/ico.ico">
    <link rel="stylesheet" href="files/css/bootstrap.css">
    <link rel="stylesheet" href="files/css/custom.css">
    <style media="screen">
    table{border: 0px;}
    td{
      padding:10px;
      border-top: 0px solid #eee;
      border-bottom: 0px solid #eee!important;
      padding-left: 0px;
      color:#0ea798;
    }
    input,button.log{width: 450px;}
    </style>
  </head>
  <body>
    <div class="cover user text-center" style="height:120px;">
      <br>
      
      <h2>Add Complaints</h2>
    </div>
    <?php require 'nav-profile.php'; ?>
    <div class="animated fadeIn">
      <div class="padd">
        <div class="col-lg-12 text-center">
          <?php
            $query1=mysql_query("SELECT * FROM `user` WHERE email LIKE '%$session%'");
            while( $arry=mysql_fetch_array($query1) ) {
              $id=$arry['id'];
              $name=$arry['name'];
              $username=$arry['username'];
              $email = $arry['email'];
                 }
                   if(empty($_POST)===false){
                     $phoneno =mysql_real_escape_string($_POST['phoneno']);
                     $TypeOfComplaint = mysql_real_escape_string($_POST['TypeOfComplaint']);
                     $complain = mysql_real_escape_string($_POST['complain']);
                     if(empty($phoneno) || empty($TypeOfComplaint) || empty($complain)){
                     }elseif (!preg_match("/^[0-9]*$/",$phoneno)) {
                       $error = "Invalid Phone Number";
                     }else{
					   
					   
                       mysql_query("INSERT INTO `cmp_log` VALUES ('0','$id','$name','$username','$email','$phoneno','$TypeOfComplaint','$complain','$ref')") or die(mysql_error());
                       if (isset($_FILES['file'])) {
  $file_errors = array();

  $file_names = $_FILES['file']['name'];
  $file_tmps = $_FILES['file']['tmp_name'];
  $file_sizes = $_FILES['file']['size'];
  $file_types = $_FILES['file']['type'];

  // Loop through each uploaded file
  foreach ($file_names as $key => $value) {
    $file_name = $file_names[$key];
    $file_tmp = $file_tmps[$key];
    $file_size = $file_sizes[$key];
    $file_type = $file_types[$key];

    // Validate file type or size if needed
    // Perform necessary checks here...

    // Upload directory - Modify this path according to your needs
    $upload_dir = 'uploads/';
    $upload_file = $upload_dir . basename($file_name);
	
	

    // Move uploaded file to the specified directory
    if (move_uploaded_file($file_tmp, $upload_file)) {
      // File uploaded successfully, save the file details to the database
      $file_url = $upload_file; // Store the file URL or path in the database

      // Example: Insert file details into the database along with the complaint reference number
      // Replace this query with your database insertion logic
      mysql_query("INSERT INTO `files` (filename, file_url, ref) VALUES ('$file_name', '$file_url', '$ref')") or die(mysql_error());

      // You can display a success message or perform any other actions
      //echo "File uploaded successfully: $file_name <br>";
    } else {
      // Error uploading file
	  //echo($upload_file);die;
      $file_errors[] = "Failed to upload file: $file_name <br>";
    }
  }

  if (!empty($file_errors)) {
    // Display any file upload errors, if present
    foreach ($file_errors as $error) {
      //echo $error;
    }
  }
}
					   $message = "Your Complain has been Registerd";
                       }
                   }
              ?>
          <form class="" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="container">
              <div class="panel panel-default">
                  <div class="panel-body">
                      <h2>Your Reference no : &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ref;
                      echo"<p><span class='error'>".$error."</p></span>";
                      echo "<p><span class='message'>".$message."</p></span>";
                      ?></h2>
                  </div>
              </div>
              <table>
                <tr>
                  <td class="text-left">Your Reference no</td>
                  <td class="text-left"><div class="dis_b"><?php echo $ref;  ?></div></td>
                </tr>
                <tr>
                  <td class="text-left">Your Username</td>
                  <td class="text-left"><div class="dis_b"><?php echo $username;?></div></td>
                </tr>
                <tr>
                  <td class="text-left">Your User ID</td>
                  <td class="text-left"><div class="dis_b"><?php echo $alpha.$id;  $user_id = $id;?></div></td>
                </tr>
                <tr>
                  <td class="text-left">Your Your Email ID</td>
                  <td class="text-left"><div class="dis_b"><?php echo $email;?></div></td>
                </tr>
                <tr>
                  <td class="text-left">Your Contact Number </td>
                  <td><input type = "text" name = "phoneno" maxlength=10 placeholder = "Your Phone number">  </td>
                </tr>
                <tr>
                  <td class="text-left">Type Of Complaint </td>
                  <td>
                    <select name="TypeOfComplaint">
                      <option value="Wildlife Complaint">Wildlife Complaint</option>
                      <option value="Forestry Complaint">Forestry Complaint</option>
                      <option value="Environmental Crime Complaint">Environmental Crime Complaint</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="text-left">Your Complaint </td>
                  <td><textarea name="complain" rows="8" cols="80" placeholder="Your complain"></textarea></td>
                </tr>
				<tr>
                  <td class="text-left">Evidences </td>
                  <td><div class="dis_c"><input type="file" name="file[]" multiple accept="image/*, video/*"></div></td>
                </tr>
                <tr><td></td><td></td></tr>
                <tr>
                  <td></td>
                  <td><button type="submit" class="log">Submit</button></td>
                </tr>
              </table>
            </div>
          </form>
        </div>
      </div>
    </div>
      <footer>
            <br><br>&copy <?php echo date("Y"); ?> <?php echo $web_name; ?>
      </footer>
    <script src="files/js/jquery.js"></script>
    <script src="files/js/bootstrap.min.js"></script>
    <script src="files/js/script.js"></script>
  </body>
</html>
