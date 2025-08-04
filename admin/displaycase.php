<?php
require '../core/session.php';
require '../core/config.php';
require '../core/admin-key.php';

// Error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Fetch all messages from the cmp_log table
$result = mysql_query("SELECT * FROM `cmp_log`");
if (!$result) {
    die("Error: " . mysql_error());
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CPMS</title>
    <link rel="shortcut icon" href="../files/img/ico.ico">
    <link rel="stylesheet" href="../files/css/bootstrap.css">
    <link rel="stylesheet" href="../files/css/custom.css">
</head>

<body>

    <?php require 'nav.php'; ?>

    <div class="cover main" style="background:#40C4FF;">
        <h1>Case Details</h1>
    </div>

    <div class="animated fadeIn">
        <div class="container">
            <div class="col-lg-12 ">

                <?php
                while ($data = mysql_fetch_array($result)) {
                    $message_id = $data['id'];

                    echo "<div class='admin-data'>";
                    echo $data['name'];
                    echo "<a class='button view' href='view-updatecase.php?id={$message_id}'>View</a>"; // Link to new page
                    echo "</div>";
                }
                ?>

                <br><br><br><br><br><br><br><br><br><br><br><br>

            </div>
        </div>
    </div>

  

    <script src="../files/js/jquery.js"></script>
    <script src="../files/js/bootstrap.min.js"></script>
    <script src="../files/js/script.js"></script>

</body>

</html>
