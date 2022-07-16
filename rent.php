<?php
    session_start();
    include "config.php";
    if(!isset($_SESSION['client'])){
        header("Location: register.php");
    }
    if(isset($_GET['id'])){
        $flatId = $_GET['id'];
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $sql ="SELECT * FROM flat
        INNER JOIN flat_img ON flat.Id = flat_img.Flat_ID 
        INNER JOIN flat_location ON flat.Id = flat_location.Flat_ID 
        WHERE flat.Id = '$flatId'"; 
        $statement = $pdo->prepare($sql);
        $statement->execute(); 
        $flat = $statement->fetch(PDO::FETCH_ASSOC);
        if($flat){
            $ownerId = $flat['Owner_ID'];
            $ownerSql = "SELECT * FROM location INNER JOIN client ON location.Client_ID = client.ID  WHERE location.Client_ID = '$ownerId'";
            $stmnt = $pdo->prepare($ownerSql);
            $stmnt->execute();
            $owner = $stmnt->fetch(PDO::FETCH_ASSOC);
        }       
    }
    if(isset($_POST['confirm'])){
        $_SESSION['flatId'] = $_POST['flatId'];
        $_SESSION['ownerId'] = $_POST['ownerId'];
        $_SESSION['flatPrice'] = $_POST['flatPrice'];
        $_SESSION['rentPeriod'] = $_POST['rentPeriod'];
        header("Location: rent_confirm.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Offer Flat</title>
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
      integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="Assessts/CSS/style.css" />
  </head>
  <body>
    <main class="rent form_page">
      <div class="form-container">
        <div class="form-heading">
          <h1>Rent Flat</h1>
          <p>Confirm Information To Rent</a></p>
        </div>
        <form action="rent.php" method="POST">
          <h2>Flat Details</h2>
          <div class="row">
            <div class="col-3 form-group">
                <label for="id">#ID</label>
                <input
                id="id"
                type="number"
                name="id"
                value="<?= $flat['Id'] ?>"
                readonly
                />
            </div>
            <div class="col-9 form-group">
                <label for="street">Street Name</label>
                <input
                id="street"
                type="text"
                name="street"
                value="<?= $flat['Street_Name']?>"
                readonly
                />
            </div>
          </div>

          <div class="row">
            <div class="col form-group">
              <label for="city">City</label>
              <input
                id="city"
                type="text"
                name="city"
                value="<?= $flat['City']?>"
                readonly
              />
            </div>
            <div class="col form-group">
              <label for="house">House No</label>
              <input
                  id="house"
                  type="number"
                  name="house"
                  value="<?= $flat['House_No']?>"
                  readonly
                />
            </div>
          </div> 
          <h2>Owner Details</h2>
          <div class="row">
            <div class="col-3 form-group">
                <label for="ID">ID</label>
                <input
                id="ID"
                type="number"
                name="ID"
                value="<?= $owner['Client_ID']?>"
                readonly    
                />
            </div>
            <div class="col-9 form-group">
                <label for="name">Name</label>
                <input
                id="name"
                type="Text"
                name="name"
                value="<?= $owner['Name']?>"
                readonly              
                />
            </div>
          </div>
          <div class="row">
            <div class="col form-group">
                <label for="ownerAddress">Address</label>
                <input
                id="ownerAddress"
                type="text"
                name="ownerAddress"
                value="<?= $owner['Street_Name']?>"
                readonly    
                />
            </div>
            <div class="col form-group">
                <label for="ownerCity">City</label>
                <input
                id="ownerCity"
                type="Text"
                name="ownerCity"
                value="<?= $owner['City']?>"
                readonly              
                />
            </div>
          </div>
            <input type="hidden" name="flatId" value="<?=$flat['Id'];?>" >
            <input type="hidden" name="ownerId" value="<?=$owner['ID'];?>">
            <input type="hidden" name="rentPeriod" value="<?=$flat['Rent_Period']; ?>">
            <input type="hidden" name="flatPrice" value="<?=$flat['Cost']; ?>">
          <button class="signinBtn" type="submit" name="confirm">Confirm</button>
        </form>
      </div>
      <div class="panel-container">
        <img src="Assessts/Img/rent.svg" />
      </div>
    </main>
  </body>
</html>
