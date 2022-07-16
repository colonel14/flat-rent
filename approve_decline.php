<?php
    session_start();
    include "config.php";

    //Add Flat Approve or Decline
    if(isset($_POST['add_approve'])){
        $flatId = $_POST['flatId'];
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE flat SET `Approved` = 'T' WHERE Id = '$flatId'";
        $stmnt = $pdo->prepare($sql);
        $stmnt->execute();
        if($stmnt){
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }elseif(isset($_POST['add_decline'])){
        $flatId = $_POST['flatId'];
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM flat WHERE Id = '$flatId'";
        $stmnt = $pdo->prepare($sql);
        $stmnt->execute();
        if($stmnt){
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }
    //Rent Approve or Decline
    if(isset($_POST['rent_approve'])){
        $flatId = $_POST['flatId'];
        $rentPeriod = $_POST['rentPeriod'];
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE rent SET `Status` = 'A' WHERE Flat_ID = '$flatId'";
        $stmnt = $pdo->prepare($sql);
        $stmnt->execute();
        if($stmnt){
            $newDate = date('Y-m-d', strtotime('+' . $rentPeriod . ' years'));
            $updateSql = "UPDATE flat SET `Rent_Condition` = 'rented', `Available_Date` = '$newDate' WHERE `Id` = '$flatId'";
            $updateStmnt = $pdo->prepare($updateSql);
            $updateStmnt->execute();
            if($updateStmnt){
                header("Location: " . $_SERVER['HTTP_REFERER']);
            }
           
        }
    }elseif(isset($_POST['rent_decline'])){
        $flatId = $_POST['flatId'];
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE rent SET `Status` = 'A' WHERE Flat_ID = '$flatId'";
        $stmnt = $pdo->prepare($sql);
        $stmnt->execute();
        if($stmnt){
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }elseif(isset($_POST['delete_rent_not'])){
        $flatId = $_POST['flatId'];
        $day = $_POST['day'];
        $time = $_POST['time'];
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM rent WHERE Flat_ID = '$flatId'";
        $stmnt = $pdo->prepare($sql);
        $stmnt->execute();
        if($stmnt){
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }

    //Appointment Approve or Decline
    if(isset($_POST['appointment_approve'])){
        $flatId = $_POST['flatId'];
        $day = $_POST['day'];
        $time = $_POST['time'];
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE appointment SET `Status` = 'A' WHERE Flat_ID = '$flatId' AND `Day` = '$day' AND `Time` = '$time'";
        $stmnt = $pdo->prepare($sql);
        $stmnt->execute();
        if($stmnt){
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }elseif(isset($_POST['appointment_decline'])){
        $flatId = $_POST['flatId'];
        $day = $_POST['day'];
        $time = $_POST['time'];
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE appointment SET `Status` = 'D' WHERE Flat_ID = '$flatId' AND `Day` = '$day' AND `Time` = '$time'";
        $stmnt = $pdo->prepare($sql);
        $stmnt->execute();
        if($stmnt){
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }elseif(isset($_POST['delete_not'])){
        $flatId = $_POST['flatId'];
        $day = $_POST['day'];
        $time = $_POST['time'];
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM appointment WHERE Flat_ID = '$flatId' AND `Day` = '$day' AND `Time` = '$time'";
        $stmnt = $pdo->prepare($sql);
        $stmnt->execute();
        if($stmnt){
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }