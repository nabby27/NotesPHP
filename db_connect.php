<?php
$link = 'mysql:host=localhost; dbname=MyNotes';
$user = 'root';
$pass = 'root';
try{
    $gbd = new PDO($link, $user, $pass);
} catch (PDOException $e) {
    print '¡Error!: ' . $e->getMessage() . '<br/>';
    die();
}
?>