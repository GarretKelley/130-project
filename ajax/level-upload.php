<?php

if (0 < $_FILES['file']['error']) {
    //http_response_code(400);
    //die();
} else {
    $image = imagecreatefrompng($_FILES['file']['tmp_name']);

    $width = imagesx($image);
    $height = imagesy($image);

    $board = '';
    for ($y=0; $y < $height; $y++) {
        for ($x=0; $x < $width; $x++) {
            // get current pixel colour
            $rgb = imagecolorat($image, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8 ) & 0xFF;
            $b = $rgb & 0xFF;
            $pixel = ($r + $g + $b)/3;

            // value below 150 is 1 
            if ($pixel < 150) {
                $board .= "1";
            } else {
                $board .= "0";
            }
        }
    }
    echo("game.php?level=$board");
}

?>