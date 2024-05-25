<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file = 'users.csv';
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    $handle = fopen($file, 'r');
    $userExists = false;

    while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
        if ($data[0] == $username && password_verify($password, $data[2])) {
            $userExists = true;
            $_SESSION['username'] = $username;
            break;
        }
    }
    fclose($handle);

    if ($userExists) {
        header('Location: profil.php');
        exit();
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Connexion</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <div class="container">
                <h1>Connexion</h1>
            </div>
        </header>
        <main>
            <div class="container">
                <form action="traitement_connexion.php" method="post">
                    <div class="form-group">
                        <label for="username">Nom d'utilisateur :</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe :</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit">Se connecter</button>
                    </div>
                </form>
                <p>Pas encore de compte ? <a href="inscription.html">S'inscrire</a></p>
            </div>
        </main>
        <footer>
            <div class="container">
                <p>Plateforme de conseils et d'astuces - Tous droits réservés</p>
            </div>
        </footer>
    </body>
</html>
