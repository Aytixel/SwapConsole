<?php

session_start();
require_once "db.php";

$errors = array();

$username = $_POST['username'];
$password = $_POST['password'];

if (empty($username) && empty($password)) $errors['all'] = "Vous devez remplir tous les champs !";
else {

    if (filter_var($username, FILTER_VALIDATE_EMAIL)) $sql = "SELECT * FROM member WHERE email = '".$username."' AND password = '".sha1($password)."'";
    else $sql = "SELECT * FROM member WHERE pseudo = '".$username."' AND password = '".sha1($password)."'";

    $req = $pdo->query($sql);

    if ($req->rowCount() == 1) {

        $user = $req->fetch();
        
        $_SESSION['id'] = $user->id;
        $_SESSION['pseudo'] = $user->pseudo;
        $_SESSION['email'] = $user->email;
        $_SESSION['password'] = $user->password;
        $_SESSION['contacts'] = $user->contacts;
    } else $errors['all'] = "Vos identifiant ne correspondent à aucun compte !";
}

echo json_encode($errors);