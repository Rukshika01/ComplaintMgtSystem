<?php
require '../core/session.php';
require '../core/config.php';
require '../core/admin-key.php';
 require_once('../tcpdf/tcpdf.php');

// Get the message ID from the URL
$message_id = $_GET['id'];

// Fetch case details from updatecase table based on message_id
$case_query = "SELECT * FROM updatecase WHERE message_id='$message_id'";
$case_result = mysql_query($case_query);
if (!$case_result) {
    die("Error: " . mysql_error());
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Case Details</title>
    <link rel="stylesheet" href="../files/css/bootstrap.css">
    <link rel="stylesheet" href="../files/css/custom.css">
    <style>
        /* Styles for centering the table */
        .center-table {
            margin: 0 auto;
            max-width: 800px;
        }

        /* Styles for status colors */
        .status-pending {
            color: red;
        }

        .status-inprogress {
            color: orange;
        }

        .status-resolved {
            color: green;
        }

        /* Set text color to black */
        body, td {
            color: black;
        }

        /* Center the Download PDF button */
        .center-download {
            text-align: center;
        }
    </style>
</head>
<body>
    <?php require 'nav.php'; ?>
    <div class="cover main" style="background:#40C4FF;">
        <h1>View Case Details</h1>
    </div>
    <div class="animated fadeIn">
        <div class="container">
            <div class="col-lg-12">
                <table class="table center-table">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($case_data = mysql_fetch_array($case_result)) {
                            echo "<tr>";
                            $status_class = '';
                            switch ($case_data['status']) {
                                case 'Pending':
                                    $status_class = 'status-pending';
                                    break;
                                case 'In Progress':
                                    $status_class = 'status-inprogress';
                                    break;
                                case 'Resolved':
                                    $status_class = 'status-resolved';
                                    break;
                                default:
                                    $status_class = '';
                            }
                            echo "<td class='$status_class'>" . $case_data['status'] . "</td>";
                            echo "<td>" . $case_data['notes'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <br>
                <br>
                <div class="center-download">
                    <a class="download-btn" href="generate_pdf.php?id=<?php echo $message_id; ?>" target="_blank">Download PDF</a>
                </div>
            </div>
        </div>
    </div>
   
  
    <script src="../files/js/jquery.js"></script>
    
</body>
</html>
