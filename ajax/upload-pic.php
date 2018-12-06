<?php

    if (0 < $_FILES['file']['error']) {
        http_response_code(400);
        die();
    }
    else {
        move_uploaded_file($_FILES['file']['tmp_name'], '../profile-pics/' . $_FILES['file']['name']);
    }

?>