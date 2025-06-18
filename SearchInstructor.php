<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vertex Institute - Search Instructor</title>
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

        .search-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
        }

        .form-title {
            color: #2c3e50;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .btn-search {
            background-color: #2c3e50;
            color: white;
        }

        .btn-search:hover {
            background-color: #1a252f;
            color: white;
        }

        .student-card {
            border-left: 5px solid #2c3e50;
            margin-top: 20px;
        }

        .detail-label {
            font-weight: bold;
            color: #2c3e50;
        }
    </style>
</head>

<body>
    <!-- Header -->
     <?php include("navbar.php"); ?>


    <div class="container">
        <div class="search-container">
            <h3 class="form-title">Search Instructor Details</h3>
            <form id="searchForm">
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="searchID" class="form-label">Enter Instructor ID</label>
                        <input type="text" class="form-control" id="searchID" placeholder="e.g. AMKDJHIF452" required>
                    </div>
                    <div class="col-md-4 mb-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-search w-100" onclick="searchInstructor();">Search</button>
                    </div>
                </div>
            </form>

            <div class="card student-card d-none" id="InstructorDetailsCard">

            </div>
            
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <script>
        document.getElementById("searchForm").addEventListener("submit", function (e) {
            e.preventDefault();

            var instructorId = document.getElementById("searchID").value.trim();
            var request = new XMLHttpRequest();
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    var response = request.responseText.trim();
                    if (response) {
                        document.getElementById('InstructorDetailsCard').classList.remove('d-none');
                        document.getElementById('InstructorDetailsCard').innerHTML = response;
                        document.getElementById('noResults').classList.add('d-none');
                    } else {
                        document.getElementById('InstructorDetailsCard').classList.add('d-none');
                        document.getElementById('noResults').classList.remove('d-none');
                    }
                }
            };
            request.open("GET", "searchInstructorProcess.php?id=" + instructorId, true);
            request.send();
        });
    </script>
</body>

</html>