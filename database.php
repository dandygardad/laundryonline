<?php
$serverName = 'localhost';
$userName = 'root';
$password = '';
$dbName = 'laundry';

try{
    $pdo = new PDO("mysql:host=$serverName;port=3306;dbname=$dbName",$userName, $password);
}
catch(PDOException $e){
    echo 'Error, dikarenakan ' . $e ->getMessage();
}

?>