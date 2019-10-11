<?php

session_start();
require_once 'db.php';

$errors = array();

$pseudo = $_POST['pseudo'];
$email = $_POST['email'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];

if (empty($pseudo) || empty($email) || empty($password1) || empty($password2)) $errors['all'] = "Vous devez remplir tous les champs !";
else {

    if (strlen($pseudo) > 256) $errors['pseudo'] = "Votre pseudo est trop long !";
    $req = $pdo->query("SELECT id FROM member WHERE pseudo = '".$pseudo."'");
    if ($req->fetch()) $errors['pseudo'] = "Votre pseudo est déjà pris !";

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = "Votre email n'est pas valide !";
    $req = $pdo->query("SELECT id FROM member WHERE email = '".$email."'");
    if ($req->fetch()) $errors['email'] = "Votre email est déjà pris !";

    if ($password1 != $password2) $errors['password'] = "Les deux mots de passe ne sont pas identique !";
    if (!ctype_alnum($password1)) $errors['password'] = "Votre mot de passe doit être alphanumérique !";
        
    if (empty($errors)) {
            
        $req = $pdo->query("INSERT INTO member SET pseudo = '".$pseudo."', email = '".$email."', password = '".sha1($password1)."'");
        $req = $pdo->query("SELECT id FROM member WHERE pseudo = '".$pseudo."' AND password = '".$password1."'");
        $id = $req->fetch()->id;

        $_SESSION['id'] = $id;
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password1;
        $_SESSION['contacts'] = null;
    }
}

echo json_encode($errors);