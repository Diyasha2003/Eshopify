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
  <div style="margin: 0;">
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button" style="padding-top: 0px;padding-bottom: 0px;margin-top: -50px;">
      <div class="container"><a class="navbar-brand" href="index.php">EShopify</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
          <ul class="navbar-nav me-auto">
            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link active" href="Items.php">Items</a></li>
            <li class="nav-item"><a class="nav-link" href="AboutUs.php">About Us</a></li>
            <li class="nav-item"><a class="nav-link" href="Orders.php">Orders</a></li>
          </ul>
        </div>
      </div>
    </nav>
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
            <div class="block span3" style=" background-color: #f1f1f1; ">
              <div class="product">
                <img src="<?php echo $row['item_image']; ?>" height="295px" width="200px" />
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

                  <input class="pull-right" type="image" name="submit" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif">
                  <br>

                </form>

              </div>


            </div>
          </div>

        <?php } ?>
      </div>
    </div>
  </div>

  <div>
    <footer class="footer-basic">
      <div class="social"><a href="#"><i class="icon ion-social-instagram"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-facebook"></i></a></div>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="index.php">Home</a></li>
        <li class="list-inline-item"><a href="Items.php">Items</a></li>
        <li class="list-inline-item"><a href="AboutUs.php">About</a></li>
        <li class="list-inline-item"><a href="PrivacyPolicy.php">Privacy Policy</a></li>
      </ul>
      <p class="copyright">Company Name © 2021</p>
    </footer>
  </div>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>