<?php

$token_secret = '130SuPERS3cr3t!';
$token_method = 'aes-256-cbc';
$token_cookie_name = '130auth';

function make_token($payload) {
    global $token_secret, $token_method;
    $payloadEncoded = json_encode($payload);
    return openssl_encrypt($payloadEncoded, $token_method, $token_secret, 0, '1234567890123456');
}

function get_token_payload($token) {
    global $token_secret, $token_method;
    $decryptedToken = openssl_decrypt($token, $token_method, $token_secret, 0, '1234567890123456');
    return json_decode($decryptedToken, true);
}

?>