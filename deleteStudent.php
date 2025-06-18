<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vertex Institute - Delete Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .header {
            background-color: #2c3e50;
            color: white;
            padding: 20px 0;
            margin-bottom: 30px;
        }

        .delete-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .form-title {
            color: #2c3e50;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background-color: #bb2d3b;
            color: white;
        }

        .student-card {
            border-left: 5px solid #dc3545;
            margin: 20px 0;
        }

        .detail-label {
            font-weight: bold;
            color: #2c3e50;
        }
    </style>
</head>

<body>
    <?php include("navbar.php"); ?>
    <div class="container">
        <div class="delete-container">
            <h3 class="form-title text-center">Delete Student Record</h3>

            <form id="findDeleteForm" onsubmit="findStudentForDelete(event)">
                <div class="mb-3">
                    <label for="deleteNIC" class="form-label">Enter Student NIC Number to Delete</label>
                    <input type="text" class="form-control" id="deleteNIC" placeholder="e.g. 123456789V" required>
                </div>
                <button type="submit" class="btn btn-outline-primary w-100">Find Student</button>
            </form>

            <!-- Details of Student -->
            <div class="card student-card d-none" id="deleteStudentCard">

            </div>

            <!-- No results message -->
            <div class="alert alert-warning mt-3 d-none" id="deleteNotFound">
                No student found with the provided NIC number. Please check and try again.
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>

</html>