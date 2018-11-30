<?php

include('./php/jwt.php');

if (isset($_COOKIE[$jwt_cookie_name])) {
    // TODO validate cookie
} else {
    header('Location: /130-project/log.php');
}

?>