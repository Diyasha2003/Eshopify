
<!--------Connect to the database----------------->
<?php

include_once("connection.php");

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
            <h1>My Orders</h1>
        </div>
        <div style="margin-top: 20px;padding: 20px;">
            <div class="table-responsive" style="background: rgba(217,217,217,0.34);border-radius: 16px;padding: 15px;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Payment ID</th>
                            <th>Payment Date/Time</th>
                            <th>Item ID</th>
                            <th>Payment Gross</th>
                            <th>Curr</th>
                            <th>Payment Status</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php 

                    $sql = "SELECT * FROM payments ";
                    $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));

                    while($row = mysqli_fetch_assoc($resultset))
                    {
                        $id = $row["payment_id"];
                        $itemNo = $row["item_number"];
                        $qty = $row["payment_gross"];
                        $curr = $row["currency_code"];
                        $status = $row["payment_status"];
                        $time = $row["date_time"];
                        echo"<tr>";
                            echo"<td>$id</td>";
                            echo"<td>$time</td>";
                            echo"<td>$itemNo</td>";
                            echo"<td>$qty</td>";
                            echo"<td>$curr</td>";
                            echo"<td>$status</td>";
                        echo" </td>";
                    }
                            
                    ?>
                    
                    </tbody>
                </table>
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