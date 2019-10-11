<?php

session_start();
require_once "db.php";

$errors = array();
$contacts = array();

$encode_contacts;
$pseudo = $_POST['pseudo'];

$req = $pdo->query("SELECT id FROM member WHERE pseudo = '".$pseudo."'");
if ($pseudo == null) $errors['pseudo'] = "Vous devez entrer un pseudo !";
elseif ($pseudo == $_SESSION['pseudo']) $errors['pseudo'] = "Vous ne pouvez pas ajouter votre compte !";
elseif (!$req->fetch()) $errors['pseudo'] = "Ce pseudo ne correspond à aucun compte !";
else {

    if ($_SESSION['contacts'] == null) $contacts[0] = $pseudo;
    else {

        $contacts = json_decode($_SESSION['contacts'], true);

        foreach ($contacts as $contact) {

                if ($contact == $pseudo) $errors['pseudo'] = "Ce compte est déjà enregistrer dans vos contacts !";
        }

        if (empty($errors)) $contacts[count($contacts)] = $pseudo;
    }

    if (empty($errors)) {
        
        $encode_contacts = json_encode($contacts);

        $req = $pdo->query("UPDATE member SET contacts = '".$encode_contacts."' WHERE id = '".$_SESSION['id']."'");
        $_SESSION['contacts'] = $encode_contacts;
    }
}

echo json_encode($errors);