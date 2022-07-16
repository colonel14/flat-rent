<?php
  session_start();
  include 'config.php';
  if(isset($_POST['confirm'])){
    extract($_SESSION['info']);
    try{
      $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "INSERT INTO client (`Client_ID`, `Name`, `Email`, `BirthDate`, `Mobile`, `Telephone`, `Username`, `Password`, `Client_Type`) 
      values ('$ID', '$name', '$email', '$birthDate', '$mobile', '$telephone', '$username', '$password', '$clientType')";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        if($statement){
          $client_ID = $pdo -> lastInsertId();
          $locationInfo = "INSERT INTO location(`Client_ID`, `House_No`, `Street_Name`, `City`, `Postal_Code`) 
          VALUES ('$client_ID', '$house','$street','$city', '$postCode')";
          $stmt = $pdo->prepare($locationInfo);
          $stmt->execute();
          if($clientType == 'owner'){
            $bankInfo = "INSERT INTO bank(`Client_ID`, `Bank_Name`, `Bank_Branch`, `Account_No`) 
            VALUES('$client_ID', '$bankName', '$bankBranch', '$account')";
            $result = $pdo->prepare($bankInfo);
            $result->execute();
          }
        }
      
     
    }
    catch (PDOException $e) {
      die( $e->getMessage() );
    }
   
  }
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
    <?php if(!isset($_POST['confirm'])){ ?>
      <main class="register form_page">
        <div class="form-container">
          <div class="form-heading">
            <a href="step2.php" class="previous"
              ><i class="fas fa-arrow-left"></i
            ></a>
            <h1>Confirm your Information</h1>
          </div>
          <div class="tab-content">
            <div class="tab active fade show" id="nav-customer">
              <form action="step3.php" method="POST">
                <div class="row">
                  <div class="col form-group">
                    <label for="id">ID</label>
                    <input
                      id="id"
                      type="text"
                      value="<?= $_SESSION['info']['ID']?>"
                      readonly
                    />
                  </div>
                  <div class="col form-group">
                    <label for="name">Name</label>
                    <input
                      id="name"
                      type="text"
                      value="<?= $_SESSION['info']['name']?>"
                      readonly
                    />
                  </div>
                </div>

                <div class="form-group">
                  <label for="email">Email</label>
                  <input
                    id="email"
                    type="text"
                    value="<?= $_SESSION['info']['email']?>"
                    readonly
                  />
                </div>
                <div class="row">
                  <div class="col form-group">
                    <label for="mobile">Mobile</label>
                    <input
                      id="mobile"
                      type="text"
                      value="<?= $_SESSION['info']['mobile']?>"
                      readonly
                    />
                  </div>
                  <div class="col form-group">
                    <label for="telephone">Telephone</label>
                    <input
                      id="telephone"
                      type="text"
                      value="<?= $_SESSION['info']['telephone']?>"
                      readonly
                    />
                  </div>
                </div>
                <div class="form-group">
                  <label for="mobile">Mobile</label>
                  <input
                    id="mobile"
                    type="text"
                    value="<?= $_SESSION['info']['mobile']?>"
                    readonly
                  />
                </div>
                <div class="form-group">
                  <label for="username">Username</label>
                  <input
                    id="username"
                    type="text"
                    value="<?= $_SESSION['info']['username']?>"
                    readonly
                  />
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input
                    id="password"
                    type="text"
                    value="<?= $_SESSION['info']['password']?>"
                    readonly
                  />
                </div>
                <button class="signupBtn" type="submit" name="confirm">
                  Confirm
                </button>
              </form>
            </div>
          </div>
        </div>
        <div class="panel-container">
          <img src="Assessts/Img/confirm.svg" />
        </div>
      </main>
    <?php }else { ?>
      <main class="register step3">
          <div class="confirmMsg">
                <div class="confirm_head">
                  <h2>You have Signed Up Successfully</h2>
                </div>
                <span class="divider"></span>
                <ul class="confim_info">
                  <li>
                    <span class="label">ID: </span>
                    <span class="data">
                      <?php echo $_SESSION['info']['ID']; ?>
                    </span>
                  </li>
                  <li>
                    <span class="label">Username: </span>
                    <span class="data">
                      <?php echo $_SESSION['info']['username']; ?>
                    </span>
                  </li>
                </ul>
                <a href="home.php">Go Home</a>
          </div>
        </main>
    <?php }; ?>
  </body>
</html>
