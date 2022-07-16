<?php
    include "Templates/head.php";
    include "Templates/nav.php";
    $flats = get_flats();
?> 

    <main class="home">
      <section class='home-intro'>
        <div class='intro-text'>
          <h1>Find your <span class="main-color">Future Home</span></h1>
          <div class='search-form'>
          <form action="search.php" method="POST" class='d-flex'>
            <div class='form-group col-3'>
              <label>#ID</label>
              <input type="number" name="flatId" placeholder="Flat ID or House No">
            </div>
            <div class='form-group col-6'>
              <label>Enter an address</label>
              <input type="text" name="location" placeholder="Enter an address, city">
            </div>
            <div class='form-group col-3'>
              <label>City</label>
              <div class="selection">
                <input type='text' list="city" name="city" placeholder="-City-">
                <datalist id='city'>
                  <select>
                    <option value="Ramallah"></option>
                    <option value="Nablus"></option>
                    <option value="Jenin"></option>
                    <option value="Jericho"></option>
                    <option value="Hebron"></option>
                    <option value="Salfet"></option>
                    <option value="Sabastia"></option>
                    <option value="Halhul"></option>
                    <option value="Burqin"></option>
                    <option value="Gaza"></option>
                    <option value="Haifa"></option>
                    <option value="Yaffa"></option>
                    <option value="Jersusalem"></option>
                    <option value="Rafah"></option>
                    <option value="Al-nasra"></option>
                  </select>
                </datalist>
                <i class="fa fa-chevron-down"></i>
              </div>
            </div>
            <div class='form-group col-4'>
              <div class='selection'>
                <input type='number' list="beds" name="bedrooms" placeholder="Beds Number">
                <datalist id='beds'>
                  <select>
                    <option value="1"></option>
                    <option value="2"></option>
                    <option value="3"></option>
                    <option value="4"></option>
                    <option value="5"></option>
                    <option value="6"></option>
                    <option value="7"></option>
                    <option value="8"></option>
                    <option value="9"></option>
                    <option value="10"></option>
                  </select>
                </datalist>
                <i class="fa fa-chevron-down"></i>
              </div>
            </div>
            <div class='form-group col-4'>
              <div class='selection'>
                <input type='text' list="bathroom" placeholder="Bathroom Number">
                <datalist id='bathroom'>
                  <select>
                    <option value="1"></option>
                    <option value="2"></option>
                    <option value="3"></option>
                    <option value="4"></option>
                  </select>
                </datalist>
                <i class="fa fa-chevron-down"></i>
              </div>
            </div>
            <div class='form-group col-4'>
              <div class='selection'>
                <input type='number' name ="price" list="price" placeholder="Max Price">
                <datalist id='price'>
                  <select>
                    <option value="1000"></option>
                    <option value="2000"></option>
                    <option value="3000"></option>
                    <option value="4000"></option>
                    <option value="5000"></option>
                    <option value="6000"></option>
                    <option value="7000"></option>
                    <option value="8000"></option>
                    <option value="9000"></option>
                    <option value="10000"></option>
                  </select>
                </datalist>
                <i class="fa fa-chevron-down"></i>
              </div>                
            </div>
            <div class='form-submit col-12'>
              <input type='reset' class="resetBtn" value='Reset'>
              <input type='submit' class='searchBtn' name='search' value="Search">
            </div>            
          </form>
        </div>
        </div>
      </section>
      <section class="home-flats">
        <div class='container'>
          <div class='section_title'>
            <h1>Newest Offer</h1>
            <p>A studio apartment has a single bedroom with no living room (possibly a separate kitchen). A one-bedroom apartment has a living or dining room separate from the bedroom. Two bedroom, three bedroom, and larger.
            </p>
          </div>
          <div class='flats_inner'>
            <?php foreach($flats as $flat): ?>
              <?php if($flat['Approved'] == 'T'): ?>
                <?php $flatImages = explode(',', $flat['image']); ?>
                <div class="flat_box">
                  <div class='flat_thumbnail'>
                    <img src='Assessts/Img/flats/<?= $flatImages[0]; ?>'>
                    <div class='view'>
                      <a href="flat_detail.php?id=<?php echo $flat['Id'];?>"><i class="far fa-eye"></i></a>
                    </div>
                  </div>
                  <div class='flat_info'>
                    <div class='flat_info__address'>
                      <span class="street"><?= $flat['Street_Name']?>, </span>
                      <span class="city"><?= $flat['City'] ?></span>
                    </div>
                    <div class='flat_info__size'>
                      <span><?= $flat['Size']?> sq ft</span>
                    </div>
                    <div class='flat_info__price'>
                      <span> $<?= $flat['Cost'] ?></span>
                    </div>
                    <div class='flat_info__details'>
                      <div class='flat_info_row'>
                        <div class='flat_info__detail'>
                          <span class='flat_detail__label'>Built:</span>
                          <span class='flat_detail__data'><?= $flat['Built'] ?></span>
                        </div>
                        <div class='flat_info__detail'>
                          <span class='flat_detail__label'>Area:</span>
                          <span class='flat_detail__data'><?= $flat['Size']?> sq ft</span>
                        </div>
                      </div>
                      <div calss='flat_info_row'>
                        <div class='flat_info__detail'>
                          <span class='flat_detail__label'>Beds:</span>
                          <span class='flat_detail__data'><?= $flat['Bedrooms_No']?></span>
                        </div>
                        <div class='flat_info__detail'>
                          <span class='flat_detail__label'>Baths:</span>
                          <span class='flat_detail__data'><?= $flat['Bathrooms_No']?></span>
                        </div>
                      </div>
                    </div>
                    <div class='flat_info__buttons'>
                      <a href="flat_detail.php?id=<?php echo $flat['Id'];?>" class='viewBtn'>
                        View Offer
                        <i class="fas fa-arrow-right"></i>
                      </a>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
        </div>
      </section>
    </main>
    <script src="Assessts/JS/main.js"></script>
  </body>
</html>
<?php 
  include "Templates/foot.php";
?>
  </body>
</html>
