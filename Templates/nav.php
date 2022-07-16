<?php
   $unApprovedFlats = unapproved_flats();
   if(isset($clientId)){
     $adminNotifications = admin_notification();
     $rentedFlatsNotification = rented_flats($clientId);
     $appointments = owner_appointments($clientId);
     $customerAppointments = customer_appointemtns($clientId);
     $customerRent = customer_rent($clientId);
   }
?>
<nav>
      <div class="container">
        <div class="navbar-nav">
          <a href="index.php" class="nav_logo">
            Perfect <span>Flat</span>
          </a>
          <ul>
            <li class="navbar-item">
              <a href="home.php" class="nav-link">Home</a>
            </li>
            <li class="navbar-item">
              <a href="about.php" class="nav-link">About</a>
            </li>
            <li class="navbar-item">
              <a href="flats.php" class="nav-link">Flats</a>
            </li>
          </ul>
        </div>
        <?php if(!$client){ ?>
          <div class="search-sign">
            <form>
              <input type="text" placeholder="Search" />
              <button type="submit">
                <i class="fas fa-search"></i>
              </button>
            </form>
            <a href="signin.php" class="loginBtn">
              <i class="fas fa-sign-in-alt"></i>
              Log In
            </a>
            <a href="register.php" class="registerBtn">
              <i class="fas fa-user-plus"></i>
              Register
            </a>
          </div>
        <?php }else{ ?>
          <div class='account'>
            <form>
                <input type="text" placeholder="Search" />
                <button type="submit">
                  <i class="fas fa-search"></i>
                </button>
            </form>
            <ul class="account_nav">
              <li>
                <a href="">
                  <i class="far fa-bell"></i>
                </a>
                <div class="notification_dropdown dropdown-menu">
                  <?php if($clientType == "admin"): ?>
                    <ul>
                      <?php foreach($unApprovedFlats as $flat): ?>
                        <li class="notification_item">
                            <h3>New flat Added</h3>
                            <div class="notification_btns">
                              <a href="flat_detail.php?id=<?= $flat['Id']?>" class="btn previewBtn">Preview</a>
                              <form action="approve_decline.php" method="POST">
                                <input type="hidden" name="flatId" value="<?= $flat['Id']?>" ?>
                                <input type="submit" name="add_approve" value="Accept" class=" btn approveBtn">
                                <input type="submit" name="add_decline" value="Decline" class="btn declineBtn">
                              </form>
                            </div>                          
                        </li>
                      <?php endforeach; ?>
                      <?php if(isset($adminNotifications)){ ?>
                          <?php foreach($adminNotifications as $notification): ?>
                            <li class="notification_item">
                                <h3>Rented Flat</h3>
                                <p>A Flat Has been Rented by <?= $notification['Customer_Name']?></p>
                                <div class="notification_btns">
                                  <a href="flat_detail.php?id=<?= $notification['Flat_ID']?>" class="btn previewBtn">Preview</a>
                                </div>                          
                            </li>
                          <?php endforeach; ?>
                      <?php } ?>
                    </ul>
                  <?php endif; ?>
                  <?php if($clientType == "owner" || $clientType == "admin"): ?>
                    <?php if(isset($rentedFlatsNotification)): ?>
                      <ul>
                        <?php foreach($rentedFlatsNotification as $rented): ?>
                          <li class="notification_item">                            
                            <h3>Rented Flat</h3>
                            <div class="notification_info">
                              <span>Name: <?= $rented['Customer_Name'] ?></span>
                              <span>Mobile: <?= $rented['Customer_Mobile'] ?></span>
                            </div>
                            <div class="notification_btns">
                              <a href="flat_detail.php?id=<?= $rented['Flat_ID']?>" class="btn previewBtn">Preview</a>
                              <form action="approve_decline.php" method="POST">
                                <input type="hidden" name="flatId" value="<?= $rented['Flat_ID']?>" ?>
                                <input type="hidden" name="rentPeriod" value="<?= $rented['Rent_Period']?>" ?>
                                <input type="submit" name="rent_approve" value="Accept" class=" btn approveBtn">
                                <input type="submit" name="rent_decline" value="Decline" class="btn declineBtn">
                              </form>
                            </div>                          
                          </li>
                        <?php endforeach; ?>
                      </ul>
                    <?php endif; ?>
                  <?php endif; ?>
                  <?php if(isset($customerRent)): ?>
                      <ul>
                        <?php foreach($customerRent as $rent): ?>
                            <li class="notification_item">                            
                              <h3>Rent Request Relapy </h3>                           
                              <?php if($rent['Status'] == 'A'){ ?>
                                <p><?= $rent['Customer_Name'] ?> Has approved Your Rent Request</p>
                              <?php }elseif($rent['Status'] == 'D'){ ?>
                                <p><?= $rent['Customer_Name'] ?> Has Declined Your Rent Request</p>
                              <?php } ?>
                              <div class="notification_btns">
                                <a href="flat_detail.php?id=<?= $rent['Flat_ID']?>" class="btn previewBtn">Preview</a>
                                <form action="approve_decline.php" method="POST">
                                  <input type="hidden" name="flatId" value="<?= $rent['Flat_ID']?>" ?>
                                  <button type="submit" name="delete_rent_not" class=" btn declineBtn">Delete</button>
                                </form>
                              </div>                              
                            </li>
                        <?php endforeach; ?>
                      </ul>
                  <?php endif; ?>
                  <?php if(isset($appointments)): ?>
                      <ul>
                        <?php foreach($appointments as $appointment): ?>
                          <?php if(!$appointment['Status']): ?>
                            <li class="notification_item">                            
                              <h3>Appointment Request </h3>
                                <div class="notification_info appointment_not">
                                  <span>Name: <?= $appointment['Name'] ?></span>
                                  <span>Mobile: <?= $appointment['Mobile'] ?></span>
                                  <span>Day: <?= $appointment['Day']?></span>
                                  <span>Time: <?= $appointment['Time'] < 12 ? date('H:i',strtotime($appointment['Time'])) . ' AM' : date('H:i',strtotime($appointment['Time'])) . ' PM'; ?></span>
                                </div>
                                <div class="notification_btns">
                                  <a href="flat_detail.php?id=<?= $appointment['Flat_ID']?>" class="btn previewBtn">Preview</a>
                                  <form action="approve_decline.php" method="POST">
                                    <input type="hidden" name="day" value="<?= $appointment['Day']?>" ?>
                                    <input type="hidden" name="time" value="<?= $appointment['Time']?>" ?>
                                    <input type="hidden" name="flatId" value="<?= $appointment['Flat_ID']?>" ?>
                                    <input type="submit" name="appointment_approve" value="Accept" class=" btn approveBtn">
                                    <input type="submit" name="appointment_decline" value="Decline" class="btn declineBtn">
                                  </form>
                                </div>                              
                            </li>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </ul>
                  <?php endif; ?>
                  <?php if(isset($customerAppointments)): ?>
                      <ul>
                        <?php foreach($customerAppointments as $appointment): ?>
                            <li class="notification_item">                            
                              <h3>Appointment Relapy </h3>                           
                              <?php if($appointment['Status'] == 'A'){ ?>
                                <p><?= $appointment['Name'] ?> Has approved Your appointment </p>
                              <?php }elseif($appointment['Status'] == 'D'){ ?>
                                <p><?= $appointment['Name'] ?> Has Declined Your appointment </p>
                              <?php } ?>
                              <span>Address: <?= $appointment['Street_Name'] . ', ' . $appointment['City'] ?></span>
                              <div class="notification_info appointment_not">
                                <span>Mobile: <?= $appointment['Mobile'] ?> </span>
                                <span>Day: <?= $appointment['Day']?></span>
                                <span>Time: <?= $appointment['Time'] < 12 ? date('H:i',strtotime($appointment['Time'])) . ' AM' : date('H:i',strtotime($appointment['Time'])) . ' PM'; ?></span>
                              </div>
                              <div class="notification_btns">
                                <a href="flat_detail.php?id=<?= $appointment['Flat_ID']?>" class="btn previewBtn">Preview</a>
                                <form action="approve_decline.php" method="POST">
                                  <input type="hidden" name="day" value="<?= $appointment['Day']?>" ?>
                                  <input type="hidden" name="time" value="<?= $appointment['Time']?>" ?>
                                  <input type="hidden" name="flatId" value="<?= $appointment['Flat_ID']?>" ?>
                                  <button type="submit" name="delete_not" class=" btn declineBtn">Delete</button>
                                </form>
                              </div>                              
                            </li>
                        <?php endforeach; ?>
                      </ul>
                  <?php endif; ?>
                </div>
              </li>
              <li>
                <a href="">
                  <i class="far fa-user-circle"></i>
                </a>
                <div class="account_dropdown dropdown-menu">
                  <h3><?= $client ?></h3>
                  <?php if($clientType == "owner" || $clientType == "admin"): ?>
                    <a href="offer_flat.php" class="offerBtn">
                      Add Flat
                      <i class="fas fa-home"></i>
                    </a>
                  <?php endif; ?>
                  <a href="logout.php" class="logoutBtn">
                    Logout
                    <i class="fas fa-sign-out-alt"></i>
                  </a>
                </div>
              </li>
            </ul>
          </div>
        <?php }; ?>
      </div>
    </nav>