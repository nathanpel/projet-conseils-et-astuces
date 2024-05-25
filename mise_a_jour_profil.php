<?php
// Démarre la capture de sortie
ob_start();
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mettre à jour le profil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Mettre à jour le profil</h1>
        </div>
    </header>
    <main>
        <div class="container">
            <?php
            if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
                $user_email = '';

                // Lire les informations utilisateur depuis users.csv
                if (($handle = fopen('users.csv', 'r')) !== FALSE) {
                    while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                        if ($data[0] == $username) {
                            $user_email = $data[1];
                            break;
                        }
                    }
                    fclose($handle);
                }
            ?>
                <form action="traitement_mise_a_jour.php" method="post">
                    <div class="form-group">
                        <label for="username">Nom d'utilisateur :</label>
                        <input type="text" id="username" name="username" value="<?php echo $username; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input type="email" id="email" name="email" value="<?php echo $user_email; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Nouveau mot de passe (laisser vide si inchangé) :</label>
                        <input type="password" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <button type="submit">Mettre à jour</button>
                    </div>
                </form>
            <?php
            } else {
                header('Location: connexion.html');
                exit();
            }
            ?>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>Plateforme de conseils et d'astuces - Tous droits réservés</p>
        </div>
    </footer>
</body>
</html>

<?php
// Envoie le contenu du tampon de sortie
ob_end_flush();
?>
