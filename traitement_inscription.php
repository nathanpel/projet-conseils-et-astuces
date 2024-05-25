<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file = 'users.csv';

    // Récupération et sécurisation des données du formulaire
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];

    // Validation des données
    if (empty($username) || empty($email) || empty($password)) {
        echo "Tous les champs sont obligatoires.";
        exit();
    }

    // Hachage du mot de passe
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $userExists = false;

    // Vérification si l'utilisateur existe déjà
    if (file_exists($file)) {
        $handle = fopen($file, 'r');
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            if ($data[0] == $username || $data[1] == $email) {
                $userExists = true;
                break;
            }
        }
        fclose($handle);
    }

    // Inscription de l'utilisateur si les données sont valides
    if (!$userExists) {
        $handle = fopen($file, 'a');
        fputcsv($handle, [$username, $email, $hashedPassword]);
        fclose($handle);

        // Redirection vers la page de connexion après inscription réussie
        header('Location: ./connexion.html');
        exit();
    } else {
        echo "Nom d'utilisateur ou email déjà utilisé.";
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inscription</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <header>
            <div class="container">
                <h1>Inscription</h1>
            </div>
        </header>
        <main>
            <div class="container">
                <form action="traitement_inscription.php" method="post">
                    <div class="form-group">
                        <label for="username">Nom d'utilisateur :</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe :</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit">S'inscrire</button>
                    </div>
                </form>
                <p>Déjà un compte ? <a href="connexion.html">Se connecter</a></p>
            </div>
        </main>
        <footer>
            <div class="container">
                <p>Plateforme de conseils et d'astuces - Tous droits réservés</p>
            </div>
        </footer>


    </body>

</html>
