function login(event) {
    event.preventDefault();

    // Get form values
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var remember = document.getElementById("rememberMe").checked;

    // Prepare the form data
    var formData = new FormData();
    formData.append("username", username);
    formData.append("password", password);
    formData.append("remember", remember ? "true" : "false");

    // Create the XMLHttpRequest
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState === 4) {
            if (request.status === 200) {
                var response = request.responseText.trim(); // Remove any whitespace

                if (response === "success") {
                    // Login successful, redirect
                    window.location.href = "adminDashboard.php";
                } else {
                    // Show error
                    alert(response);
                }
            } else {
                alert("Error: " + request.status);
            }
        }
    };

    // Send POST request
    request.open("POST", "loginProcess.php", true);
    request.send(formData);
}



function register() {
    var firstName = document.getElementById("fname").value.trim();
    var lastName = document.getElementById("lname").value.trim();
    var gender = document.getElementById("gender").value;
    var fee = document.getElementById("ifee").value.trim();
    var dob = document.getElementById("dob").value.trim();
    var address = document.getElementById("address").value.trim();
    var mobile = document.getElementById("contact").value.trim();
    var email = document.getElementById("email").value.trim();

    var request = new XMLHttpRequest();
    var formData = new FormData();

    formData.append("fname", firstName);
    formData.append("lname", lastName);
    formData.append("gender", gender);
    formData.append("mobile", mobile);
    formData.append("address", address);
    formData.append("email", email);
    formData.append("dob", dob);
    formData.append("fee", fee);

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText.trim();
            if (response === "success") {
                alert("Registration successful!");
            } else {
                alert(response);

            }
        }
    };

    request.open("POST", "registerProcess.php", true);
    request.send(formData);
}


function registerC() {
    var courseID = document.getElementById("cid").value.trim();
    var courseName = document.getElementById("cname").value.trim();
    var courseFee = document.getElementById("cfee").value.trim();
    var instructor = document.getElementById("instructor").value.trim();

    var request = new XMLHttpRequest();

    var formData = new FormData();
    formData.append("courseID", courseID);
    formData.append("courseName", courseName);
    formData.append("courseFee", courseFee);
    formData.append("instructor", instructor);

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText.trim();
            if (response === "success") {
                alert("Course registration successful!");
            } else {
                alert(response);
            }
        }
    };
    request.open("POST", "registerCourseProcess.php", true);
    request.send(formData);
}

function registerCourse() {
    var courseID = document.getElementById("cid").value.trim();
    var courseName = document.getElementById("cname").value.trim();
    var courseFee = document.getElementById("cfee").value.trim();
    var instructor = document.getElementById("instructor").value.trim();

    var request = new XMLHttpRequest();

    var formData = new FormData();
    formData.append("courseID", courseID);
    formData.append("courseName", courseName);
    formData.append("courseFee", courseFee);
    formData.append("instructor", instructor);

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText.trim();
            if (response === "success") {
                alert("Course registration successful!");
                window.location.reload();
            } else {
                alert(response);
            }
        }
    };
    request.open("POST", "registerCourseProcess.php", true);
    request.send(formData);
}
function registerS() {

    var firstName = document.getElementById("fname").value.trim();
    var lastName = document.getElementById("lname").value.trim();
    var nic = document.getElementById("nic").value.trim();
    var gender = document.getElementById("gender").value.trim();
    var dob = document.getElementById("dob").value.trim();
    var address = document.getElementById("address").value.trim();
    var mobile = document.getElementById("contact").value.trim();
    var email = document.getElementById("email").value.trim();
    var courseID = document.getElementById("course").value.trim();
    var intake = document.getElementById("intake").value.trim();

    var request = new XMLHttpRequest();

    var formData = new FormData();
    formData.append("firstName", firstName);
    formData.append("lastName", lastName);
    formData.append("nic", nic);
    formData.append("gender", gender);
    formData.append("dob", dob);
    formData.append("address", address);
    formData.append("mobile", mobile);
    formData.append("email", email);
    formData.append("courseID", courseID);
    formData.append("intake", intake);

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText.trim();
            alert(response);
        }
    };
    request.open("POST", "registerStudentProcess.php", true);
    request.send(formData);
}


