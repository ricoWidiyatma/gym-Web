<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- navbar section   -->

    <header class="navbar-section">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><i class="bi bi-chat"></i> Gatot Gym</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#about-us">about us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="signup.php">signup</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- hero section  -->

    <section id="home" class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 text-content">
                    <h1>Welcome to Gatot-Gym</h1>
                    <p> Stay Healthy and Always Feeling Strong
                    </p>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <img src="images/download.jpg" alt="" class="img-fluid">
                </div>

            </div>
        </div>
    </section>

 <!-- about us  -->
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12"id="about-us">
            <h1>About Us</h1>
            <p>Gatot Gym is a fitness center that provides various facilities and equipment to help you achieve your fitness goals. We have a team of experienced and friendly trainers.</p>
            <p>We offer a range of fitness programs, including weight training, cardio, and yoga. We also have facilities such as changing rooms, showers, and ample parking.</p>
            <p>At Gatot Gym, we are committed to helping you achieve your fitness goals and improving your quality of life. We believe that fitness is the key to a healthy and happy life.</p>
            <p>Address : Yogyakarta, Bantul, xxx, jl.xxx no.xxx</p>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12" id="contact">
            <h1>Contact</h1>
            <ul>
                <li><i class="fa fa-phone"></i> Phone Number: 0812-345-678-90</li>
                <li><i class="fa fa-whatsapp"></i> WhatsApp Number: 0812-345-678-90</li>
                <li><i class="fa fa-instagram"></i> Instagram: @gatotgym</li>
            </ul>
        </div>
    </div>
</div>
    <!-- footer section  -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <p class="logo"><i class="bi bi-chat"></i> Gatot Gym</p>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <ul class="d-flex">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">services</a></li>
                        <li><a href="#">projects</a></li>
                        <li><a href="#">about us</a></li>
                        <li><a href="#">contact</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-12 col-sm-12">
                    <p>&copy;2024_GatotGym</p>
                </div>

                <div class="col-lg-1 col-md-12 col-sm-12">
                    <!-- back to top  -->

                    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                            class="bi bi-arrow-up-short"></i></a>
                </div>

            </div>

        </div>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>
