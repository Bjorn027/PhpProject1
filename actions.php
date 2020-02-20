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

    $query = 'INSERT INTO user (username, passhash) VALUE (:username, :pass)';
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
    session_start();
    session_destroy();
    
}

