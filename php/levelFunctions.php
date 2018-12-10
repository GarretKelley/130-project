<?php

include_once('connection.php');

function getLevel($size, $offset) {
    $db = connectDB();
    $stmt = $db->prepare("SELECT small, large FROM levels WHERE size=? ORDER BY ID LIMIT 1 OFFSET ?");
    $stmt->bind_param('ii', $size, $offset);
    if (!$stmt->execute()) {
        internal_error();
    }
    $stmt->bind_result($small, $large);
    $stmt->fetch();
    if ($size === 0) {
        $gameGrid = array_chunk(str_split($small), 7);
    } else if ($size === 1) {
        $gameGrid = array_chunk(str_split($large), 13);
    }
    return $gameGrid;
}

function getRandomLevel($size) {
    $length = $size === 0 ? 49 : 169;
    $str = join('', array_map(function() { return rand(0, 1); }, range(1, $length)));
    if ($size === 0) {
        $gameGrid = array_chunk(str_split($str), 7);
    } else if ($size === 1) {
        $gameGrid = array_chunk(str_split($str), 13);
    }
    return $gameGrid;
}

function getCounts($arr) {
    $counts = [];
    $streak = 0;
    foreach($arr as $val) {
        if ($val === '1') {
            $streak++;
        } else if ($streak !== 0) {
            array_push($counts, $streak);
            $streak = 0;
        }
    }
    if ($streak !== 0) {
        array_push($counts, $streak);
    }
    return $counts;
}

?>