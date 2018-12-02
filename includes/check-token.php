<?php

include('./php/token.php');

if (isset($_COOKIE[$token_cookie_name])) {
    $token = get_token_payload($_COOKIE[$token_cookie_name]);
}

function redirect_to_login() {
    header('Location: /130-project/');
}

function validateToken($doRedirect=false) {
    global $token;
    if (!isset($token) || $token === NULL || $token['user_id'] === NULL) {
        if ($doRedirect) {
            redirect_to_login();
        }
        $GLOBALS['is_logged_in'] = false;
    } else {
        $GLOBALS['user_id'] = $token['user_id'];
        $GLOBALS['is_logged_in'] = true;
    }
}

?>