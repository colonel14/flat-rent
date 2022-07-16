<?php
  session_start();  
  include 'config.php';
  $errors = array('global' => '');
  
  
  if(isset($_POST['signin'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM client WHERE username = '$username' AND password = '$password'";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    if($statement->rowCount() > 0){
      $_SESSION['client'] = $row['Name'];
      $_SESSION['clientID'] = $row['ID'];
      $_SESSION['clientType'] = $row['Client_Type'];
      header("Location: home.php");
    }else{
      $errors['global'] = "Username or Password is Incorrect";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In</title>
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
      integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="Assessts/CSS/style.css" />
  </head>
  <body>
    <main class="signin form_page">
      <div class="form-container">
        <div class="form-heading">
          <h1>Sign In</h1>
          <p>You Don't have an account <a href="register.php">Sign Up</a></p>
        </div>
        <form action="signin.php" method="POST">
          <div class="form-group">
            <label for="username">Username</label>
            <input
              id="username"
              type="text"
              name="username"
              placeholder="Enter Your Username"
              required
            />
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input
              id="password"
              type="password"
              name="password"
              placeholder="Enter Your Password"
              required
            />
          </div>
          <?php if(isset($errors['global'])): ?>
            <span class='errorMsg'><?php echo $errors['global']; $errors['global'] = '';  ?></span>
          <?php endif; ?>
          <button class="signinBtn" type="submit" name="signin">Sign In</button>
        </form>
      </div>
      <div class="panel-container">
        <img src="Assessts/Img/register2.svg" />
      </div>
    </main>
  </body>
</html>
