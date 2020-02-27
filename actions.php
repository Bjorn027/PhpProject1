<?php

header('Content-Type: application/json');

include "db.php";

$db = connectToDb();

$action = $_POST['action'] ?? false;


$res = new stdClass();
$res->success = false;

switch ($action) {
    case "login":
        login();
        break;
    case "register":
        register();
        break;
    case "logout":
        logout();
        break;
    case "mug":
        mug();
        break;
    case "shoot":
        shoot();
        break;
    case "crime":
        crime();
        break;
    case "crime2":
        crime2();
        break;
    case "crime3":
        crime3();
        break;
    case "crime4":
        crime4();
        break;
    case "refresh":
        refreshStam();
        break;
    default:
        $res->message = "No action provided";
}


echo json_encode($res);


function register()
{
    global $res, $db;

    $username = $_POST['username'] ?? false;
    $password = $_POST['password'] ?? false;

    if (!$username || !$password) {
        $res->message = "Requires username and password";
        return;
    }

    $passHash = password_hash($password, PASSWORD_DEFAULT);

    $query = 'INSERT INTO user (username, passhash, money, stam) VALUE (:username, :pass, 10000, 100)';
    $stm = $db->prepare($query);

    $stm->bindParam(":username", $username);
    $stm->bindParam(":pass", $passHash);

    if ($stm->execute()) {
        $res->success = true;
    } else {
        $res->message = "Database error";
    }
}

function login()
{
    global $res, $db;
    $username = $_POST['username'] ?? false;
    $password = $_POST['password'] ?? false;

    if (!$username || !$password) {
        $res->message = "Requires username and password";
        return;
    }

    $query = 'SELECT id, passhash FROM user WHERE username = :username LIMIT 1';
    $stm = $db->prepare($query);
    $stm->bindParam(":username", $username);

    if ($stm->execute()) {
        $stm->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stm->fetch();

        if ($row) {
            if (password_verify($password, $row['passhash'])) {
                session_start();
                $_SESSION['userid'] = $row['id'];
                $_SESSION['username'] = $username;
                $res->success = true;
            } else {
                $res->message = "Wrong login info";
            }
        } else {
            $res->message = "Wrong login info";
        }
    } else {
        $res->message = "Wrong login info";
    }
}

function logout()
{
    global $res;
    $res->success = true;
    session_start();
    session_destroy();
    
}

function mug(){
    global $res, $db;

    $username2 = $_POST['username'] ?? false;
    
    
    if (!$username2) {
        $res->message = "You forgot to enter who you are mugging";
        return;
    }
    
    else {
        $res->message = "User is dead or doesnt exist";
    }
    $mugmoney = rand(700, 1200);

    $query = "UPDATE user set money = money - $mugmoney where username = :username";
    $stm = $db->prepare($query);
    session_start();
    
    $stm->bindParam(":username", $username2);
    
    
    if ($stm->execute()) {
        $res->session = $_SESSION;
        if ($stm->rowCount() == 1){
            $res->message = "You stole $" . $mugmoney . " of " . $username2 . "'s hard earned money";
            $query = "UPDATE user set stam = stam - 10 where username = :curruser;
                      UPDATE user set money = money + $mugmoney where username = :curruser";
            $stm = $db->prepare($query);
            $stm->bindParam(":curruser", $_SESSION['username']);
        }
        if($stm->execute()){
            $res->success = true;
        }else{
            $res->message = "Database error";    
        }
    } else {
        $res->message = "Database error";
    }
}

