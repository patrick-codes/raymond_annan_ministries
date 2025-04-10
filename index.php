<?php
include '../raymond_annan_ministries/php/functions.php';

// Connect to the database
$pdo = pdo_connect_mysql();

// Pagination logic
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 5;

// Get total number of contacts
$num_contacts = $pdo->query('SELECT COUNT(*) FROM contacts')->fetchColumn();

// Calculate the total number of pages
$total_pages = ceil($num_contacts / $records_per_page);

// Ensure that the current page is within the valid range
$page = max(1, min($page, $total_pages));

// Calculate the offset for the SQL query
$offset = ($page - 1) * $records_per_page;

// Fetch contacts data for the current page
$stmt = $pdo->prepare('SELECT * FROM contacts ORDER BY id LIMIT :offset, :records_per_page');
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':records_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Tooplate">
    <title>Raymond Annang Ministries</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">
    <link href="css/magnific-popup.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">


</head>

<body id="section_1">
    <header class="site-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-5 col-7">
                    <p class="text-white mb-0">
                        <i class="bi-clock site-header-icon me-2"></i>
                        Mon-Sun. 10:00-19:00
                    </p>
                </div>
               
                <div class="col-lg-2 col-md-3 col-5">
                    <p class="text-white mb-0">
                        <a href="tel: 0245-513-607" class="text-white">
                            <i class="bi-telephone site-header-icon me-2"></i>
                            0245-513-607
                        </a>
                    </p>
                </div><div class="col-lg-2 col-md-3 col-5">
                    <p class="text-white mb-0">
                        <a href="tel: 0260-812-576" class="text-white">
                            <i class="bi-whatsapp site-header-icon me-2"></i>
                            0260-812-576
                        </a>
                    </p>
                </div>
                <div class="col-lg-2 col-md-3 col-5">
                    <p class="text-white mb-0">
                       
                    </p>
                    <img src="images/Ghana-Flag-Download-PNG-Image.png" alt="Logo" width="20" height="20">
                    <img src="images/circle-flag-of-usa-free-png.webp" alt="Logo" width="20" height="20">
                    <img src="images/circle-flag-of-canada-free-png.webp" alt="Logo" width="20" height="20">
                    <img src="images/england-circle-512.webp" alt="Logo" width="20" height="20">
                    <img src="images/flag-3d-round-250.png" alt="Logo" width="20" height="20">

                </div>
                <div class="col-lg-3 col-md-3 col-12 ms-auto">
                    <ul class="social-icon">
                        <li><a href="https://facebook.com/" class="social-icon-link bi-facebook"></a></li>

                        <li><a href="https://pinterest.com/" class="social-icon-link bi-pinterest"></a></li>

                        <li><a href="https://twitter.com/" class="social-icon-link bi-twitter"></a></li>

                        <li><a href="https://www.youtube.com/" class="social-icon-link bi-youtube"></a></li>
                    </ul>
                </div>
                
            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg bg-white shadow-lg">
        <div class="container">

            <a href="#" class="navbar-brand">Raymond Annang <span class="text-danger">Ministries Intl.</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="#section_1"><small class="small-title"><strong
                                    class="text-warning"></strong></small> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="#section_2"><small class="small-title"><strong
                                    class="text-warning"></strong></small> Mission</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="#section_3"><small class="small-title"><strong
                                    class="text-warning"></strong></small> iPray</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="#section_4"><small class="small-title"><strong
                                    class="text-warning"></strong></small> Gallery</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="#"><small class="small-title"><strong
                                    class="text-warning"></strong></small> Prophetic declarations</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="#section_5"><small class="small-title"><strong
                                    class="text-warning"></strong></small> Contact</a>
                    </li>
                </ul>
                <div>
                </div>
    </nav>

    <main>

        <section class="hero">
            <div class="container-fluid h-100">
                <div class="row h-100">
                    <div id="carouselExampleCaptions" class="carousel carousel-fade hero-carousel slide"
                        data-bs-ride="carousel">
                        <div class="carousel-inner">
                        <?php foreach ($contacts as $contact): ?>

                            <div class="carousel-item active">
                                <div class="container position-relative h-100">
                                    <div class="carousel-caption d-flex flex-column justify-content-center">
                                        <small class="small-title"><?=$contact['name']?> <strong
                                                class="text-warning">21/03/24</strong></small>

                                        <h1>Be A Partner <span class="text-warning">Of Hope</span></h1>

                                        <div class="d-flex align-items-center mt-4">
                                            <a class="custom-btn btn custom-link" href="#section_2">Prayer Request</a>

                                            <a class="popup-youtube custom-icon d-flex ms-4"
                                                href="https://www.youtube.com/watch?v=2un2PHmbnuM">
                                                <i class="bi-play play-icon d-flex m-auto text-white"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="carousel-image-wrap">
                                <?php  ($contact['image'])?>
                                    <img src="<?=$contact['image']?>"
                                        class="img-fluid carousel-image" alt="">

                                </div>
                                <?php endforeach; ?>

                            </div>             
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>

                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        
                    </div>
                </div>

            </div>
          
        </section>

        <section class="about section-padding" id="section_2">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-12 mb-5 mb-lg-0">
                        <div class="about-image-wrap h-100">
                            <img src="images/346884714_569881641943009_200618841826670287_n.jpg" class="img-fluid about-image" alt="">

                            <div class="about-image-info">
                                <h4 class="text-white">Raymond Annang Ministries</h4>

                                <p class="text-white mb-0">The Resurrection is evidence of a trustworthy God who relentlessly pursues us with His love. It is not the end of the story, but it’s 
                                    proof that we can trust the rest of the story! Come hear this Easter at Raymond Annang Ministries.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-12 d-flex flex-column">
                        <div class="about-thumb bg-white shadow-lg">

                            <div class="about-info">
                                <small class="small-title">Mission <strong class="text-warning">of the ministry</strong></small>

                                <h2 class="mb-3">Church Ministry</h2>

                                <h5 class="mb-3">Helping the church</h5>

                                <p>We exist to equip the Church with a vision for authentic community, where responsibility, accountability, and compassion are second nature and caring for children and adult survivors of abuse is non-negotiable. 

                                    We believe with proper education and training every church and faith organization can effectively navigate its responsibility to appropriately care for those who have been impacted by abuse.
                                    
                                    Click the button below to learn more..</p>

                                <p>You may support a little donation to the ministry by visiting our <a
                                        href="">contact page</a>. Thank you.</p>
                            </div>
                        </div>

                        <div class="row h-100">
                            <div class="col-lg-6 col-6">
                                <div
                                    class="about-thumb d-flex flex-column justify-content-center bg-danger mb-lg-0 h-100">

                                    <div class="about-info">
                                        <h5 class="text-white mb-4">Be a partner of hope</h5>

                                        <a class="custom-btn btn custom-bg-primary" href="project-detail.html">Join us</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-6">
                                <div
                                    class="about-thumb d-flex flex-column justify-content-center bg-warning mb-lg-0 h-100">

                                    <div class="about-info">
                                        <h5 class="text-white mb-4">We're a growing ministry</h5>

                                        <p class="text-white mb-0">Lets join hands to worhsip God</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
 
        <section class="projects section-padding pb-0" id="section_4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-12 text-center mx-auto mb-5">
                        <small class="small-title">Upcoming & Previous <strong class="text-warning">Events</strong></small>

                        <h2>Upcoming Programs</h2>
                    </div>

                    <div class="col-lg-4 col-12">
                        <div class="projects-thumb projects-thumb-small">
                            <a href="project-detail.html">
                                <img src="images/projects/365777242_186620011096174_8456257540526955612_n.jpg"
                                    class="img-fluid projects-image" alt="">

                                <div class="projects-info">
                                    <div class="projects-title-wrap">
                                        <small class="projects-small-title">Business</small>

                                        <h2 class="projects-title">MCL Group</h2>
                                    </div>

                                    <div class="projects-btn-wrap mt-4">
                                        <span class="custom-btn btn">
                                            <i class="bi-arrow-right"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-12">
                        <div class="projects-thumb projects-thumb-small">
                            <a href="project-detail.html">
                                <img src="images/projects/431082218_321099977648176_9078004414757112296_n.jpg"
                                    class="img-fluid projects-image" alt="">

                                <div class="projects-info">
                                    <div class="projects-title-wrap">
                                        <small class="projects-small-title">Strategy Planning</small>

                                        <h2 class="projects-title">Fredi</h2>
                                    </div>

                                    <div class="projects-btn-wrap mt-4">
                                        <span class="custom-btn btn" href="project-detail.html">
                                            <i class="bi-arrow-right"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-12">
                        <div class="projects-thumb projects-thumb-small">
                            <a href="project-detail.html">
                                <img src="images/projects/365777242_186620011096174_8456257540526955612_n.jpg"
                                    class="img-fluid projects-image" alt="">

                                <div class="projects-info">
                                    <div class="projects-title-wrap">
                                        <small class="projects-small-title">Video Content</small>

                                        <h2 class="projects-title">Banana</h2>
                                    </div>

                                    <div class="projects-btn-wrap mt-4">
                                        <span class="custom-btn btn" href="project-detail.html">
                                            <i class="bi-arrow-right"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-8 col-12">
                        <div class="projects-thumb projects-thumb-large">
                            <a href="project-detail.html">
                                <img src="images/projects/382774859_211498718608303_5337786537080026091_n.jpg"
                                    class="img-fluid projects-image" alt="">

                                <div class="projects-info">
                                    <div class="projects-title-wrap">
                                        <small class="projects-small-title">Video Content</small>

                                        <h2 class="projects-title">Conference</h2>
                                    </div>

                                    <div class="projects-btn-wrap mt-4">
                                        <span class="custom-btn btn" href="project-detail.html">
                                            <i class="bi-arrow-right"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-12">
                        <div class="projects-thumb projects-thumb-small">
                            <a href="project-detail.html">
                                <img src="images/projects/361169320_165956686495840_5982069221410361323_n.jpg"
                                    class="img-fluid projects-image" alt="">

                                <div class="projects-info">
                                    <div class="projects-title-wrap">
                                        <small class="projects-small-title">Business</small>

                                        <h2 class="projects-title">Maldon</h2>
                                    </div>

                                    <div class="projects-btn-wrap mt-4">
                                        <span class="custom-btn btn" href="project-detail.html">
                                            <i class="bi-arrow-right"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="services section-padding" id="section_3">
            <div class="container">
                <div class="row">

                    <div class="col-lg-10 col-12 text-center mx-auto mb-5">
                        <small class="small-title">Services <strong class="text-warning">03/05</strong></small>

                        <h2>How can we help you?</h2>

                    </div>

                    <div class="col-lg-6 col-12">
                        <nav>
                            <div class="nav nav-tabs flex-column align-items-baseline" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-business-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-business" type="button" role="tab" aria-controls="nav-business"
                                    aria-selected="true">
                                    <h3>Business Consulting</h3>

                                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut dolore</span>
                                </button>

                                <button class="nav-link" id="nav-strategy-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-strategy" type="button" role="tab" aria-controls="nav-strategy"
                                    aria-selected="false">
                                    <h3>Strategy Planning</h3>

                                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut dolore</span>
                                </button>

                                <button class="nav-link" id="nav-video-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-video" type="button" role="tab" aria-controls="nav-video"
                                    aria-selected="false">
                                    <h3>Video Content</h3>

                                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut dolore</span>
                                </button>
                            </div>
                        </nav>
                    </div>

                    <div class="col-lg-6 col-12">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-business" role="tabpanel"
                                aria-labelledby="nav-intro-tab">
                                <img src="images/services/young-entrepreneurs-mature-investor-watching-presentation-discussing-project.jpg"
                                    class="img-fluid" alt="">

                                <h5 class="mt-4 mb-2">Introduction to Business Consulting</h5>

                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut dolore</p>

                                <ul>
                                    <li>Helping small businesses</li>

                                    <li>Lorem ipsum dolor sit amet</li>

                                    <li>Business Strategy and Management</li>
                                </ul>
                            </div>

                            <div class="tab-pane fade show" id="nav-strategy" role="tabpanel"
                                aria-labelledby="nav-strategy-tab">
                                <img src="images/services/startup-leader-drawing-flowchart-board-discussing-project.jpg"
                                    class="img-fluid" alt="">

                                <h5 class="mt-4 mb-2">Strategy Planning</h5>

                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                            tempor dolore</p>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                            tempor dolore</p>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade show" id="nav-video" role="tabpanel"
                                aria-labelledby="nav-video-tab">
                                <img src="images/services/portrait-smiling-african-american-young-woman-holding-movie-production-blackboard.jpg"
                                    class="img-fluid" alt="">

                                <h5 class="mt-4 mb-2">Video Content</h5>

                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut dolore</p>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="contact" id="section_5">

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#f9c10b" fill-opacity="1"
                    d="M0,288L48,272C96,256,192,224,288,197.3C384,171,480,149,576,165.3C672,181,768,235,864,250.7C960,267,1056,245,1152,250.7C1248,256,1344,288,1392,304L1440,320L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
            </svg>

            <div class="contact-container-wrap">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-12">
                            <form class="custom-form contact-form" action="" method="post" role="form">
                                <small class="small-title">Contact <strong class="text-white">05/05</strong></small>

                                <h2 class="mb-5">Say Hi to us</h2>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Your Name" required="">
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12">
                                        <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*"
                                            class="form-control" placeholder="your@email.com" required="">
                                    </div>

                                    <div class="col-12">
                                        <textarea class="form-control" rows="7" id="message" name="message"
                                            placeholder="Message"></textarea>

                                        <button type="submit" class="form-control">Submit</button>
                                    </div>

                                </div>
                            </form>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="contact-thumb">

                                <div class="contact-info bg-white shadow-lg">
                                    <h4 class="mb-4">Dansoman Blue Lagoon Street</h4>

                                    <h4 class="mb-2">
                                        <a href="tel: 240-480-9600">
                                            <i class="bi-telephone contact-icon me-2"></i>
                                            (+233) 245-513-607
                                        </a>
                                    </h4>

                                    <h5>
                                        <a href="mailto:info@company.com" class="footer-link">
                                            <i class="bi-envelope-fill contact-icon me-2"></i>
                                            raymondannanggministries@gmail.com
                                        </a>
                                    </h5>

                                    

                                    <iframe class="google-map mt-4"
                                        src=" https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3970.928877974785!2d-0.31161099672320397!3d5.577532785840671!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfdfa34f7779a35f%3A0xc85f51db92eac8b0!2sGbawe%20Chief%20Palace!5e0!3m2!1sen!2sgh!4v1711113944687!5m2!1sen!2sgh"
                                        width="100%" height="300" allowfullscreen="" loading="lazy"></iframe>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </main>

    <footer class="site-footer">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-12">
                    <div class="site-footer-wrap d-flex align-items-center">
                        <p class="copyright-text mb-0 me-4">Copyright © 2024 Raymond Annang Ministries Inc.</p>

                        <ul class="social-icon">
                            <li><a href="https://facebook.com/tooplate" class="social-icon-link bi-facebook"></a></li>

                            <li><a href="https://pinterest.com/tooplate" class="social-icon-link bi-pinterest"></a></li>

                            <li><a href="https://twitter.com/minthu" class="social-icon-link bi-twitter"></a></li>

                            <li><a href="https://www.youtube.com/tooplate" class="social-icon-link bi-youtube"></a></li>
                        </ul>

                    </div>
                </div>

               

            </div>
        </div>
    </footer>
   <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/magnific-popup-options.js"></script>
    <script src="js/click-scroll.js"></script>
    <script src="js/custom.js"></script>

</body>

</html>
