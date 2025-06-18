<?php
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <?php include "navbar.php";?>
    <div class="row m-5">
<!-- Tables Row -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="dashboard-card card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">New Messages</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table data-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Issue</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $rs = DataBase::search("SELECT * FROM `messages` ORDER BY `messages`.`added_time` DESC ");
                                $rows = $rs->num_rows;
                                if ($rows > 0) {
                                    for ($i = 0; $i < $rows; $i++) {
                                        $data = $rs->fetch_assoc();
                                        ?>
                                        <tr>
                                            <td><?php echo $data["name"]; ?></td>
                                            <td><?php echo $data["email"]; ?></td>
                                            <td><?php echo $data["subject"]; ?></td>
                                            <td><?php echo $data["message"]; ?></td>
                                            <td><?php echo $data["added_time"]; ?></td>
                                        </tr>

                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>