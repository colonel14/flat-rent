<?php
  session_start();
  include 'config.php';
  $errors = array('username' => '', 'password' => '');
  if(isset($_POST['signUp'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);


    //Check Username
    if(!is_numeric($username[0])){
      if(strlen($username) < 3 || strlen($username) > 20 ){
        $errors['username'] = 'The Username Must be between 3 and 20 characters only';
      }
    } else{
      $errors['username'] = 'The First Letter Must be character not digit';
    }
    
  //Check Password
    if(strlen($username) > 6 || strlen($username) < 15 ){
      if(is_numeric($password[0])){
        if(!ctype_lower($password[strlen($password) - 1])){
          $errors['password'] = 'The Last Letter Must be Lowercase';
        }
      }else{
        $errors['password'] = 'The First Letter Must be digit';
      }
    }else{
      $errors['password'] = 'The Password Must be between 6 and 15 characters only';
    }

    $sql = "SELECT * FROM client WHERE username = '$username'";
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    if($statement->rowCount() > 0){
      $errors['username'] = 'Username already Exists';
    }
    if(!array_filter($errors)){
      foreach($_POST as $key => $value){
        $_SESSION['info'][$key] = trim($value);
      }
      $keys = array_keys($_SESSION['info']);
      if(in_array('signUp', $keys)){
        unset($_SESSION['info']['signUp']);
      }
      header("Location: step3.php");
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
    <main class="register step2 form_page">
      <div class="form-container">
        <div class="form-heading">
          <?php if($_SESSION['info']['clientType'] == 'customer'){ ?>
            <a href="customer.php" class="previous"
              ><i class="fas fa-arrow-left"></i
            ></a>
          <?php }else{ ?>
            <a href="owner.php" class="previous"
              ><i class="fas fa-arrow-left"></i
            ></a>
          <?php }; ?>
          <h1>Create your E-Account</h1>
        </div>

        <div class="tab-content">
          <div class="tab active fade show" id="nav-customer">
            <form action="step2.php" method="POST">
              <div class="form-group">
                <label for="username">Username</label>
                <input
                  id="username"
                  type="text"
                  name="username"
                  placeholder="Enter Your Username"
                  required
                  value ="<?= isset($_SESSION['info']['username']) ? $_SESSION['info']['username'] : '' ?>"
               />
                <?php if(isset($errors['username'])): ?>
                  <span class="errorMsg"> 
                    <?php 
                      echo $errors['username'];
                      $errors['username'] = '';
                    ?> 
                  </span>
                <?php endif; ?>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input
                  id="password"
                  type="password"
                  name="password"
                  placeholder="Enter Your Password"
                  required
                  value ="<?= isset($_SESSION['info']['password']) ? $_SESSION['info']['password'] : '' ?>"
                />
                <?php if(isset($errors['password'])): ?>
                  <span class="errorMsg"> 
                    <?php 
                      echo $errors['password'];
                      $errors['password'] = '';
                    ?> 
                  </span>
                <?php endif; ?>
              </div>
              <button class="signupBtn" type="submit" name="signUp">
               Sign Up
              </button>
            </form>
          </div>
        </div>
      </div>
      <div class="panel-container">
        <img src="Assessts/Img/register2.svg" />
      </div>
    </main>
  </body>
</html>
