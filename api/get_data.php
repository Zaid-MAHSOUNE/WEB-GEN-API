<?php
header("Content-Type:application/json");
    $file = file_get_contents("../json/data.json");
    echo $file;
?>