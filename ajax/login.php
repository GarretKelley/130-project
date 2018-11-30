<?php

include_once('../php/connection.php');

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);
$isLogin = $input['mode'] === 'login';
$isCreate = $input['mode'] === 'create';

function return_error($message) {
    http_response_code(400);
    echo($message);
    die();
}

function internal_error() {
    http_response_code(500);
    die();
}

if (!$isLogin && !$isCreate) {
    return_error('Bad request.');
} else if (count(array_filter($input)) !== count($input)) {
    if ($isLogin) {
        return_error('Please enter a username and password.');
    } else {
        return_error('Please fill out all information.');
    }
} else {
    $username = $input['username'];
    $password = $input['password'];
    
    $db = connectDB();
    if ($isLogin) {
        $stmt = $db->prepare("SELECT password FROM players WHERE username=?"); //SELECT id FROM players WHERE username=? and password=?");
        $stmt->bind_param("s", $username);
        if (!$stmt->execute()) {
            internal_error();
        }
        $stmt->bind_result($dbPass);
        $stmt->fetch();
        if (!password_verify($password, $dbPass)) {
            return_error('Wrong username or password.');
        }
        // TODO set cookie, using json web token
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO players (firstname, lastname, age, gender, location, username, password)
                              VALUES (?, ?, ?, ?, ?, ?, ?);");
        $stmt->bind_param("sssssss", 
            $input['firstname'], $input['lastname'], $input['age'], $input['gender'], $input['location'], $username, $password
        );
        if (!$stmt->execute()) {
            internal_error();
            // TODO might have to handle duplicate usernames here (also no constrait on table yet.. problem)
        }
    }

    echo('/130-project/game.php');
}

?>