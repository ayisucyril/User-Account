<?php
/*$db_user = "root";
$db_pass = "";
$db_name = "useraccount";

$db = new PDO('mysql:host = localhost;dbname=' . $db_name . '; charset=utf8', $db_user, $db_pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
*/


$db_user = "root";
$db_pass = "";
$db_name = "useraccount";

try {
    $dsn = 'mysql:host=localhost;dbname=' . $db_name . ';charset=utf8';
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $db = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

?>
