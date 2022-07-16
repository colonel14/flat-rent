<?php 
    include "Templates/head.php";
    include "Templates/nav.php";
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
        $flatFeatures = explode(',', $flat['Features']);
        $flatImages = explode(',', $flat['image']);
        $ownerSql = "SELECT * FROM client INNER JOIN location ON client.ID = location.Client_ID WHERE client.ID = '{$flat['Owner_ID']}'";
        $stmnt = $pdo->prepare($ownerSql);
        $stmnt->execute(); 
        $owner = $stmnt->fetch(PDO::FETCH_ASSOC);
       
      }
    }
?>

<?php if($flat){ ?>
  <main class="flat_detail">
    <div class="container">
      <div class="flat_detail__content">
        <div class="flat_box">

          <div class="flat_images">
            <img src="Assessts/Img/flats/<?= $flatImages[0]?>" />
            <ul class="flat_gallery">
              <li><img src="Assessts/Img/flats/<?= $flatImages[1]?>"></li>
              <li><img src="Assessts/Img/flats/<?= $flatImages[2]?>"></li>
            </ul>
          </div>
          <div class="info_sc">
            <div class="flat_info__address">
              <span class="street"><?= $flat['Street_Name']?>, </span>
              <span class="city"><?= $flat['City'] ?></span>
            </div>
            <div class="flat_info__size">
              <span><?= $flat['Size']?>sq ft</span>
            </div>
            <div class="flat_info__status">
              <span><?= $flat['Rent_Condition'] ?></span>
            </div>
            <div class="flat_info__price">
              <span> $<?= $flat['Cost'] ?></span>
            </div>
            <div class="flat_info__detail">
              <p>
                <?= $flat['Detail'] ?>
              </p>
            </div>
          </div>
        </div>
        <div class="flat_sc detail_sc">
          <h3 class="sc_title">Details</h3>
          <ul>
            <li>
              <span class="detail_label">Area Size: </span>
              <span class="detail_data"><?= $flat['Size'] ?> Sq meter</span>
            </li>
            <li>
              <span class="detail_label">Year Built: </span>
              <span class="detail_data"><?= $flat['Built'] ?></span>
            </li>
            <li>
              <span class="detail_label">Bedrooms: </span>
              <span class="detail_data"><?= $flat['Bedrooms_No'] ?></span>
            </li>
            <li>
              <span class="detail_label">Bathrooms: </span>
              <span class="detail_data"><?= $flat['Bathrooms_No'] ?></span>
            </li>
            <?php if($flat['Rent_Condition'] == 'rented'): ?>
              <li>
                <span class="detail_label">Available Date: </span>
                <span class="detail_data"><?= $flat['Available_Date'] ?></span>
              </li>
            <?php endif; ?>
            <li>
              <span class="detail_label">Renting Period: </span>
              <span class="detail_data"><?= $flat['Rent_Period'] ?> Years</span>
            </li>
          </ul>
        </div>
        <div class="flat_sc featrues_sc">
          <h3 class="sc_title">Details</h3>
          <ul>
            <li>
              <?php if(in_array('Has_AirCondition',  $flatFeatures)){ ?>
                <i class="fas fa-check check"></i>
              <?php }else{ ?>
                <i class="fas fa-times times"></i>
              <?php }; ?>
              Air Conditioning
            </li>
            <li>
              <?php if(in_array('Has_Heating',  $flatFeatures)){ ?>
                <i class="fas fa-check check"></i>
              <?php }else{ ?>
                <i class="fas fa-times times"></i>
              <?php }; ?>
              Heating System
            </li>
            <li>
              <?php if(in_array('Has_Acecss',  $flatFeatures)){ ?>
                <i class="fas fa-check check"></i>
              <?php }else{ ?>
                <i class="fas fa-times times"></i>
              <?php }; ?>
              Access Control
            </li>
            <li>
              <?php if(in_array('Has_CarParking',  $flatFeatures)){ ?>
                <i class="fas fa-check check"></i>
              <?php }else{ ?>
                <i class="fas fa-times times"></i>
              <?php }; ?>          
              Car Parking
            </li>
            <li>
              <?php if(in_array('Has_BackYard',  $flatFeatures)){ ?>
                <i class="fas fa-check check"></i>
              <?php }else{ ?>
                <i class="fas fa-times times"></i>
              <?php }; ?>          
              Back Yard
            </li>
            <li>
              <?php if(in_array('Has_PlayGround',  $flatFeatures)){ ?>
                <i class="fas fa-check check"></i>
              <?php }else{ ?>
                <i class="fas fa-times times"></i>
              <?php }; ?>
              Playing Ground
            </li>
            <li>
              <?php if(in_array('Storage',  $flatFeatures)){ ?>
                <i class="fas fa-check check"></i>
              <?php }else{ ?>
                <i class="fas fa-times times"></i>
              <?php }; ?>
              Storage
            </li>
          </ul>
        </div>
        <div class="flat_sc owner_sc">
          <h3 class="sc_title">Owner</h3>
          <div class="owner_inner">
            <div class="owner_detail">
              <div class="owner_img">
                <img src="Assessts/Img/owner_img.svg">
              </div>
              <div class="owner_info">
                <h3><?= $owner['Name'] ?></h3>
                <span><?= $owner['Client_Type'] ?></span>
                <p>Etiam metus ante, interdum sit amet eleifend et, fringilla et ex. Maecenas condimentum, velit eget tempor mattis, 
                  nunc erat consequat libero, vel maximus odio tortor scelerisque erat.
                </p>
                <ul class="info_contact">
                  <li>
                    <i class="fas fa-envelope-square"></i>
                    <?= $owner['Email'] ?>
                  </li>
                  <li>
                    <i class="fas fa-phone-volume"></i>
                    <?= $owner['Mobile'] ?>
                  </li>
                  <li>
                    <i class="fas fa-home"></i>
                    <?=$owner['Street_Name'] . ', ' . $owner['City'] ?>
                  </li>
                </ul>
              </div>    
            </div>
            <div class="owner_contact"></div>
          </div>
        </div>
      </div>
      <aside>
        <?php if($flat['Rent_Condition'] == "available"){ ?>
          <a href="rent.php?id=<?= $flat['Id']?>" class="rentBtn">
            <i class="fas fa-home"></i>
            Rent
          </a>
          <a href="appointment.php?id=<?= $flat['Id']?>" class="appoitmentBtn">
            <i class="far fa-calendar-check"></i>
            Appointment
          </a>
        <?php }else{ ?>
          <a class="rentBtn disabled">
            <i class="fas fa-home"></i>
            Rent
          </a>
          <a class="appoitmentBtn disabled">
            <i class="far fa-calendar-check"></i>
            Appointment
          </a>
        <?php } ?>

        
      </aside>
    </div>
  </main>

  <?php include "Templates/foot.php"; ?>
<?php }else{
    header("Location: 404.php");
  }
?>