<?php
  session_start();
  $errors = array(
    'ID' => '',
    'name' => '',
    'email' => '',
    'mobile' => '',
    'telephone' => '',
    'city' => '',
    'street' => '',
    'postCode' => '',
    'bankName' => '',
    'bankBranch' => '',
    'account' => '',
  );

  if(isset($_POST['next'])){
    $ID = trim($_POST['ID']);
    $name = trim($_POST['name']);

  //Check ID
   if(strlen((string) $ID) < 9){
     $errors['ID'] = "The ID must be only 9 digits";
   }

  //Check name
   if(!preg_match('/^[a-zA-Z\s]+$/', $name)){
     $errors['name'] = "You must enter a Valid name";
   }

   if(!array_filter($errors)){
      foreach($_POST as $key => $value){
        $_SESSION['info'][$key] = trim($value);
      }
      $keys = array_keys($_SESSION['info']);
      if(in_array('next', $keys)){
        unset($_SESSION['info']['next']);
      }
      header("Location: step2.php");
   }

  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registeration</title>
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
      integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="Assessts/CSS/style.css" />
  </head>
  <body>
    <main class="register step1 form_page">
      <div class="form-container">
        <div class="form-heading">
          <a href="register.php" class="previous">
            <i class="fas fa-arrow-left"></i>
          </a>
          <h1>Let's Start</h1>
          <p>You have an account <a href="signin.php">Sign In</a></p>
        </div>
        <form method="POST" action="customer.php">
          <h2>User Info</h2>
          <div class="form-group">
            <label for="ID">ID</label>
            <input
              id="ID"
              type="number"
              name="ID"
              placeholder="Enter Your ID"
              required
              value="<?= isset($_SESSION['info']['ID']) ? $_SESSION['info']['ID'] : '' ?>"
            />
            <?php if(isset($errors['ID'])): ?>
            <span class="errorMsg">
              <?php 
                    echo $errors['ID'];
                    $errors['ID'] = '';
                  ?>
            </span>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <label for="name">Name</label>
            <input
              id="name"
              type="Text"
              name="name"
              placeholder="Enter Your Name"
              required
              value="<?= isset($_SESSION['info']['name']) ? $_SESSION['info']['name'] : '' ?>"
            />
            <?php if(isset($errors['name'])): ?>
            <span class="errorMsg">
              <?php 
                    echo $errors['name'];
                    $errors['name'] = '';
                  ?>
            </span>
            <?php endif; ?>
          </div>
          <div class="row">
            <div class="col form-group">
              <label for="email">Email</label>
              <input
                id="email"
                type="email"
                name="email"
                placeholder="Enter Your Email"
                required
                value="<?= isset($_SESSION['info']['email']) ? $_SESSION['info']['email'] : '' ?>"
              />
            </div>
            <div class="col form-group">
              <label for="birthDate">Birth Date</label>
              <input
                id="birthDate"
                type="date"
                name="birthDate"
                placeholder="Enter Your Birth Date"
                value="<?= isset($_SESSION['info']['birthDate']) ? $_SESSION['info']['birthDate'] : '' ?>"
                max="2022-12-31"
              />
            </div>
          </div>
          <div class="row">
            <div class="col form-group">
              <label for="mobile">Mobile</label>
              <input
                id="mobile"
                type="number"
                name="mobile"
                placeholder="Enter Your phone Number"
                required
                value="<?= isset($_SESSION['info']['mobile']) ? $_SESSION['info']['mobile'] : '' ?>"
              />
            </div>
            <div class="col form-group">
              <label for="telephone">Telephone</label>
              <input
                id="telephone"
                type="number"
                name="telephone"
                placeholder="Enter Your phone Number"
                required
                value="<?= isset($_SESSION['info']['telephone']) ? $_SESSION['info']['telephone'] : '' ?>"
              />
            </div>
          </div>
          <h2>User Address</h2>
          <div class="form-group">
            <label for="city">City</label>
            <input
              id="city"
              type="text"
              name="city"
              placeholder="Enter City Name"
              required
              value="<?= isset($_SESSION['info']['city']) ? $_SESSION['info']['city'] : '' ?>"
            />
          </div>
          <div class="row">
            <div class="col form-group">
              <label for="street">Street name</label>
              <input
                id="street"
                type="text"
                name="street"
                placeholder="Street Name"
                required
                value="<?= isset($_SESSION['info']['street']) ? $_SESSION['info']['street'] : '' ?>"
              />
            </div>
            <div class="col form-group">
              <label for="house">House no</label>
              <input id="house" type="number" name="house" />
            </div>
          </div>
          <div class="form-group">
            <label for="postCode">Post Code</label>
            <input
              id="postCode"
              type="number"
              name="postCode"
              placeholder="Enter Post Code"
              required
              value="<?= isset($_SESSION['info']['postCode']) ? $_SESSION['info']['postCode'] : '' ?>"
            />
          </div>
          <input type="hidden" value="customer" name="clientType" />
          <button class="nextBtn" type="submit" name="next">
            <i class="fas fa-arrow-right"></i>
          </button>
        </form>
      </div>
      <div class="panel-container">
        <img src="Assessts/Img/register1.svg" />
      </div>
    </main>
  </body>
</html>
