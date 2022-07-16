<?php
    session_start();
    include 'config.php';
    $ownerId = $_SESSION['ownerId'];

    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    $sql = "SELECT * FROM client WHERE ID = '$ownerId'";
    $statment = $pdo->prepare($sql);
    $statment->execute();
    $owner = $statment->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
      integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="Assessts/CSS/style.css" />
  </head>
  <body>
  <main class="congrats form_page">
      <div class="form-container">
        <h1>Congratulation</h1>
        <p>
            Your Flat has been successfully rented
            <br>
            You can collect the key from the owner
        </p>
        <h2>Owner Detail</h2>
        <ul>
            <li>Name: <?= $owner['Name']?></li>
            <li>Mobile: <?= $owner['Mobile']?></li>
        </ul>
        <a href="home.php" class="goHomeBtn">Go Home</a>
      </div>
      <div class="panel-container">
        <img src="Assessts/Img/congrats.svg" />
      </div>
    </main>
  </body>
</html>