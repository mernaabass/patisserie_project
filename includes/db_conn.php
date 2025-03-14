
<?php

    $host = "localhost";

    $dbPass = "";

    $dbName = "patisserie";

    $dbUser = "root";

    $dbport = "3307";

    date_default_timezone_set("Africa/Cairo");



    try {

        $db = new PDO("mysql:host=" . $host . ";dbname=" . $dbName . ";port=" . $dbport, $dbUser, $dbPass);

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $db->exec("SET NAMES 'utf8'");

        // echo "connect";

    } catch (Exception $e) {

        echo "Could not connect to the database.";

        exit;

    }

?>



