<?php

session_start();
require_once "db.php";

$errors = array();

$des_s = json_decode($_POST['des']);
$message = $_POST['message'];

if (!(count($des_s) > 0)) $errors['pseudo'] = "Vous devez sélectionner au moins un destinataire !";
if (strlen($message) > 255) $errors['message'] = "Votre message est trop long !";

if (empty($errors)) {

    foreach ($des_s as $des) {

        $req = $pdo->query('INSERT INTO tchat SET pseudo = "'.$_SESSION['pseudo'].'", des = "'.$des.'", message = "'.$message.'"');
    }
}

echo json_encode($errors);