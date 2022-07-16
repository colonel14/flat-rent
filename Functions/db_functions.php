<?php

    include 'config.php';

    function get_flats(){
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM flat INNER JOIN flat_img ON flat.Id = flat_img.Flat_ID INNER JOIN flat_location ON flat.Id = flat_location.Flat_ID";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $row = $statement->fetchAll();
        return $row;
    }
    function admin_notification(){
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM rent WHERE `Status` = 'A'";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $row = $statement->fetchAll();
        return $row;
    }
    function unapproved_flats(){
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM flat WHERE Approved = ''";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $row = $statement->fetchAll();
        return $row;
    }
    function rented_flats($clientId){
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM rent WHERE Owner_ID = '$clientId' AND `Status` = ''";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $row = $statement->fetchAll();
        return $row;
    }
    function customer_rent($clientId){
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM rent WHERE Customer_ID = '$clientId' AND `Status` != ''";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $row = $statement->fetchAll();
        return $row;
    }
    function check_Date(){
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $todayDate = date('y-m-d');
        $sql = "UPDATE flat SET `Rent_Condition` = 'available' WHERE Available_Date <= '$todayDate'";
        $statement = $pdo->prepare($sql);
        $statement->execute();
    }

    function owner_appointments($clientId){
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM appointment INNER JOIN client ON appointment.Customer_ID = client.ID WHERE Owner_ID = '$clientId'";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $row = $statement->fetchAll();
        return $row;
    }

    function customer_appointemtns($clientId){
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM appointment 
        INNER JOIN client ON appointment.Owner_ID  = client.ID
        INNER JOIN location ON appointment.Owner_ID = location.Client_ID
        WHERE Customer_ID = '$clientId' AND `Status` != ''";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $row = $statement->fetchAll();
        return $row;
    }