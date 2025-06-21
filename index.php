<?php include("connection.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vertex Institute of Advanced Technology</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />

    <style>
        /* Custom CSS */
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
        }

        .alertify,
        .alertify-cover {
            z-index: 9999 !important;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .navbar-brand img {
            height: 40px;
            transition: all 0.3s ease;
        }

        .navbar {
            background-color: var(--primary-color);
            padding: 5px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
            margin: 0 10px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover,
        .nav-link.active {
            color: white;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: white;
            transition: width 0.3s ease;
        }

        /* Hero Slider */
        .hero-slider {
            height: 80vh;
            min-height: 600px;
            margin-top: -20px;
            margin-bottom: 5px;
        }

        .hidden-element {
            display: none !important;
        }

        .carousel-caption {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 20px;
            border-radius: 10px;
            bottom: 30%;
        }

        .carousel-item {
            height: 80vh;
            background-size: cover;
            background-position: center;
        }

        /* Section Styles */
        section {
            padding: 50px 0;
        }

        .section-title {
            position: relative;
            margin-bottom: 50px;
            text-align: center;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: var(--secondary-color);
        }

        /* About Section */
        .about-img {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Programs Section */
        .program-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            height: 100%;
        }

        .program-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .program-card .card-body {
            padding: 30px;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }

        /* Testimonials */
        .testimonial-card {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin: 15px;
        }

        .testimonial-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }

        /* Research Section */
        .research-item {
            margin-bottom: 30px;
        }

        .research-icon {
            font-size: 2rem;
            color: var(--secondary-color);
            margin-bottom: 15px;
        }

        /* Contact Section */
        .contact-info {
            margin-bottom: 30px;
        }

        .contact-icon {
            font-size: 1.5rem;
            color: var(--secondary-color);
            margin-right: 10px;
        }

        .form-control {
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        /* Footer */
        footer {
            background-color: var(--primary-color);
            color: white;
            padding: 30px 0;
        }

        .input-group .btn {
            height: 100%;
        }
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar">
    <?php include("header2.php"); ?>
    <!-- Hero Slider -->
    <section id="home" class="hero-slider">
        <div id="welcomeCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#welcomeCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#welcomeCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#welcomeCarousel" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" style="background-image: url('resources/slider1.jpg')">
                    <div class="carousel-caption d-none d-md-block">
                        <h2>Welcome to Vertex Institute</h2>
                        <p>Shaping the future of technology through innovative education</p>
                    </div>
                </div>
                <div class="carousel-item" style="background-image: url('resources/slider2.jpg')">
                    <div class="carousel-caption d-none d-md-block">
                        <h2>Advanced Research Facilities</h2>
                        <p>State-of-the-art labs for cutting-edge research</p>
                    </div>
                </div>
                <div class="carousel-item" style="background-image: url('resources/slider3.jpeg')">
                    <div class="carousel-caption d-none d-md-block">
                        <h2>Join Our Community</h2>
                        <p>Become part of our global network of innovators</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#welcomeCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#welcomeCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="bg-light pt-5">
        <div class="container">
            <h2 class="section-title">About Our Institute</h2>
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="resources/universitybuilding.jpeg" alt="Campus Building" class="img-fluid about-img">
                </div>
                <div class="col-lg-6">
                    <h3>Vertex Institute of Advanced Technology</h3>
                    <p>Founded in 2010, the Vertex Institute of Advanced Technology has established itself as a premier
                        institution for cutting-edge education and research in technology fields. Our mission is to
                        empower the next generation of innovators and leaders through rigorous academic programs and
                        hands-on learning experiences.</p>
                    <p>With world-class faculty, state-of-the-art facilities, and a commitment to excellence, we provide
                        an environment where students can thrive and push the boundaries of what's possible in
                        technology and science.</p>
                    <div class="row mt-4">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-graduation-cap fa-2x text-primary me-3"></i>
                                <div>
                                    <h5 class="mb-0">5000+</h5>
                                    <p class="mb-0">Graduates</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-flask fa-2x text-primary me-3"></i>
                                <div>
                                    <h5 class="mb-0">120+</h5>
                                    <p class="mb-0">Research Projects</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-chalkboard-teacher fa-2x text-primary me-3"></i>
                                <div>
                                    <h5 class="mb-0">200+</h5>
                                    <p class="mb-0">Faculty Members</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-globe-americas fa-2x text-primary me-3"></i>
                                <div>
                                    <h5 class="mb-0">50+</h5>
                                    <p class="mb-0">Countries Represented</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Section -->
    <section id="programs">
        <div class="container">
            <h2 class="section-title">Our Academic Programs</h2>
            <div class="row">
                <?php
                $rs = DataBase::search("SELECT * FROM `course` INNER JOIN `course_thumbnail` ON `course`.`id` =  `course_thumbnail`.`course_id` LIMIT 3");
                $rows = $rs->num_rows;
                if ($rows > 0) {
                    for ($i = 0; $i < $rows; $i++) {
                        $data = $rs->fetch_assoc();
                        $courseID = $data["id"];
                        ?>
                        <!-- Design Start -->
                        <div class="col-md-4 mb-4">
                            <div class="program-card card">
                                <img src="<?php echo $data["course_thumbnail"]; ?>" class="card-img-top" alt="Computer Science">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $data["course_name"]; ?></h5>
                                    <p class="card-text"><?php echo $data["course_description"]; ?></p>
                                    <a class="btn btn-sm btn-primary" href="#"
                                        onclick="window.location.href='singleCourseView.php?cid=<?php echo $courseID; ?>'">View
                                        Course</a>
                                </div>
                            </div>
                        </div>
                        <!-- Design End -->
                        <?php
                    }
                }
                ?>
            </div>
            <div class="text-center mt-4">
                <a href="viewAllCourses.php" class="btn btn-outline-primary">View All Programs</a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="bg-light">
        <div class="container">
            <h2 class="section-title">Student Feedback</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="testimonial-card text-center">
                        <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Student"
                            class="testimonial-img">
                        <h5>Sarah Johnson</h5>
                        <p class="text-muted">Computer Science, Class of 2022</p>
                        <p>"The hands-on projects and industry collaborations gave me real-world experience that was
                            invaluable when starting my career at a top tech firm."</p>
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card text-center">
                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Student" class="testimonial-img">
                        <h5>Michael Chen</h5>
                        <p class="text-muted">Artificial Intelligence, Class of 2023</p>
                        <p>"The faculty's expertise and the cutting-edge research opportunities exceeded all my
                            expectations. I've published two papers during my studies."</p>
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card text-center">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Student"
                            class="testimonial-img">
                        <h5>Priya Patel</h5>
                        <p class="text-muted">Data Science, Class of 2021</p>
                        <p>"The career services team helped me secure an amazing internship that turned into a full-time
                            position before I even graduated."</p>
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Research Section -->
    <section id="research">
        <div class="container">
            <h2 class="section-title">Ongoing Research</h2>
            <div class="row">
                <div class="col-md-6 col-lg-4 research-item">
                    <div class="text-center">
                        <div class="research-icon">
                            <i class="fas fa-brain"></i>
                        </div>
                        <h4>Neural Networks</h4>
                        <p>Developing next-generation neural architectures for complex problem-solving in healthcare
                            diagnostics and autonomous systems.</p>
                        <a href="https://en.wikipedia.org/wiki/Neural_network"
                            class="btn btn-sm btn-outline-primary">Read More</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 research-item">
                    <div class="text-center">
                        <div class="research-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4>Cybersecurity</h4>
                        <p>Creating advanced cryptographic protocols and intrusion detection systems for next-generation
                            network security.</p>
                        <a href="https://www.cisa.gov/news-events/news/what-cybersecurity"
                            class="btn btn-sm btn-outline-primary">Read More</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 research-item">
                    <div class="text-center">
                        <div class="research-icon">
                            <i class="fas fa-robot"></i>
                        </div>
                        <h4>Robotics</h4>
                        <p>Pioneering work in swarm robotics and human-robot collaboration for industrial and domestic
                            applications.</p>
                        <a href="https://en.wikipedia.org/wiki/Robotics" class="btn btn-sm btn-outline-primary">Read
                            More</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 research-item">
                    <div class="text-center">
                        <div class="research-icon">
                            <i class="fas fa-dna"></i>
                        </div>
                        <h4>Bioinformatics</h4>
                        <p>Applying machine learning to genomic data to accelerate drug discovery and personalized
                            medicine.</p>
                        <a href="https://en.wikipedia.org/wiki/Bioinformatics"
                            class="btn btn-sm btn-outline-primary">Read More</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 research-item">
                    <div class="text-center">
                        <div class="research-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4>Quantum Computing</h4>
                        <p>Exploring quantum algorithms and their potential applications in optimization and
                            cryptography.</p>
                        <a href="https://en.wikipedia.org/wiki/Quantum_computing"
                            class="btn btn-sm btn-outline-primary">Read More</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 research-item">
                    <div class="text-center">
                        <div class="research-icon">
                            <i class="fas fa-solar-panel"></i>
                        </div>
                        <h4>Clean Energy Tech</h4>
                        <p>Developing smart grid technologies and energy storage solutions for sustainable energy
                            systems.</p>
                        <a href="https://en.wikipedia.org/wiki/Clean_technology"
                            class="btn btn-sm btn-outline-primary">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="bg-light">
        <div class="container">
            <h2 class="section-title">Contact Us</h2>
            <div class="row">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <h4>Get in Touch</h4>
                    <p>Have questions about our programs, admissions, or research opportunities? Reach out to us using
                        the information below or fill out the contact form.</p>

                    <div class="contact-info">
                        <div class="d-flex mb-3">
                            <i class="fas fa-map-marker-alt contact-icon"></i>
                            <div>
                                <h5>Address</h5>
                                <p>123 Technology Drive, Innovation City, IC 98765</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <i class="fas fa-phone-alt contact-icon"></i>
                            <div>
                                <h5>Phone</h5>
                                <p>011-12569635</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <i class="fas fa-envelope contact-icon"></i>
                            <div>
                                <h5>Email</h5>
                                <p>info@vertexinstitute.edu</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <i class="fas fa-clock contact-icon"></i>
                            <div>
                                <h5>Office Hours</h5>
                                <p>Monday - Friday: 9:00 AM - 5:00 PM</p>
                            </div>
                        </div>
                    </div>

                    <div class="social-links">
                        <a href="#" class="me-3 text-secondary"><i class="fab fa-facebook-f fa-lg"></i></a>
                        <a href="#" class="me-3 text-secondary"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="me-3 text-secondary"><i class="fab fa-linkedin-in fa-lg"></i></a>
                        <a href="#" class="me-3 text-secondary"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="me-3 text-secondary"><i class="fab fa-youtube fa-lg"></i></a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <form>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" placeholder="Your Name" required id="name" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="email" class="form-control" placeholder="Your Email" required id="email" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Subject" id="subject" required />
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" rows="5" placeholder="Your Message" required
                                id="message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" onclick="sendMsg(event);">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include("footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>

    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });

                document.querySelectorAll('.nav-link').forEach(link => {
                    link.classList.remove('active');
                });
                this.classList.add('active');
            });
        });

        window.addEventListener('scroll', function () {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.padding = '5px 0';
                navbar.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.2)';
            } else {
                navbar.style.padding = '10px 0';
                navbar.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
            }
        });
    </script>
</body>

</html>