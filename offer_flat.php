<?php
  session_start();
  if(isset($_SESSION['client'])){ 
    $client = $_SESSION['client'];
    $clientId = $_SESSION['clientID'];
    $clientType = $_SESSION['clientType'];
  }
  include 'config.php';
  $errors = array('images'=> '');
  if(isset($_POST['offer'])){
    //Get Form Data
    $street = trim($_POST['street']);
    $city = trim($_POST['city']);
    $house = trim($_POST['house']);
    $built = trim($_POST['built']);
    $size = trim($_POST['size']);
    $cost = trim($_POST['cost']);
    $rentCondition = trim($_POST['rentCondition']);
    $availableDate = trim($_POST['availableDate']);
    $period = trim($_POST['period']);
    $bedrooms = trim($_POST['bedrooms']);
    $bathrooms = trim($_POST['bathrooms']);
    $features = implode(',', $_POST['features']);
    $startTime = trim($_POST['startTime']);
    $endTime = trim($_POST['endTime']);
    $days = implode(',',  $_POST['days']);
    $images = $_FILES['images']['name'];
    $detail = trim($_POST['detail']);

    $allowed_exs = array("jpg", "jpeg", "png");
    $uploadDirectory = "Assessts/Img/flats/";
    // Check Image Count
    if(count($images) > 3 || count($images) < 3){
      $errors['images'] = 'You must upload 3 images only';
    }else{
      foreach($_FILES['images']['tmp_name'] as $imageKey => $imageValue){
        $image = $_FILES['images']['name'][$imageKey];
        $imageSize = $_FILES['images']['size'][$imageKey];
        $imageTmp = $_FILES['images']['tmp_name'][$imageKey];
        $imageType = pathinfo($uploadDirectory.$image, PATHINFO_EXTENSION);

        if(!in_array($imageType, $allowed_exs)){
          $errors['images'] = "You can't upload files of this type </br> (jpg, jpeg, png) only allowed";
        }else{
          move_uploaded_file($imageTmp, $uploadDirectory.$image);
        }
      }
    }

    if(!array_filter($errors)){
      
      try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $images = implode(',', $images);
        $sql = "INSERT INTO flat(`Cost`, `Built`, `Bedrooms_No`, `Bathrooms_No`, `Size`, `Features`, `Owner_ID`, `Rent_Condition`, `Available_Date`, `Rent_Period`, `Timetable_Days`, `Timetable_Start`, `Timetable_End`, `Detail`) 
        values ('$cost', '$built', '$bedrooms', '$bathrooms', '$size', '$features', '$clientId', '$rentCondition', '$availableDate', '$period', '$days', '$startTime', '$endTime', '$detail')";
          $statement = $pdo->prepare($sql);
          $statement->execute();
          if($statement){
            //Get The Last Inserted Flat ID
            $flat_ID = $pdo -> lastInsertId();
            //Insert Flat Location with The Last Inserted Flat Id
            $locationInfo = "INSERT INTO flat_location(`Flat_ID`, `House_No`, `Street_Name`, `City`) 
            VALUES ('$flat_ID', '$house','$street','$city')";
            $stmt = $pdo->prepare($locationInfo);
            $stmt->execute();
            //Insert Flat Images with The Last Inserted Flat Id
            $flatImages = "INSERT INTO flat_img(`Flat_ID`, `image`) 
            VALUES('$flat_ID', '$images')";
            $result = $pdo->prepare($flatImages);
            $result->execute();
            if($result){
              header("Location: successful_add.php");
            }
          }
        
       
      }
      catch (PDOException $e) {
        die( $e->getMessage() );
      }
    }
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
    <main class="offer_flat form_page">
      <div class="form-container">
        <div class="form-heading">
          <h1>Offer Flat</h1>
          <p>Enter your flat Detail</a></p>
        </div>
        <form action="offer_flat.php" method="POST" enctype="multipart/form-data">
          <h2>Flat Location</h2>
          <div class="form-group">
            <label for="street">Street Name</label>
            <input
              id="street"
              type="text"
              name="street"
              placeholder="Enter Flat Stree Name"
              required
            />
          </div>
          <div class="row">
            <div class="col form-group">
              <label for="city">City</label>
              <input
                id="city"
                type="text"
                name="city"
                placeholder="Enter The City"
                required
              />
            </div>
            <div class="col form-group">
              <label for="house">House No</label>
              <input
                  id="house"
                  type="number"
                  name="house"
                  placeholder="Enter House No"
                />
            </div>
          </div> 
          <h2>Flat Info</h2>
          <div class="row">
            <div class="col form-group">
                <label for="built">Built Year</label>
                <input
                  id="built"
                  type="month"
                  name="built"
                  placeholder="Enter Bedrooms No"
                  required
                />
              </div>
              <div class="col form-group">
                <label for="size">Size</label>
                <input
                  id="size"
                  type="number"
                  name="size"
                  placeholder="Size in Square Meter"
                  required
                />
              </div>
          </div>
          <div class="row">
            <div class="col form-group">
              <label for="cost">Rent Cost</label>
              <input
                id="cost"
                type="number"
                name="cost"
                placeholder="Enter The Cost"
                required
              />
            </div>
            <div class="col form-group">
              <label for="rentCondition">Rent Condition</label>
              <div class="selection">
                  <select name="rentCondition">
                    <option value="avilable">Avilable</option>
                    <option value="rented">Rented</option>
                  </select>
                  <i class="fa fa-chevron-down"></i>
                </div>
            </div>
          </div> 
          <div class="row">
            <div class="col form-group">
                <label for="availableDate">Available Date</label>
                <input
                  id="availableDate"
                  type="date"
                  name="availableDate"
                  required
                />
            </div>
            <div class="col form-group">
                <label for="period">Rent Period</label>
                <input
                  id="period"
                  type="number"
                  name="period"
                  placeholder ="Enter Number of Years"
                  required
                />
            </div>
          </div>
          <div class="row">
            <div class="col form-group">
                <label for="bedrooms">Number of Bedrooms</label>
                <input
                  id="bedrooms"
                  type="number"
                  name="bedrooms"
                  placeholder="Enter Bedrooms No"
                  required
                />
              </div>
              <div class="col form-group">
                <label for="bathrooms">Number of Bathrooms</label>
                <input
                  id="bathrooms"
                  type="number"
                  name="bathrooms"
                  placeholder="Enter Bathrooms No"
                  required
                />
              </div>
          </div>

          <h2>Flat Features</h2>
          <div class="row">
            <div class="col check-group">
                <input type='checkbox' id="airCondition" name="features[]" value="Has_AirCondition">
                <label for="airCondition">Air Condition</label>
            </div>
            <div class="col check-group">
                <input type='checkbox' id="heating" name="features[]" value="Has_Heating">
                <label for="heating">Heating System</label>
            </div>
          </div>
          <div class="row">
            <div class="col check-group">
                <input type='checkbox' id="access" name="features[]" value="Has_Acecss">
                <label for="access">Access</label>
            </div>
            <div class="col check-group">
                <input type='checkbox' id="parking" name="features[]" value="Has_CarParking">
                <label for="parking">Car Parking</label>
            </div>
          </div>
          <div class="row">
            <div class="col check-group">
                <input type='checkbox' id="backYard" name="features[]" value="Has_BackYard">
                <label for="backYard">Back Yard</label>
            </div>
            <div class="col check-group">
                <input type='checkbox' id="playing" name="features[]" value="Has_PlayGround">
                <label for="playing">Playing Ground</label>
            </div>
          </div>
          <div class="row">
            <div class="col check-group">
                <input type='checkbox' id="storage" name="feature[]" value="Storage">
                <label for="storage">Storage</label>
            </div>
          </div>
          <h2>Time Table</h2>
          <div class="row">
            <div class="col form-group">
                <label for="startTime">Start Time</label>
                <input
                  id="startTime"
                  type="time"
                  name="startTime"
                  min="09:00" 
                  max="18:00"
                  required
                />
              </div>
              <div class="col form-group">
                <label for="endTime">End Time</label>
                <input
                  id="endTime"
                  type="time"
                  name="endTime"
                  min="09:00" 
                  max="18:00"
                  required
                />
              </div>
          </div>
          <div class="row">
            <div class="col check-group">
                <input type='checkbox' id="saturday" name="days[]" value="saturday">
                <label for="saturday">Saturday</label>
            </div>
            <div class="col check-group">
                <input type='checkbox' id="sunday" name="days[]" value="sunday">
                <label for="sunday">Sunday</label>
            </div>
          </div>
          <div class="row">
            <div class="col check-group">
                <input type='checkbox' id="monday" name="days[]" value="monday">
                <label for="monday">Monday</label>
            </div>
            <div class="col check-group">
                <input type='checkbox' id="tuesday" name="days[]" value="tuesday">
                <label for="tuesday">Tuesday</label>
            </div>
          </div>
          <div class="row">
            <div class="col check-group">
                <input type='checkbox' id="wednesday" name="days[]" value="wednesday">
                <label for="wednesday">Wednesday</label>
            </div>
            <div class="col check-group">
                <input type='checkbox' id="thursday" name="days[]" value="thursday">
                <label for="thursday">Thursday</label>
            </div>
          </div>
          <div class="row">
            <div class="col check-group">
                <input type='checkbox' id="friday" name="days[]" value="friday">
                <label for="friday">Friday</label>
            </div>
          </div>
          <h2>Flat Image</h2>
          <div class='form-group'>
            <input type="file" name="images[]" multiple />
            <?php if(isset($errors['images'])): ?>
            <span class='errorMsg'><?php echo $errors['images']; $errors['images'] = '';  ?></span>
            <?php endif; ?>
            <span>Upload 3 Images only</span>
          </div>
          <h2>Flat Details</h2>
          <div class="form-group">
            <textarea rows="7" placeholder="Flat details......" maxlength="500" name="detail" required></textarea>
            <span>Maximum 500 character</span>
          </div>
          <button class="signinBtn" type="submit" name="offer">Offer</button>
        </form>
      </div>
      <div class="panel-container">
        <img src="Assessts/Img/owner.svg" />
      </div>
    </main>
  </body>
</html>
