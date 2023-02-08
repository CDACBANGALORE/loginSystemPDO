<?php
    include "../config/config.php";

    function connect($servername, $username, $password, $dbname){
        $dsn = "mysql:host=".$servername.";dbname=".$dbname.";charset=UTF8";
        try {
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
            return new PDO($dsn, $username, $password, $options);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    return connect($servername, $username, $password, $dbname);
?>