function searchInstructor() {

    var instructorId = document.getElementById("searchID").value.trim();
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            if (response) {
                document.getElementById('InstructorDetailsCard').classList.remove('d-none');
                document.getElementById("InstructorDetailsCard").innerHTML = response;
                document.getElementById('noResults').classList.add('d-none');
            } else {
                document.getElementById('InstructorDetailsCard').classList.add('d-none');
                document.getElementById('noResults').classList.remove('d-none');
            }

        }
    }
    request.open("GET", "searchInstructorProcess.php?id=" + instructorId, true);
    request.send()

}


function updateIns() {
    var firstName = document.getElementById("fname").value.trim();
    var lastName = document.getElementById("lname").value.trim();
    var gender = document.getElementById("gender").value;
    var fee = document.getElementById("ifee").value.trim();
    var dob = document.getElementById("dob").value.trim();
    var address = document.getElementById("address").value.trim();
    var mobile = document.getElementById("contact").value.trim();
    var email = document.getElementById("email").value.trim();

    var request = new XMLHttpRequest();
    var formData = new FormData();

    formData.append("fname", firstName);
    formData.append("lname", lastName);
    formData.append("gender", gender);
    formData.append("mobile", mobile);
    formData.append("address", address);
    formData.append("email", email);
    formData.append("dob", dob);
    formData.append("fee", fee);

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText.trim();
            if (response === "success") {
                alert("Update successful!");
                window.location.href = "SearchInstructor.php";
            } else {
                alert(response);

            }
        }
    };

    request.open("POST", "InsUpdateProcess.php", true);
    request.send(formData);
}

function UpdateStudent() {
    var firstName = document.getElementById("fname").value.trim();
    var lastName = document.getElementById("lname").value.trim();
    var nic = document.getElementById("nic").value.trim();
    var gender = document.getElementById("gender").value.trim();
    var dob = document.getElementById("dob").value.trim();
    var address = document.getElementById("address").value.trim();
    var mobile = document.getElementById("contact").value.trim();
    var email = document.getElementById("email").value.trim();
    var courseID = document.getElementById("course").value.trim();
    var intake = document.getElementById("intake").value.trim();

    var request = new XMLHttpRequest();

    var formData = new FormData();
    formData.append("firstName", firstName);
    formData.append("lastName", lastName);
    formData.append("nic", nic);
    formData.append("gender", gender);
    formData.append("dob", dob);
    formData.append("address", address);
    formData.append("mobile", mobile);
    formData.append("email", email);
    formData.append("courseID", courseID);
    formData.append("intake", intake);

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText.trim();
            if (response === "success") {
                alert("Student Updated successfully!");
                window.location.href = "SearchStudent.php";
            } else {
                alert(response);
            }
        }
    };
    request.open("POST", "UpdateStudentProcess.php", true);
    request.send(formData);

}
function subscribe() {
    var email = document.getElementById("newsletterEmail").value.trim();
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText.trim();
            if (response === "success") {
                alertify.alert('Success', 'You have successfully subscribed!');
            } else {
                alertify.alert('Error', response);
            }
        }
    };
    request.open("GET", "subscribeProcess.php?email=" + email, true);
    request.send();
}



function sendMsg() {
    var name = document.getElementById("name").value.trim();
    var email = document.getElementById("email").value.trim();
    var subject = document.getElementById("subject").value.trim();
    var message = document.getElementById("message").value.trim();

    var request = new XMLHttpRequest();
    var formData = new FormData();
    formData.append("name", name);
    formData.append("email", email);
    formData.append("subject", subject);
    formData.append("message", message);

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText.trim();
            //alertify.alert('Message Status', response);
            if (response === "success") {
                alert("Message sent successfully!");
                window.location.reload();
            } else {
                alertify.alert('Message Status', response);
            }
        }
    };
    request.open("POST", "contactProcess.php", true);
    request.send(formData);
}


