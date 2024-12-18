<?php
session_start();

include("connection.php");

if (!isset($_SESSION['username'])) {
    header("location:login.php");
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- navbar section   -->

    <header class="navbar-section">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="bi bi-lightning"></i> Gatot Gym</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#about-us">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact</a>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <a class='nav-link dropdown-toggle' href='edit.php?id=$res_id' id='dropdownMenuLink'
                                    data-bs-toggle='dropdown' aria-expanded='false'>
                                    <i class='bi bi-person'></i>
                                </a>


                                <ul class="dropdown-menu mt-2 mr-0" aria-labelledby="dropdownMenuLink">

                                    <li>
                                        <?php

                                        $id = $_SESSION['id'];
                                        $query = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");

                                        while ($result = mysqli_fetch_assoc($query)) {
                                            $res_username = $result['username'];
                                            $res_email = $result['email'];
                                            $res_id = $result['id'];
                                        }


                                        echo "<a class='dropdown-item' href='edit.php?id=$res_id'>Change Profile</a>";


                                        ?>

                                    </li>
                                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                </ul>
                            </div>

                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <div class="name">
        <center>Welcome
            <?php
            // echo $_SESSION['valid'];
            
            echo $_SESSION['username'];

            ?>
            !
        </center>

    <!-- hero section  -->
    </div>
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 text-content">
                    <h1>Welcome to Gatot-Gym</h1>
                    <p> Stay Healthy and Always Feeling Strong
                    </p>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <img src="images/backgatot.jpg" alt="" class="img-fluid">
                </div>

            </div>
        </div>
    </section>
<!-- package section -->
<section id="packages" class="package-section py-5">
    <div class="container">
        <h2 class="text-center mb-4">Choose Your Membership</h2>
        <div class="row">
            <!-- Package 1 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <h5 class="card-title">Basic</h5>
                        <p class="card-text">Join Gatot Membership for 1 Month</p>
                        <p class="card-text fw-bold">Rp 100.000</p>
                        <a href="#" class="btn btn-primary">Choose</a>
                    </div>
                </div>
            </div>
            <!-- Package 2 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <h5 class="card-title">Standard</h5>
                        <p class="card-text">Join Gatot Membership for 2 Month</p>
                        <p class="card-text fw-bold">Rp 180.000</p>
                        <a href="#" class="btn btn-primary">Choose</a>
                    </div>
                </div>
            </div>
            <!-- Package 3 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <h5 class="card-title">Premium</h5>
                        <p class="card-text">Join Gatot Membership for 1 Month and Get a Personal Trainer</p>
                        <p class="card-text fw-bold">Rp 500.000</p>
                        <a href="#" class="btn btn-primary">Choose</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- about us  -->
<div class="container">
    <div class="row" id="aboutandcontact">
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
                    <p class="logo"><i class="bi bi-chat"></i>Gatot Gym</p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <ul class="d-flex">
                        
                    </ul>
                </div>

                <div class="col-lg-2 col-md-12 col-sm-12">
                    <p>&copy;2023 Gatot Gym</p>
                </div>

                <div class="col-lg-1 col-md-12 col-sm-12">
                    <!-- back to top  -->

                    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                            class="bi bi-arrow-up-short"></i></a>
                </div>

            </div>

        </div>

    </footer>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>

</html>
