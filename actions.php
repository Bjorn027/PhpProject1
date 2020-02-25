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

    $query = 'INSERT INTO user (username, passhash, money) VALUE (:username, :pass, 10000)';
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
    $mugmoney = rand(100, 200);

    $query = "UPDATE user set money = money - $mugmoney where username = :username;
              UPDATE user set money = money + $mugmoney where username = '$_SESSION[username]'";
    

    $stm = $db->prepare($query);
    $stm->bindParam(":username", $username2);
    
    if ($stm->execute()) {
        if ($stm->rowCount() == 2){
            $res->message = "You stole " . $mugmoney . " from him";
        }
        $res->success = true;
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

    $query = 'DELETE from user WHERE username = :username';
    $stm = $db->prepare($query);

    $stm->bindParam(":username", $username1);
    
    if ($stm->execute()) {
        if ($stm->rowCount() == 1){
            $res->message = "Ripperoni he's sleeping with the fishes";
        }
        $res->success = true;
    } else {
        $res->message = "Database error";
    }
}
   



