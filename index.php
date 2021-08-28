<!--------Connect to the database----------------->
<?php

include_once("connection.php");
include_once("paypal.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Eshopify</title>
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="assets/css/Features-Boxed.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="assets/css/Header-Blue.css">
    <link rel="stylesheet" href="assets/css/Highlight-Phone.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Map-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/Shop-item-1.css">
    <link rel="stylesheet" href="assets/css/Shop-item.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Team-Boxed.css">
</head>

<body>

<!-- header Main menu-->
    <div style="margin: 0;">
        <nav class="navbar navbar-light navbar-expand-md navigation-clean-button" style="padding-top: 0px;padding-bottom: 0px;margin-top: -50px;">
            <div class="container"><a class="navbar-brand" href="index.php">EShopify</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="Items.php">Items</a></li>
                        <li class="nav-item"><a class="nav-link" href="AboutUs.php">About Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="Orders.php">Orders</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <!-- body content -->
    <div>

        <!-- header  section-->
        <div>
            <section class="highlight-phone">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="intro">
                                <h2>Start Shopping Now...</h2>
                                <p>EShopify is a online platform which sells products related to different categories. You can access any product from any device and we have multiple device compatibility feature.&nbsp;</p>
                                <a class="btn btn-primary" role="button" href="Items.php">Start Shopping</a>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="d-none d-md-block phone-mockup">
                                <img class="device" src="assets/img/cyber-monday-retail-sales.png" style="width: 456px;margin-top: -137px;transform: rotate(19deg);"></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div>
            <h2 class="text-center" style="margin-top: 26px;">Latest Products</h2>
        </div>

        <!-- products section -->
        <div>
            <div class="container">
                <div class="row d-flex justify-content-center">

                    <!-- get all items from Database -->
                    <?php
                        $sql = "SELECT * FROM items";
                        $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));

                        while ($row = mysqli_fetch_assoc($resultset)) {
                    ?>

                    <!-- Item card -->
                        <div class="col-md-3" style="margin: 20px;">
                            <div class="block span3"  style=" background-color: #f1f1f1;">
                                <div class="product">
                                    <img src="<?php echo $row['item_image']; ?>" height="295px" width="190px" />
                                </div>

                                <div class="info">
                                    <h4><?php echo $row['item_name']; ?></h4>
                                    <span class="description">
                                        <?php echo substr($row['item_description'], 0, 100); ?>...
                                    </span>
                                    <span class="price">$<?php echo $row['item_price']; ?></span>
                                    
                                    <!-- PayPal payment form for displaying the buy button -->
                                    <form action="<?php echo PAYPAL_URL; ?>" method="post">
                                        <!-- Identify your business so that you can collect the payments. -->
                                        <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">
                                        
                                        <!-- Specify a Buy Now button. -->
                                        <input type="hidden" name="cmd" value="_xclick">
                                        
                                        <!-- Specify details about the item that buyers will purchase. -->
                                        <input type="hidden" name="item_name" value="<?php echo $row['item_name']; ?>">
                                        <input type="hidden" name="item_number" value="<?php echo $row['item_id']; ?>">
                                        <input type="hidden" name="amount" value="<?php echo $row['item_price']; ?>">
                                        <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">
                                        
                                        <!-- Specify URLs -->
                                        <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
                                        <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">
                                        
                                        <!-- Display the payment button. -->

                                        <input class="pull-right" type="image" name="submit" border="0" 
                                            src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif">
                                        <br>
                                    
                                    </form>

                                </div>


                            </div>
                        </div>
                    
                    <?php } ?>

                </div>
            </div>
        </div>

        <!-- Features  -->
        <div>
            <section class="features-boxed">
                <div class="container">
                    <div class="intro">
                        <h2 class="text-center">Features </h2>
                        <p class="text-center">Our New features with latest technology.</p>
                    </div>
                    <div class="row justify-content-center features">
                        <div class="col-sm-6 col-md-5 col-lg-4 item">
                            <div class="box"><i class="fa fa-map-marker icon"></i>
                                <h3 class="name">Works everywhere</h3>
                                <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-5 col-lg-4 item">
                            <div class="box"><i class="fa fa-clock-o icon"></i>
                                <h3 class="name">Always available</h3>
                                <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-5 col-lg-4 item">
                            <div class="box"><i class="fa fa-list-alt icon"></i>
                                <h3 class="name">Customizable </h3>
                                <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-5 col-lg-4 item">
                            <div class="box"><i class="fa fa-leaf icon"></i>
                                <h3 class="name">Organic </h3>
                                <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-5 col-lg-4 item">
                            <div class="box"><i class="fa fa-plane icon"></i>
                                <h3 class="name">Fast </h3>
                                <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-5 col-lg-4 item">
                            <div class="box"><i class="fa fa-phone icon"></i>
                                <h3 class="name">Mobile-first</h3>
                                <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- footer -->
    <div>
        <footer class="footer-basic">
            <div class="social"><a href="#"><i class="icon ion-social-instagram"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-facebook"></i></a></div>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="index.php">Home</a></li>
                <li class="list-inline-item"><a href="Items.php">Items</a></li>
                <li class="list-inline-item"><a href="AboutUs.php">About</a></li>
                <li class="list-inline-item"><a href="PrivacyPolicy.php">Privacy Policy</a></li>
            </ul>
            <p class="copyright">Eshopify © 2021</p>
        </footer>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>