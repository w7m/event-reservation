<?php
try
{
    $db = new PDO('mysql:host=localhost;dbname=select_test;charset=utf8', 'root', '');
    //echo 'Connexion réussie !';
}
catch (PDOException $e)
{
    echo 'La connexion a échoué.<br />';
    echo 'Informations : [', $e->getCode(), '] ', $e->getMessage();
}
