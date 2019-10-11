<?php

session_start();
require_once "db.php";

$errors = array();

$session_contacts = json_decode($_SESSION['contacts']);
$contacts = json_decode($_POST['contacts']);

$j = 0;

if (count($contacts) > 0) {

    foreach ($session_contacts as $session_contact) {

        for ($i = 0; $i < count($contacts); $i++) {

            if ($session_contact == $contacts[$i]) unset($session_contacts[$j]);
        }

        $j++;
    }

    $session_contacts = json_encode($session_contacts);

    $_SESSION['contacts'] = $session_contacts;

    $req = $pdo->query("UPDATE member SET contacts = '".$session_contacts."' WHERE id = '".$_SESSION['id']."'");
} else $errors['pseudo'] = "Vous devez sélectionner au moins un pseudo !";

echo json_encode($errors);

