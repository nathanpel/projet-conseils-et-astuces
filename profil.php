<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: connexion.html');
    exit();
}

$username = $_SESSION['username'];
$user_email = '';
$user_tips = [];

// Lire les informations utilisateur depuis users.csv
if (($handle = fopen('users.csv', 'r')) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
        if (isset($data[0]) && $data[0] == $username) {
            $user_email = $data[1];
            break;
        }
    }
    fclose($handle);
}

// Lire les conseils soumis par l'utilisateur depuis conseils.csv
if (($handle = fopen('conseils.csv', 'r')) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
        if (isset($data[3]) && $data[3] == $username) {  // Vérifier que l'index 3 existe
            $user_tips[] = $data;
        }
    }
    fclose($handle);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Profil Utilisateur</h1>
            <nav>
                <img src=https://static.vecteezy.com/ti/vecteur-libre/p3/5556111-ampoule-icone-vecteur-idee-signe-solution-pensee-concept-couleur-jaune-modele-gratuit-vectoriel.jpg alt="Logo" class="logo">
                <ul>
                    <li><a href="index.html">Accueil</a></li>
                    <li><a href="conseils.php">Conseils</a></li>
                    <li><a href="soumission.html">Soumettre un conseil</a></li>
                    <li><a href="connexion.html">Connexion</a></li>
                    <li><a href="profil.php">Profil</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <div class="container">
            <h2>Nom d'utilisateur : <?php echo htmlspecialchars($username); ?></h2>
            <h2>Email : <?php echo htmlspecialchars($user_email); ?></h2>
            <h3>Conseils soumis :</h3>
            <ul>
                <?php
                foreach ($user_tips as $tip) {
                    echo '<li>';
                    echo '<h4>' . htmlspecialchars($tip[0]) . '</h4>'; // Titre
                    echo '<p>' . htmlspecialchars($tip[2]) . '</p>'; // Contenu
                    if (!empty($tip[4])) {
                        echo '<img src="' . htmlspecialchars($tip[4]) . '" alt="Image du conseil">';
                    }
                    if (!empty($tip[5])) {
                        echo '<video controls>';
                        echo '<source src="' . htmlspecialchars($tip[5]) . '" type="video/mp4">';
                        echo 'Votre navigateur ne supporte pas la vidéo.';
                        echo '</video>';
                    }
                    echo '</li>';
                }
                ?>
            </ul>
            <a href="mise_a_jour_profil.php">Mettre à jour le profil</a>
            <br>
            <a href="deconnexion.php">Se déconnecter</a>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>Plateforme de conseils et d'astuces - Tous droits réservés</p>
        </div>
    </footer>
</body>
</html>