function shoot()
{
    global $res, $db;

    $username1 = $_POST['username'] ?? false;
    
    if (!$username1) {
        $res->message = "You forgot to enter who you are shooting";
        return;
    }
    
    else {
        $res->message = "User is dead or doesnt exist";
        
    }

    $query = "DELETE from user WHERE username = :username";
    $stm = $db->prepare($query);

    session_start();
    $stm->bindParam(":username", $username1);
    

    if ($stm->execute()) {
        
        if($stm->rowCount() == 0){
            $res->message = "User is dead or doesnt exist";
        }
        else {
            $res->message = "Ripperoni " . $username1 . " is sleeping with the fishes";
        $query = "UPDATE user set stam = stam - 10 where username = :curruser";
        
        $stm = $db->prepare($query);
        $stm->bindParam(":curruser", $_SESSION['username']);
        }

        if($stm->execute()){
            $res->success = true;
        }else{
            $res->message = "Database error";    
        }
    } else {
        $res->message = "Database error";
    }
}


function crime(){
    global $res, $db;

    $crimeType = $_POST['crimeType'] ?? false;

    $crimeMoney = rand(2000, 3000);

    $query = "UPDATE user set money = money + $crimeMoney where username = :curruser;
              UPDATE user set stam = stam - 10 where username = :curruser";
    
    session_start();
    $stm = $db->prepare($query);
    $stm->bindParam(":curruser", $_SESSION['username']);
    
    if ($stm->execute()) {
        $res->session = $_SESSION;
        if ($stm->rowCount() == 1){
            $res->message = "You did the crime " . $crimeType . " and walked away with $" . $crimeMoney;
        }
        $res->success = true;
    } else {
        $res->message = "Database error";
    }
}

function crime2(){
    global $res, $db;

    $crimeType2 = $_POST['crimeType2'] ?? false;

    $crimeMoney = rand(600, 1000);

    $query = "UPDATE user set money = money + $crimeMoney where username = :curruser;
              UPDATE user set stam = stam - 8 where username = :curruser";
    
    session_start();
    $stm = $db->prepare($query);
    $stm->bindParam(":curruser", $_SESSION['username']);
    
    if ($stm->execute()) {
        $res->session = $_SESSION;
        if ($stm->rowCount() == 1){
            $res->message = "You did the crime " . $crimeType2 . " and walked away with $" . $crimeMoney;
        }
        $res->success = true;
    } else {
        $res->message = "Database error";
    }
}

function crime3(){
    global $res, $db;

    $crimeType3 = $_POST['crimeType3'] ?? false;

    $crimeMoney = rand(200, 500);

    $query = "UPDATE user set money = money + $crimeMoney where username = :curruser;
              UPDATE user set stam = stam - 5 where username = :curruser";
    
    session_start();
    $stm = $db->prepare($query);
    $stm->bindParam(":curruser", $_SESSION['username']);
    
    if ($stm->execute()) {
        $res->session = $_SESSION;
        if ($stm->rowCount() == 1){
            $res->message = "You did the crime " . $crimeType3 . " and walked away with $" . $crimeMoney;
        }
        $res->success = true;
    } else {
        $res->message = "Database error";
    }
}

function crime4(){
    global $res, $db;

    $crimeType4 = $_POST['crimeType4'] ?? false;

    $crimeMoney = rand(20, 200);

    $query = "UPDATE user set money = money + $crimeMoney where username = :curruser;
              UPDATE user set stam = stam - 2 where username = :curruser";
    
    session_start();
    $stm = $db->prepare($query);
    $stm->bindParam(":curruser", $_SESSION['username']);
    
    

    if ($stm->execute()) {
        $res->session = $_SESSION;
        if ($stm->rowCount() == 1){
            $res->message = "You did the crime " . $crimeType4 . " and walked away with $" . $crimeMoney;
        }
        $res->success = true;
    } else {
        $res->message = "Database error";
    }
}

function refreshStam() {
    global $res, $db;
    $value1 = $_POST['value1'] ?? false;
    $query = "UPDATE user set stam = :value1 where username = :curruser";
    $stm = $db->prepare($query);
    $stm->bindParam(":value1", $value1);
    $stm->bindParam(":curruser", $_SESSION['username']);

    if ($stm->execute()){

    }

}