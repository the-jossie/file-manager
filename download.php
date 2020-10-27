<?php

session_start();
if(!empty($_GET['file']))
{
    $filename = basename($_GET['file']);
    $filePath = "files/" . $filename;

    if (!empty($filename) && file_exists($filePath)) {
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition:attachment; filename=$filename");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");

        readfile($filePath);
        header("location: index.php");
        exit;
    }
    else 
    {
        echo "file doesn't exist";
        header("location: index.php");
    }
}
else{
    header("location: index.php");
}