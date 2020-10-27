<?php

session_start();

require_once('config/DatabaseClass.php');

$database = new DatabaseClass();

if(!empty($_GET['file']))
{
    $filename = basename($_GET['file']);
    $filePath = "files/" . $filename;

    if (!empty($filename) && file_exists($filePath)) {
        
        $sql = "DELETE FROM filedownload WHERE filename=:filename";
        $stmt = $database->Remove($sql, ['filename' => $filename]);

        unlink($filePath);
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