function showCourseDetails(selectedCourse) {
    showCourseDetailsFunction(selectedCourse);
    updateInstructorDetails(selectedCourse);
    displayPricing(selectedCourse);
    displayImageofCourse(selectedCourse);
    displayCourseWeeks(selectedCourse);
    displayOverallDetails(selectedCourse);
}

function showCourseDetailsFunction(courseID) {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText.trim();
            // alert(response);
            try {
                var data = JSON.parse(response);

                if (data.error) {
                    alert(data.error);

                } else {
                    // Show the card

                    // Populate the card with data from the JSON
                    document.getElementById('courseTitle').value = data.course_name;
                    document.getElementById('courseInstructor').value = data.instructor;
                    document.getElementById('courseFee').value = "Rs. " + data.course_fee;
                    document.getElementById('courseCode').value = data.id;
                    document.getElementById('courseDescription').value = data.course_description;
                    // Add any other fields you have in your PHP/DB
                }
            } catch (e) {
                console.error("Error parsing JSON:", e);
                alert("An error occurred while processing the course details." + e);

            }
        }
    };
    request.open("GET", "getCourseDetails.php?courseID=" + courseID, true);
    request.send();
}


function UpdateCourseDetailsOption() {
    var courseId = document.getElementById("courseCode").value.trim();
    var courseName = document.getElementById("courseTitle").value.trim();
    var courseInstructor = document.getElementById("courseInstructor").value.trim();
    var courseDescription = document.getElementById("courseDescription").value.trim();
    var courseFee = document.getElementById("courseFee").value.trim();


    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText.trim();
            if (response === "success") {
                alert("Successfully Updated!");
                window.location.reload();
            } else {
                alert(response);
            }
        }

    };

    var formData = new FormData();
    formData.append("id", courseId);
    formData.append("name", courseName);
    formData.append("ins", courseInstructor);
    formData.append("des", courseDescription);
    formData.append("fee", courseFee);

    request.open("POST", "UpdateCourse.php", true);
    request.send(formData);
}

function UpdateInstructorDetailsOption() {

    var courseid = document.getElementById("courseCode").value;
    var instructorID = document.getElementById("instructorSelect").value;


    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText.trim();
            if (response === "success") {
                alert("Successfully Updated!");
                window.location.reload();
            } else {
                alert(response);
            }
        }

    };

    var formData = new FormData();
    formData.append("id", instructorID);
    formData.append("cid", courseid);


    request.open("POST", "UpdateInstructor.php", true);
    request.send(formData);
}


function updateInstructorDetails(courseId) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var response = r.responseText.trim();
            try {
                var data = JSON.parse(response);
                //alert(response);

                if (data.error) {
                    alert(data.error);

                } else {
                    document.getElementById('instructorName').textContent = data.instructorName;
                    document.getElementById('instructorTitle').textContent = data.courseName;
                    document.getElementById('inst-image').src = data.imagePathofIns;
                    document.getElementById('instructorSelect').value = data.instid;
                }
            } catch (e) {
                console.error("Error parsing JSON:", e);
                alert("An error occurred while processing the Instructor details." + e);

            }
        }
    };

    r.open("GET", "UpdateInstructorDetails.php?cid=" + courseId, true);
    r.send();
}

