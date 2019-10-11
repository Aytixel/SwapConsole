<?php

require_once 'db.php';

$errors = array();

$email = $_POST['email'];

if (empty($email)) $errors['all'] = "Vous devez entrer un email !";
else {

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = "Votre email n'est pas valide !";
    $req = $pdo->query("SELECT id FROM member WHERE email = '".$email."'");
    if (!$req->fetch()) $errors['email'] = "Votre email ne correspond à aucun compte !";

    if (empty($errors)) {

        $password = "root".rand(0, 999999);
        $message = '
            <!DOCTYPE html>
            <html lang="fr-FR">

                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                </head>

                <body>
                    <center style="font-family: monospace;">
                        <h1>Bonjour<h1>
                        <p>
                            Voici votre nouveau mot de passe : '.$password.'
                            <br/>
                            <br/>
                            Une fois connecter nous vous conseillons de changer le mot de passe
                            <br/>
                            <br/>
                            A bientôt sur SwapConsole
                        </p>
                    </center>
                </body>

            </html>';
        
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= 'From: assistance@swapconsole.esy.es' . "\r\n";
        $headers .= 'Reply-To: assistance@swapconsole.esy.es' . "\r\n";

        mail($email, utf8_encode("SwapConsole : Récupérer votre compte"), $message, $headers);

        $req = $pdo->query("UPDATE member SET password = '".sha1($password)."' WHERE email = '".$email."'");
    }
}

echo json_encode($errors);