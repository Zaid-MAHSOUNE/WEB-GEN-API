<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

require_once "../../../functions/compiler_fun.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $f=file_get_contents("php://input");
    $f = json_decode($f);
    $html_file = fopen("../../../data/project.html","w");
    $css_file = fopen("../../../data/project.css","w");
    fwrite($html_file,html_compiler($f)); 
    fwrite($css_file,css_compiler($f));
}

?>