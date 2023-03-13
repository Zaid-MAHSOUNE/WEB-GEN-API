<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

require_once "../../../functions/compiler_fun.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $f=file_get_contents("php://input");
    $f = json_decode($f);
    echo css_compiler($f);
}
/*$f=file_get_contents("php://input");
    $file = file_get_contents("../json/data.json");
    echo $file;
*/
?>