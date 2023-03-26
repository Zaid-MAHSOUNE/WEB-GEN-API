<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

require_once "../../../functions/compiler_fun.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $f=file_get_contents("php://input");
    $f = json_decode($f);
    $f = json_decode($f->body);
    $html_file = fopen("../../../data/project.html","w");
    $css_file = fopen("../../../data/project.css","w");
    fwrite($html_file,'<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="project.css">
        <title>WEP-GEN-API</title>
    </head>
    <body>');
    fwrite($html_file,html_compiler($f));
    fwrite($html_file,'</body>
    </html>');
    fwrite($css_file,css_compiler($f));
}

?>