<?php

$zip = new ZipArchive;
$current_zip = $zip->open("../../../data/test.zip",ZipArchive::OVERWRITE);

if($current_zip) {
    $zip->addFile("../../../data/project.html","project.html");
    $zip->addFile("../../../data/project.css","project.css");
    $zip->close();
}


if(file_exists("../../../data/test.zip")) {
    $zip_name = "test.zip";
    ob_clean();
    header("Content-Disposition: attachment; filename=$zip_name");
    header("Content-length: " . filesize("../../../data/test.zip"));
    header("Pragma: no-cache"); 
    header("Expires: 0"); 
    header("Pragma: public");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-type: application/octet-stream");
    header("Content-Transfer-Encoding: binary");
    ob_end_flush();
    @readfile("../../../data/test.zip");
    
}

?>