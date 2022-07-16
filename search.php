<?php
    include "Templates/head.php";
    include "Templates/nav.php";

    if(isset($_POST['search'])){
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM flat INNER JOIN flat_location ON flat.Id = flat_location.Flat_ID WHERE flat.Approved = 'T'";
        if(isset($_POST['flatId']) && !empty($_POST['flatId'])){
            $flatId = $_POST['flatId'];
            $sql .= " AND flat_location.House_No = '$flatId' OR flat.ID = '$flatId'";
        }
        if(isset($_POST['location']) && !empty($_POST['location'])){
            $location = $_POST['location'];
            $sql .= " AND flat_location.City = '$location' OR flat_location.Street_Name = '$location'";
        }

        if(isset($_POST['bedrooms']) && !empty($_POST['bedrooms'])){
            $sql .= " AND Bedrooms_No <= " . $_POST['bedrooms'];
        }

        if(isset($_POST['price']) && !empty($_POST['price'])){
            $sql .= " AND Cost < " . $_POST['price'];
        }

        
        $statment = $pdo->prepare($sql);
        $statment->execute();
        $flats = $statment->fetchAll();
    }

?>

<?php if($flats){ ?>
        <main class="search">
            <div class="container">
                <table>
                    <thead>
                        <th class="id">#</th>                        
                        <th class="location">Location</th>
                        <th class="bedrooms">Bedrooms No</th>
                        <th class="available">Available Rent</th>
                        <th class="cost">Cost</th>
                        <th class="bedrooms">Preview</th>
                    </thead>
                    <tbody>
                        <?php foreach($flats as $flat): ?>
                            <tr>
                                <td class="id"><?= $flat['Id']?></td>
                                <td class="location"><?= $flat['City'] . ', ' . $flat['Street_Name'];?></td>
                                <td class="bedrooms"><?= $flat['Bedrooms_No']?></td>
                                <td class="available"><?= $flat['Available_Date']?></td>
                                <td class="cost">$<?= $flat['Cost']?></td>
                                <td class="previewBtn"><a href="flat_detail.php?id=<?=$flat['Id']?>">Preview</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>           
        </main>
    </body>
</html>
<?php }else{ ?>
    <main class="search">
        <div class="container">
            <table>
                <thead>
                    <th class="id">#</th>                        
                    <th class="location">Location</th>
                    <th class="bedrooms">Bedrooms No</th>
                    <th class="available">Available Rent</th>
                    <th class="cost">Cost</th>
                    <th class="bedrooms">Preview</th>
                </thead>
            </table>
            <div class="searchMsg">No Result Found!</div>
        </div>
    </main>
<?php }; ?>