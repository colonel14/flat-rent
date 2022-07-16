<?php 
  session_start();
  include 'Functions/db_functions.php';
  check_date();
  unset($_SESSION['info']);
  $client = '';
  if(isset($_SESSION['client'])){ 
    $client = $_SESSION['client'];
    $clientId = $_SESSION['clientID'];
    $clientType = $_SESSION['clientType'];
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/brands.min.css" integrity="sha512-OivR4OdSsE1onDm/i3J3Hpsm5GmOVvr9r49K3jJ0dnsxVzZgaOJ5MfxEAxCyGrzWozL9uJGKz6un3A7L+redIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="Assessts/CSS/style.css" />
  </head>
  <body>