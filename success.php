<?php
// Include configuration file 
include_once("paypal.php");

// Include database connection file 
include_once("connection.php");

// If transaction data is available in the URL 
if (!empty($_GET['item_number']) && !empty($_GET['tx']) && !empty($_GET['amt']) && !empty($_GET['cc']) && !empty($_GET['st'])) {
    // Get transaction information from URL 
    $item_number = $_GET['item_number'];
    $txn_id = $_GET['tx'];
    $payment_gross = $_GET['amt'];
    $currency_code = $_GET['cc'];
    $payment_status = $_GET['st'];

    $date = new DateTime("now", new DateTimeZone('Asia/Colombo') );
    $time = $date->format('Y-m-d H:i:s');

    // Get product info from the database 
    $productResult = $conn->query("SELECT * FROM items WHERE item_id = '" . $item_number . "'");
    $productRow = $productResult->fetch_assoc();

    // Check if transaction data exists with the same TXN ID. 
    $prevPaymentResult = $conn->query("SELECT * FROM payments WHERE txn_id = '" . $txn_id . "'");

    if ($prevPaymentResult->num_rows > 0) {
        $paymentRow = $prevPaymentResult->fetch_assoc();
        $payment_id = $paymentRow['payment_id'];
        $payment_gross = $paymentRow['payment_gross'];
        $payment_status = $paymentRow['payment_status'];
    } else {
        // Insert tansaction data into the database 
        $insert = $conn->query("INSERT INTO payments(item_number,txn_id,payment_gross,currency_code,payment_status,date_time) VALUES('" . $item_number . "','" . $txn_id . "','" . $payment_gross . "','" . $currency_code . "','" . $payment_status . "','" . $time . "')");
        $payment_id = $conn->insert_id;
    }
} else {
    // $test = "TEst GET";
}

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
                        <li class="nav-item"><a class="nav-link" href="Items.php">Items</a></li>
                        <li class="nav-item"><a class="nav-link" href="AboutUs.php">About Us</a></li>
                        <li class="nav-item"><a class="nav-link active" href="Orders.php">Orders</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div>
        <div class="text-center" style="margin-top: 30px;">
            <h1>Result Order Status</h1>
            <div class="container">
                <div class="status">
                    <?php if (!empty($payment_id)) { ?>
                        <h1 class="success" style="color:green; ">Your Payment has been Successful</h1>

                        <h4>Payment Information</h4>
                        <p><b>Reference Number:</b> <?php echo $payment_id; ?></p>
                        <p><b>Transaction ID:</b> <?php echo $txn_id; ?></p>
                        <p><b>Paid Amount:</b> <?php echo $payment_gross; ?></p>
                        <p><b>Payment Status:</b> <?php echo $payment_status; ?></p>

                    <?php } else { ?>
                        <h1 class="error" style="color:red;">Your Payment has Failed</h1>
                    <?php } ?>
                </div>

                <a class="preview btn btn-large btn-info" href="index.php" class="btn-link">Back to Products</a>
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