function displayPricing(selectedCourse) {

    var c = selectedCourse;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var response = r.responseText.trim();
            // alert(response);
            try {
                var data = JSON.parse(response);

                if (data.error) {
                    alert(data.error);

                } else {
                    document.getElementById('courseFee1').value = Number(data.course_fee);
                    document.getElementById('maxStudents').value = Number(data.max_student);
                    document.getElementById('discount').value = Number(data.discount);
                }
            } catch (e) {
                console.error("Error parsing JSON:", e);
                alert("An error occurred while processing the pricing details." + e);
            }
        }
    };
    r.open("GET", "displayPricings.php?cid=" + c, true);
    r.send();

}
function updatePricing() {
    var courseId = document.getElementById("courseCode").value.trim();
    var coursefee = document.getElementById("courseFee1").value.trim();
    var MaxCount = document.getElementById("maxStudents").value.trim();
    var discount = document.getElementById("discount").value.trim();

    var r = new XMLHttpRequest();
    var f = new FormData();
    f.append("cid", courseId);
    f.append("fee", coursefee);
    f.append("mcount", MaxCount);
    f.append("dis", discount);

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var response = r.responseText.trim();
            alert(response);
        }
    }

    r.open("POST", "updatePricing.php", true);
    r.send(f);
}
//////display overall//////////
function displayOverallDetails(selectedCourse) {
    var courseID = selectedCourse;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText.trim();
            try {
                var data = JSON.parse(t);

                if (data.error) {
                    alert(data.error);

                } else {
                    document.getElementById('enrollmentCount').textContent = data.maximum;
                    document.getElementById('courseRating').textContent = data.status;
                    document.getElementById('lastUpdated').textContent = Number(data.Number_of_Weeks) + " Weeks";

                }
            } catch (e) {
                console.error("Error parsing JSON:", e);
                alert("An error occurred while processing the Overall details." + e);
            }
        }
    }

    r.open("GET", "displayOverall.php?cid=" + courseID, true);
    r.send();

}
////////display thumnail/////////
function displayImageofCourse(selectedCourse) {
    var courseID = selectedCourse;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText.trim();
            document.getElementById("previewImage").src = t;
        }
    }

    r.open("GET", "displayImageofCourse.php?cid=" + courseID, true);
    r.send();

}
// Added Weeks Uploaded
function displayCourseWeeks(course) {
    var courseID = course;
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState === 4 && r.status === 200) {
            var response = r.responseText.trim();
            const container = document.getElementById('syllabusItems');

            try {
                const data = JSON.parse(response);

                // Always clear the container first
                container.innerHTML = "";

                if (data.error) {
                    alert(data.error);
                } else {
                    // Loop and display all course weeks
                    data.forEach(function (week, index) {
                        const item = document.createElement('div');
                        item.className = "syllabus-item mb-4 border p-3 rounded";
                        item.innerHTML = `
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5>Week ${index + 1}</h5>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Week Title</label>
                                <input type="text" class="form-control mb-2 weekTitle" value="${week.title}">
                                <label class="form-label">Description</label>
                                <textarea class="form-control mb-2 weekDescription" rows="2">${week.description}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Video Lecture</label>
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control videoLink" value="${week.video_link}">
                                    <button class="btn btn-outline-secondary file-btn copy-btn" type="button">
                                        <i class="fas fa-link"></i>
                                    </button>
                                    <input type="file" class="fileInput d-none">
                                </div>
                            </div>
                        `;
                        container.appendChild(item);
                    });
                }

            } catch (error) {
                // Clear the container even if JSON parsing fails
                container.innerHTML = "";
                alert("Failed to parse course data.");
                alert("JSON Parse Error:", error);
                alert("Raw response:", response);
            }
        }
    };

    r.open("GET", "displayCourseWeek.php?cid=" + courseID, true);
    r.send();
}


