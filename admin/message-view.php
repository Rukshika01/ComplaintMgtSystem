<?php
  require '../core/session.php';
  require '../core/config.php';
  require '../core/admin-key.php';

  $id = $_GET['id'];
	$result = mysql_query("SELECT * FROM `cmp_log` WHERE id='$id'");
	$arry = mysql_fetch_array($result);
	if (!$result) {
			die("Error: Data not found..");
		}
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CPMS  </title>
    <link rel="shortcut icon" href="../files/img/ico.ico">
    <link rel="stylesheet" href="../files/css/bootstrap.css">
    <link rel="stylesheet" href="../files/css/custom.css">
  </head>
  <body>
  <?php require 'nav.php';?>

  <div class="animated fadeIn">


  <div class="cover main">
    <h1>Messages</h1>
  </div>
    <div class="div">
        <div class="col-lg-12 ">

          <?php
          echo "<a class='button logout' href ='m_delete.php?id=$id' onClick=\"javascript:return confirm ('Are you really want to delete ?');\">Delete</a>";
           ?>

           <br><br><br><br>
          <table>
          <?php
            $query1=mysql_query("SELECT * FROM `cmp_log` WHERE id='$id'");
            while( $arry=mysql_fetch_array($query1) ) {

              $id = $arry['id'];
              $user_id = $arry['user_id'];
              $name = $arry['name'];
              $username = $arry['username'];
              $email = $arry['email'];
              $phone_no = $arry['phone no'];
              $TypeOfComplaint = $arry['TypeOfComplaint'];
              $complain = $arry['complain'];
              $ref = $arry['ref_no'];
            }

               echo "<tr> <td> <b> Message Id </b> </td>";
               echo "     <td> ".$id."</td> </tr>";

               echo "<tr> <td> <b> Profile Id </b> </td>";
               echo "     <td> ".$user_id."</td> </tr>";

               echo "<tr> <td> <b> Name </b> </td>";
               echo "     <td> ".$name."</td> </tr>";

               echo "<tr> <td> <b> Username </b> </td>";
               echo "     <td> ".$username."</td> </tr>";

               echo "<tr> <td> <b> Phone no </b> </td>";
               echo "     <td> ".$phone_no."</td> </tr>";

               echo "<tr> <td> <b> Types Of Complaint </b> </td>";
               echo "     <td> ".$TypeOfComplaint."</td> </tr>";

               echo "<tr> <td> <b> Complain </b> </td>";
               echo "     <td> ".$complain."</td></tr>";

               echo "<tr> <td> <b> Reference </b> </td>";
               echo "     <td> ".$ref."</td></tr>";
			    
			   $files_query = mysql_query("SELECT * FROM `files` WHERE ref='$ref'");
			   if (mysql_num_rows($files_query) > 0) {
			   echo "<tr><td colspan='2'><b>Related Evidences:</b></td></tr>";
				while ($file = mysql_fetch_array($files_query)) {
					$file_name = $file['filename'];
					$file_url = "../" . $file['file_url']; 
						echo "<tr><td colspan='2'><a href='" . $file_url . "' target='_blank'>" . $file_name . "</a></td></tr>";
					}
				}
          ?>
          </table>



          <div class="field-off jumbotron">
            <br>
            <h2>Our field Officers</h2>
            <p>Note : Click on the related field officer so he can help with that problem </p>

                <div class="li">
            <?php
              $no=1;
              $db=mysql_query("SELECT * FROM `officer`");
                while($data=mysql_fetch_array($db)) {
                   $name = $data['name'];
                  $id_officer = $data['id'];
                  $post = $data['post'];
                  echo " <a class='list' href='forward.php?officer=$name & id=$id'> $name - [ $post ]</a> <br> ";
                }
            ?>
                </div>
          </div>
          <br><br>

      </div>
    </div>
  </div>


  <footer>
  <br><br>&copy <?php echo date("Y"); ?> <?php echo $web_name; ?>
  </footer>
    <script src="../files/js/jquery.js"></script>
    <script src="../files/js/bootstrap.min.js"></script>
    <script src="../files/js/script.js"></script>

  </body>
</html>
