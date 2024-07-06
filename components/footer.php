<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Example</title>
    <style>
        /* General footer styling */
        .page-footer {
            background-color: #222227;
            color: white;
            padding-top: 1rem;
            padding-bottom: 2rem;
        }

        /* Grid and text alignment */
        .container-fluid {
            max-width: 1140px;
            margin: auto;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-md-6,
        .col-md-3,
        .col-md-12 {
            padding: 3rem;
            flex: 1;
        }

        /* Column specific styles */
        .col-md-6 h5,
        .col-md-3 h5 {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 2rem;
        }

        .col-md-6 p {
            line-height: 1.5;
            font-size: 1.5rem;
        }

        /* Unordered list styles */
        ul.list-unstyled {
            padding: 0;
            list-style: none;
        }

        ul.list-unstyled li {
            margin-bottom: 0.5rem;
        }

        ul.list-unstyled li a {
            color: white;
            text-decoration: none;
            transition: color 0.3s;
        }

        ul.list-unstyled li a:hover {
            color: yellow;
        }

        .flex-center a {
            color: white;
            transition: color 0.3s;
        }

        .flex-center a:hover {
            color: #ffcccb;
        }

        /* Divider */
        hr.clearfix {
            border-top: 1px solid white;
            margin-top: 1rem;
            margin-bottom: 1rem;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .col-md-6,
            .col-md-3,
            .col-md-12 {
                flex: 100%;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>

<footer class="page-footer">

    <!-- Footer Links -->
    <div class="container-fluid text-center text-md-left">

        <!-- Grid row -->
        <div class="row">

            <!-- Left Section -->
            <div class="col-md-3 mt-md-0 mt-3">
                <div class="food_image_form">
                    <img src="./images/logo.png" alt="Traditional Moroccan Food" class="form_image" style="height:120px; width:250px;">
                    <div class="clearfix"></div>
                    <form action="#" class="food_image_form" novalidate="true">
                        <!-- Form content can go here -->
                    </form>
                </div> <br> <br>
                <h5 class="text-uppercase"></h5>
                <h1>Cooking unites people globally through food universal <br> force that fosters togetherness across cultures.</h1>
            </div>

            <!-- Middle Section -->
            <div class="col-md-6 mb-md-0 mb-3">
                <div class="row">
                    <!-- Middle Left Section -->
                    <div class="col-md-6 mb-md-0 mb-3">
                        <h5 class="text-uppercase">Contact Us</h5>
                        <ul class="list-unstyled">
                            <li><a href="mailto:zlayji29@gmail.com"><i class="fas fa-envelope-open mr-3"></i>zlayji29@gmail.com</a></li>
                            <li><a href="#!"><i class="fas fa-location-arrow mr-3"></i>CASABLANCA SIDI Maarouf</a></li>
                            <li><a href="https://wa.me/+212656516562"><i class="fas fa-tty mr-3"></i>+212656516562</a></li>
                        </ul>
                    </div>

                    <!-- Middle Right Section -->
                    <div class="col-md-6 mb-md-0 mb-3">
                        <h5 class="text-uppercase">OPENING HOURS</h5>
                        <ul class="list-unstyled">
                            <li><a href="#!">07:00 AM-11:00 PM</a></li>
                           
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Right Section -->
            <div class="col-md-3 mb-md-0 mb-3">
                <div class="row">
                    <div class="col-md-12 py-5 text-right">
                        <h5 class="text-uppercase">Traditional Food</h5>
                        <br>
                        <div class="food_image_form">
                            <img src="./uploaded_img/logo_brand.jpg" alt="Traditional Moroccan Food" class="form_image" style="height:250px; width:230px;">
                            <div class="clearfix"></div>
                            <form action="#" class="food_image_form" novalidate="true">
                                <!-- Form content can go here -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Grid row -->

    </div>
    <!-- Footer Links -->

    <!-- Font Awesome CDN -->
   
</footer>

</body>
</html>



<div class="loader">
   <img src="images/loader.gif" alt="">
</div>