// Updated addWeek to use closest element scope
function addWeek(btn) {
    const container = btn.closest('.syllabus-item');
    const courseID = document.getElementById("courseCode").value.trim();
    const WeekTitle = container.querySelector('.weekTitle').value.trim();
    const description = container.querySelector('.weekDescription').value.trim();
    const videolink = container.querySelector('.videoLink').value.trim();

    const r = new XMLHttpRequest();
    const f = new FormData();
    f.append("courseID", courseID);
    f.append("title", WeekTitle);
    f.append("description", description);
    f.append("videolink", videolink);

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            const res = r.responseText.trim();
            if (res === "success") {
                alert("Week added successfully!");
                // Move the added week to the top of the list (before addWeekBtn)
                const syllabusItems = document.getElementById('syllabusItems');
                syllabusItems.insertBefore(container, syllabusItems.firstChild);
                window.location.reload();
            } else {
                alert(res);
            }
        }
    };
    r.open("POST", "AddWeekTopics.php", true);
    r.send(f);
}


/////DELETE STUDENT///////
function findStudentForDelete(event) {
    event.preventDefault();

    var nic = document.getElementById("deleteNIC").value.trim();
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            document.getElementById("deleteStudentCard").innerHTML = r.responseText;
            document.getElementById("deleteStudentCard").classList.remove("d-none");
            document.getElementById("deleteNotFound").classList.add("d-none");
        }
    };
    r.open("GET", "FindStudentforDelete.php?studentNIC=" + encodeURIComponent(nic), true);
    r.send();
}


function deleteStudent(event) {
    event.preventDefault();
    var nic = document.getElementById("deleteNIC").value;
    var confirm = document.getElementById("confirmText").value;

    if (confirm === "DELETE") {
        var r = new XMLHttpRequest();
        r.onreadystatechange = function () {
            if (r.readyState == 4 && r.status == 200) {
                var response = r.responseText.trim();
                alert(response);
                window.location.href = "studentManagement.php";
            }
        };
        r.open("GET", "DeleteStudentProcess.php?nic=" + nic, true);
        r.send();
    } else {
        alert("If you want to DELETE Please Type the Word 'DELETE'");
    }
}

function forgetpassword(event) {
    event.preventDefault();

    var email = document.getElementById("email");
    if (email.value != "") {

        var f = new FormData();
        f.append("e", email.value);

        var r = new XMLHttpRequest();
        r.onreadystatechange = function () {
            if (r.readyState == 4 && r.status == 200) {
                var t = r.responseText;

                if (t == "success") {
                    alert("Successfully Send the Email! Reset Your Password");
                    document.getElementById('step1-content').style.display = 'none';
                    document.getElementById('step2-content').style.display = 'block';
                    document.getElementById('verificationEmail').value = email;

                    // Update step indicator
                    document.getElementById('step1').classList.remove('active');
                    document.getElementById('step1').classList.add('completed');
                    document.getElementById('line1-2').classList.add('completed');
                    document.getElementById('step2').classList.add('active');

                    // Start resend timer
                    startResendTimer();

                } else {
                    alert(t);
                    document.getElementById("email").value = "";
                }
            }
        };

        r.open("POST", "forgetPasswordProcess.php", true);
        r.send(f);
    } else {
        alert("Please Enter Your Valid Email");
    }

}

//timer

// Resend code functionality
let resendTimer;
let resendSeconds = 60;
function startResendTimer() {
    const resendBtn = document.getElementById('resendCodeBtn');
    resendBtn.disabled = true;
    resendBtn.textContent = `Resend (${resendSeconds})`;

    resendTimer = setInterval(function () {
        resendSeconds--;
        resendBtn.textContent = `Resend (${resendSeconds})`;

        if (resendSeconds <= 0) {
            clearInterval(resendTimer);
            resendBtn.disabled = false;
            resendBtn.textContent = 'Resend';
            resendSeconds = 60;
        }
    }, 1000);
}

