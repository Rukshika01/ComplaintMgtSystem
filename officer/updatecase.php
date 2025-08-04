<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Case</title>
    <link rel="stylesheet" href="../files/css/bootstrap.css">
    <link rel="stylesheet" href="../files/css/custom.css">
</head>

<body>
    <?php require 'nav.php'; ?>
    <div class="cover main" style="background:#40C4FF;">
        <h1>Update Case</h1>
    </div>
    <div class="animated fadeIn">
        <div class="container">
            <div class="col-lg-6 col-lg-offset-3">
                <form id="updateForm" action="update-case.php" method="POST">
                    <input type="hidden" name="message_id" value="<?php echo $_POST['message_id']; ?>">
                    <!-- Hidden field to pass message_id -->
                    <?php
                        require '../core/config.php';

                        $message_id = $_POST['message_id'];
                        $query = "SELECT * FROM updatecase WHERE message_id = '$message_id'";
                        $result = mysql_query($query);

                        if (mysql_num_rows($result) > 0) {
                            // If there are entries, display them in the form
                            $row = mysql_fetch_assoc($result);
                            $case_status = $row['status'];
                            $notes = $row['notes'];
                        } else {
                            // If there are no entries, leave the fields blank
                            $case_status = '';
                            $notes = '';
                        }
                    ?>
                    <div class="form-group">
                        <label for="case_status">Status:</label>
                        <select class="form-control" id="case_status" name="case_status" required>
                            <option value="Pending" <?php if($case_status == 'Pending') echo 'selected'; ?>>Pending</option>
                            <option value="In Progress" <?php if($case_status == 'In Progress') echo 'selected'; ?>>In Progress</option>
                            <option value="Resolved" <?php if($case_status == 'Resolved') echo 'selected'; ?>>Resolved</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="notes">Notes:</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3"><?php echo $notes; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Case Details</button>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <br><br>&copy; <?php echo date("Y"); ?> <?php echo $web_name; ?>
    </footer>
    <script src="../files/js/jquery.js"></script>
    <script src="../files/js/bootstrap.min.js"></script>
    <script src="../files/js/script.js"></script>

</body>

</html>
