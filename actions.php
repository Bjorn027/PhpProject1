<?php

// Start of Request

header('Content-Type: application/json');

include "db.php";

$db = connectToDb();

$action = $_POST['action'] ?? false;

// Creates a blank object
$res = new stdClass();
$res->success = false;

//After performing the action, the function returns and
// breaks out of the switch and continues.
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
    case "addTask":
        addTask();
        break;
    case "getTasks":
        getTasks();
        break;
    case "setTaskComplete":
        setTaskComplete();
        break;
    default:
        $res->message = "No action provided";
}

//Send the response
echo json_encode($res);

// End of the Request

// ------------------

// Start of handlers

function register()
{
    //Gain access to variables outside this function
    global $res, $db;

    //Values send in request
    $username = $_POST['username'] ?? false;
    $password = $_POST['password'] ?? false;

    // Validate
    if (!$username || !$password) {
        $res->message = "Requires username and password";
        return;
    }

    $passHash = password_hash($password, PASSWORD_DEFAULT);

    $query = 'INSERT INTO user (username, passhash) VALUE (:username, :pass)';
    $stm = $db->prepare($query);

    // Prevent SQL Injection
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

        //If the username was found
        if ($row) {
            //If the password matches
            if (password_verify($password, $row['passhash'])) {
                //Create/Restore a session for the current client
                session_start();
                $_SESSION['userid'] = $row['id'];
                $_SESSION['username'] = $username;
                $res->success = true;
            } else {
                $res->message = "Bad credentials";
            }
        } else {
            $res->message = "Bad credentials";
        }
    } else {
        $res->message = "Database error";
    }
}

function logout()
{
    global $res;
    session_start();
    session_destroy();
}

function mug() {
    $mugMoney = rand(200,500);
    $message = "Success you stole ". $mugMoney . " from your target!";
    echo "<script type='text/javascript'>alert('$message');</script>";
}