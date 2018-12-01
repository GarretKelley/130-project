<?php

include('./php/token.php');

$token = get_token_payload($_COOKIE[$token_cookie_name]);

function redirect_to_login() {
    header('Location: /130-project/log.php');
}

if ($token !== NULL) {
    $user_id = $token['user_id'];
    if ($user_id === NULL) {
        redirect_to_login();
    }
} else {
    redirect_to_login();
}

?>