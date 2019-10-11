<?php

session_start();
require_once "db.php";

$errors = array();

$pseudo = $_POST['pseudo'];
$email = $_POST['email'];
$password = $_POST['password'];

if (empty($pseudo) && empty($email) && empty($password)) $errors['all'] = "Vous devez remplir un des champs !";
else {

    if ($pseudo == null) $pseudo = $_SESSION['pseudo'];
    else {

        if (strlen($pseudo) > 256)  $errors['pseudo'] = "Votre pseudo est trop long !";
        $req = $pdo->query("SELECT id FROM member WHERE pseudo = '".$pseudo."'");
        if ($req->fetch()) $errors['pseudo'] = "Votre pseudo est déjà pris !";
    }

    if ($email == null) $email = $_SESSION['email'];
    else {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = "Votre email n'est pas valide !";
        $req = $pdo->query("SELECT id FROM member WHERE email = '".$email."'");
        if ($req->fetch()) $errors['email'] = "Votre email est déjà pris !";
    }

    if ($password == null) $password = $_SESSION['password'];
    else {
        
        if (!ctype_alnum($password)) $errors['password'] = "Votre mot de passe doit être alphanumérique !";

        $password = sha1($password);
    }

    if (empty($errors)) {

        $req = $pdo->query("UPDATE member SET pseudo = '".$pseudo."', email = '".$email."', password = '".$password."' WHERE id = '".$_SESSION['id']."'");

        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
    }
}

echo json_encode($errors);