//verify code
function verifyCode(event) {
    event.preventDefault();

    const code = document.getElementById("code").value.trim();
    const email = document.getElementById("verificationEmail").value;

    if (!code) {
        alert("Please enter the verification code.");
        return;
    }

    const formData = new FormData();
    formData.append("code", code);
    formData.append("email", email);

    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                const response = xhr.responseText.trim();
                alert(response);
                if (response === "success") {
                    // Move to step 3
                    document.getElementById('step2-content').style.display = 'none';
                    document.getElementById('step3-content').style.display = 'block';
                    document.getElementById('resetEmail').value = email;
                    document.getElementById('resetCode').value = code;

                    // Update step indicator
                    document.getElementById('step2').classList.remove('active');
                    document.getElementById('step2').classList.add('completed');
                    document.getElementById('line2-3').classList.add('completed');
                    document.getElementById('step3').classList.add('active');

                } else {
                    alert("Invalid code." + response);
                }
            } else {
                alert("Request failed. Status: " + xhr.status);
            }
        }
    };
    xhr.open("POST", "VerifyProcess.php", true);
    xhr.send(formData);
}


function resetpassword(event) {
    event.preventDefault();

    var code = document.getElementById("resetCode");
    var newPassword = document.getElementById("new_password");
    var confirmPassword = document.getElementById("confirm_password");

    // alert(code.value);
    // alert(newPassword.value);
    // alert(confirmPassword.value);

    var f = new FormData();
    f.append("c", code.value);
    f.append("np", newPassword.value);
    f.append("cp", confirmPassword.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {
                alert("Successfully Reset Your Password!");
                window.location = "login.php";
            } else {
                alert(t);
            }
        }
    };

    r.open("POST", "ResetPasswordProcess.php", true);
    r.send(f);

}


function saveThumbnail(event) {
    event.preventDefault();
    var course = document.getElementById("courseCode").value.trim();;
    var img = document.getElementById("courseThumbnail");

    var f = new FormData();
    f.append("img", img.files[0]);
    f.append("c", course);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText.trim();
            //alert(t);
            if (t == "Success") {
                alert("Successfully Uploaded Image");
                window.location.reload();
            } else {
                alert("Error : " + t);
            }
        }
    };
    r.open("POST", "CourseImgUpload.php", true);
    r.send(f);
}

//////////Search Options /////////////////////
function searchbyTyping(event) {
    event.preventDefault();

    var search = document.getElementById("courseSearch").value.trim();

    var r = new XMLHttpRequest();
    var f = new FormData();
    f.append("search", search);

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText.trim();
            //alert(t);

            document.getElementById("courseContent").innerHTML = t;

        }
    };
    r.open("POST", "SearchByTyping.php", true);
    r.send(f);
}
function changeInstructorSearch(event) {
    event.preventDefault();

    var search = document.getElementById("levelFilter").value.trim();

    var r = new XMLHttpRequest();
    var f = new FormData();
    f.append("search", search);

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText.trim();
            //alert(t);

            document.getElementById("courseContent").innerHTML = t;

        }
    };
    r.open("POST", "SearchByInstructor.php", true);
    r.send(f);
}
function changeCourseSearch(event) {
    event.preventDefault();

    var search = document.getElementById("departmentFilter").value.trim();

    var r = new XMLHttpRequest();
    var f = new FormData();
    f.append("search", search);

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText.trim();
            //alert(t);

            document.getElementById("courseContent").innerHTML = t;

        }
    };
    r.open("POST", "SearchByCourse.php", true);
    r.send(f);
}

////////adminprofile////////////
function updateAdminProfile(event) {
    event.preventDefault();

    var fname = document.getElementById("firstName").value.trim();
    var lname = document.getElementById("lastName").value.trim();
    var uname = document.getElementById("username").value.trim();
    var pw = document.getElementById("password").value.trim();
    var email = document.getElementById("email").value.trim();
    var img = document.getElementById("profileImage");


    var r = new XMLHttpRequest();
    var f = new FormData();
    f.append("fname",fname);
    f.append("lname",lname);
    f.append("uname",uname);
    f.append("pw",pw);
    f.append("email",email);
    f.append("img",img.files[0]);

    r.onreadystatechange = function(){
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText.trim();
            alert(t);
            window.location.reload();
        }
    };
    r.open("POST","AdminProfileUpdateProcess.php",true);
    r.send(f);
}

