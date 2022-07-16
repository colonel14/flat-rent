<?php
    include "Templates/head.php";
    include "Templates/nav.php";

    if(!isset($_SESSION['client'])){
        header("Location: register.php");
    }
    if(isset($_GET['id'])){
        $flatId = $_GET['id'];
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $sql = "SELECT `Id`, `Owner_ID`,`Timetable_Days`,`Timetable_Start`, `Timetable_End` FROM flat WHERE Id = '$flatId'";
        $statement = $pdo->prepare($sql);
        $statement->execute(); 
        $flat = $statement->fetch(PDO::FETCH_ASSOC);
        if($flat){
            $reserved = "SELECT `Day`, `Time` FROM appointment WHERE Flat_ID = '$flatId' AND `Status` != 'D'";
            $result = $pdo->prepare($reserved);
            $result->execute();
            $appointments = $result ->fetchAll(PDO::FETCH_ASSOC);

        }
    }

    if(isset($_POST['book'])){
        $customerId = $_SESSION['clientID'];
        $flatId = $_POST['flatId'];
        $ownerId = $_POST['ownerId'];
        $day = $_POST['day'];
        $time = $_POST['time'];
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $appoint = "INSERT INTO appointment (`Customer_ID`, `Owner_ID`, `Flat_ID`, `Day`, `Time`) VALUES ('$customerId','$ownerId','$flatId','$day','$time')";
        $stmnt = $pdo->prepare($appoint);
        $stmnt->execute();
        if($stmnt){
            header("Location: ". $_SERVER['HTTP_REFERER']);
        }else{
            echo "error";
        }
    }
?>
        <?php if($flat){ ?>
            <?php
                $timetableDays = explode(',', $flat['Timetable_Days']);
                $startHour = date('H',strtotime($flat['Timetable_Start']));
                $endHour = date('H',strtotime($flat['Timetable_End']));
                
            ?>
            <main class="appointment">
                <div class="container">
                    <h2>Time Table</h2>
                        <table>
                            <thead>
                                <th>Time/Days</th>
                                <?php foreach($timetableDays as $day): ?>
                                    <th><?= $day ?></th>
                                <?php endforeach; ?>
                            </thead>
                            <?php for($i =$startHour; $i <=  $endHour; $i++):?>
                                <tr>
                                    <td><?= $i ?>:00 <?= $i<12 ? 'AM' : 'PM';?></td>
                                    <?php foreach($timetableDays as $day): ?>
                                        <td>
                                            <?php for($a = 0; $a < count($appointments); $a++): ?>                                           
                                                    <?php if($i == date('H',strtotime($appointments[$a]['Time'])) && $day == $appointments[$a]['Day']){ ?>
                                                        <span class="bookBtn disable">Book</span>
                                                        <?php continue 2; ?>
                                                    <?php } ?>
                                            <?php endfor; ?>
                                            <form action="appointment.php" method="POST">
                                                <input type="hidden" name="flatId" value="<?= $flat['Id'] ?>">
                                                <input type="hidden" name="ownerId" value="<?= $flat['Owner_ID'] ?>">
                                                <input type="hidden" name="time" value="<?= $i ?>:00" />
                                                <input type="hidden" name="day" value="<?= $day?>" />
                                                <button type="submit" name ="book" class="bookBtn">Book</button>
                                            </form>
                                        </td>                                           
                                    <?php endforeach; ?>
                                </tr>
                            <?php endfor; ?>
                        </table>

                    </form>
                </div>
            </main>
        <?php 
            }else{ 
                header("Location: 404.php");
            }
        ?>        
    </body>
</html>