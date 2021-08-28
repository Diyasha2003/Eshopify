<?php 
/* 
 * PayPal and database configuration
 */
  
// PayPal configuration 
define('PAYPAL_ID', 'sb-7oecf7398913@business.example.com'); 
define('PAYPAL_SANDBOX', true); //TRUE or FALSE 
 
define('PAYPAL_RETURN_URL', 'https://eshopify-app-paypal.herokuapp.com/success.php'); 
define('PAYPAL_CANCEL_URL', 'https://eshopify-app-paypal.herokuapp.com/cancel.php'); 
define('PAYPAL_CURRENCY', 'USD'); 
 
// Database configuration 
define('DB_HOST', 'remotemysql.com'); 
define('DB_USERNAME', 'x4UzzI677H'); 
define('DB_PASSWORD', '7rBMTELJPn'); 
define('DB_NAME', 'x4UzzI677H'); 
 
// Change not required 
define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr"
:"https://www.paypal.com/cgi-bin/webscr");

// define('PAYPAL_URL',"https://www.paypal.com/cgi-bin/webscr");

?>