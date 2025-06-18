<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vertex Institute - Update Student</title>
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
        .update-container {
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
        .btn-update {
            background-color: #2c3e50;
            color: white;
        }
        .btn-update:hover {
            background-color: #1a252f;
            color: white;
        }
        .required-field::after {
            content: " *";
            color: red;
        }
        .search-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php include("subheader.php");?>

    <div class="container">
        <div class="update-container">
            <h3 class="form-title">Update Student Information</h3>
            
            <div class="search-section">
                <h5>Find Student by NIC Number</h5>
                <form id="findStudentForm">
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <input type="text" class="form-control" id="findNIC" placeholder="Enter NIC Number" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <button type="submit" class="btn btn-outline-primary w-100">Find Student</button>
                        </div>
                    </div>
                </form>
            </div>

            <form id="updateForm" class="d-none">
                <div class="alert alert-info">
                    Updating details for: <strong id="updateStudentName">John Doe</strong> (NIC: <strong id="updateStudentNIC">123456789V</strong>)
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="updateName" class="form-label required-field">Full Name</label>
                        <input type="text" class="form-control" id="updateName" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="updateGender" class="form-label required-field">Gender</label>
                        <select class="form-select" id="updateGender" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="updateAddress" class="form-label required-field">Address</label>
                    <textarea class="form-control" id="updateAddress" rows="3" required></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="updateContact" class="form-label required-field">Contact Number</label>
                        <input type="tel" class="form-control" id="updateContact" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="updateEmail" class="form-label required-field">Email</label>
                        <input type="email" class="form-control" id="updateEmail" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="updateCourse" class="form-label required-field">Course</label>
                        <select class="form-select" id="updateCourse" required>
                            <option value="cs">Computer Science</option>
                            <option value="ai">Artificial Intelligence</option>
                            <option value="ds">Data Science</option>
                            <option value="cyber">Cybersecurity</option>
                            <option value="robotics">Robotics Engineering</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="updateStatus" class="form-label">Status</label>
                        <select class="form-select" id="updateStatus">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="graduated">Graduated</option>
                        </select>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-outline-secondary me-md-2" id="cancelUpdate">Cancel</button>
                    <button type="submit" class="btn btn-update">Update Details</button>
                </div>
            </form>

            <div class="alert alert-warning mt-3 d-none" id="studentNotFound">
                No student found with the provided NIC number. Please check and try again.
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('findStudentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const nic = document.getElementById('findNIC').value;
            
            // Simulate finding a student
            if (nic) {
                document.getElementById('updateForm').classList.remove('d-none');
                document.getElementById('studentNotFound').classList.add('d-none');
                
                // Populate form with student data (in a real app, this would come from backend)
                document.getElementById('updateStudentName').textContent = 'John Doe';
                document.getElementById('updateStudentNIC').textContent = nic;
                document.getElementById('updateName').value = 'John Doe';
                document.getElementById('updateGender').value = 'male';
                document.getElementById('updateAddress').value = '123 University Ave, Tech City';
                document.getElementById('updateContact').value = '+94123456789';
                document.getElementById('updateEmail').value = 'john.doe@vertex.edu';
                document.getElementById('updateCourse').value = 'cs';
            } else {
                document.getElementById('updateForm').classList.add('d-none');
                document.getElementById('studentNotFound').classList.remove('d-none');
            }
        });

        document.getElementById('cancelUpdate').addEventListener('click', function() {
            document.getElementById('updateForm').classList.add('d-none');
            document.getElementById('findNIC').value = '';
        });

        document.getElementById('updateForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Update logic would go here
            alert('Student details would be updated here');
        });
    </script>
</body>
</html>