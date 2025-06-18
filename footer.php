<!-- Footer -->
<footer class="text-white pt-5 pb-4">
    <div class="container">
        <div class="row">
            <!-- Logo and About -->
            <div class="col-md-4 mb-4 mb-md-0">
                <img src="resources/logo.png" alt="Vertex Institute Logo" width="180" class="mb-3 rounded-circle">
                <p>Vertex Institute of Advanced Technology is a premier institution dedicated to
                    excellence in technology education and research.</p>
            </div>

            <!-- Quick Links -->
            <div class="col-md-2 mb-4 mb-md-0">
                <h5 class="mb-3">Quick Links</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none link-hover">Home</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none link-hover">About</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none link-hover">Programs</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none link-hover">Admissions</a></li>
                    <li><a href="#" class="text-white text-decoration-none link-hover">Contact</a></li>
                </ul>
            </div>

            <!-- Programs -->
            <div class="col-md-3 mb-4 mb-md-0">
                <h5 class="mb-3">Programs</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none link-hover">Computer Science</a>
                    </li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none link-hover">Artificial
                            Intelligence</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none link-hover">Data Science</a>
                    </li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none link-hover">Cybersecurity</a>
                    </li>
                    <li><a href="#" class="text-white text-decoration-none link-hover">Robotics</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="col-md-3 mb-4 mb-md-0">
                <h5 class="mb-3">Newsletter</h5>
                <p>Stay up to date with our latest news and programs.</p>
                <form class="mb-3">
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Your Email" aria-label="Email" id="newsletterEmail" required>
                        <button class="btn btn-primary" type="button" onclick="subscribe();">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Divider -->
        <hr class="mt-4 mb-4" style="border-color: rgba(255,255,255,0.1);">

        <!-- Date -->
         <?php 
         $currentYear = date("Y");
         
         ?>

        <!-- Bottom Links -->
        <div class="row">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-0">&copy; <?php echo $currentYear;?> Vertex Institute of Advanced Technology. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <a href="#" class="text-white text-decoration-none me-3 link-hover">Privacy Policy</a>
                <a href="#" class="text-white text-decoration-none link-hover">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>