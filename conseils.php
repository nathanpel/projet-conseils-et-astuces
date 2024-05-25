<?php
session_start();

function getConseilsByCategory($category) {
    $file = 'conseils.csv';
    $conseils = [];

    if (file_exists($file)) {
        if (($handle = fopen($file, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                // S'assurer que les indices nécessaires existent dans $data
                if (isset($data[1]) && $data[1] == $category) {
                    $conseils[] = $data;
                }
            }
            fclose($handle);
        }
    }

    return $conseils;
}

$maisonConseils = getConseilsByCategory('maison');
$santeConseils = getConseilsByCategory('sante');
$cuisineConseils = getConseilsByCategory('cuisine');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conseils</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Conseils</h1>
            <nav>
                <ul>
                    <li><a href="index.html">Accueil</a></li>
                    <li><a href="conseils.php">Conseils</a></li>
                    <li><a href="soumission.html">Soumettre un conseil</a></li>
                    <li><a href="connexion.html">Connexion</a></li>
                    <li><a href="profil.php">Profil</a></li>
                </ul>
            </nav>
            <img src="https://static.vecteezy.com/ti/vecteur-libre/p3/5556111-ampoule-icone-vecteur-idee-signe-solution-pensee-concept-couleur-jaune-modele-gratuit-vectoriel.jpg" alt="Logo" class="logo">
        </div>
    </header>
    <main>
        <div class="container">
            <h2>Maison</h2>
            <ul>
                <?php foreach ($maisonConseils as $conseil): ?>
                    <li>
                        <h3><?php echo htmlspecialchars($conseil[0]); ?></h3>
                        <p><strong>Catégorie:</strong> <?php echo htmlspecialchars($conseil[1]); ?></p>
                        <p><strong>Contenu:</strong> <?php echo htmlspecialchars($conseil[2]); ?></p>
                        <p><strong>Posté par:</strong> <?php echo htmlspecialchars($conseil[3]); ?></p>
                        <?php if (isset($conseil[4]) && $conseil[4]): ?>
                            <img src="<?php echo htmlspecialchars($conseil[4]); ?>" alt="Image du conseil">
                        <?php endif; ?>
                        <?php if (isset($conseil[5]) && $conseil[5]): ?>
                            <video controls>
                                <source src="<?php echo htmlspecialchars($conseil[5]); ?>" type="video/mp4">
                                Votre navigateur ne supporte pas la vidéo.
                            </video>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['username']) && $_SESSION['username'] == $conseil[3]): ?>
                            <form action="modifier_conseil.php" method="get" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($conseil[0]); ?>">
                                <button type="submit">Modifier</button>
                            </form>
                            <form action="supprimer_conseil.php" method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($conseil[0]); ?>">
                                <button type="submit">Supprimer</button>
                            </form>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>

            <h2>Santé</h2>
            <ul>
                <?php foreach ($santeConseils as $conseil): ?>
                    <li>
                        <h3><?php echo htmlspecialchars($conseil[0]); ?></h3>
                        <p><strong>Catégorie:</strong> <?php echo htmlspecialchars($conseil[1]); ?></p>
                        <p><strong>Contenu:</strong> <?php echo htmlspecialchars($conseil[2]); ?></p>
                        <p><strong>Posté par:</strong> <?php echo htmlspecialchars($conseil[3]); ?></p>
                        <?php if (isset($conseil[4]) && $conseil[4]): ?>
                            <img src="<?php echo htmlspecialchars($conseil[4]); ?>" alt="Image du conseil">
                        <?php endif; ?>
                        <?php if (isset($conseil[5]) && $conseil[5]): ?>
                            <video controls>
                                <source src="<?php echo htmlspecialchars($conseil[5]); ?>" type="video/mp4">
                                Votre navigateur ne supporte pas la vidéo.
                            </video>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['username']) && $_SESSION['username'] == $conseil[3]): ?>
                            <form action="modifier_conseil.php" method="get" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($conseil[0]); ?>">
                                <button type="submit">Modifier</button>
                            </form>
                            <form action="supprimer_conseil.php" method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($conseil[0]); ?>">
                                <button type="submit">Supprimer</button>
                            </form>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>

            <h2>Cuisine</h2>
            <ul>
                <?php foreach ($cuisineConseils as $conseil): ?>
                    <li>
                        <h3><?php echo htmlspecialchars($conseil[0]); ?></h3>
                        <p><strong>Catégorie:</strong> <?php echo htmlspecialchars($conseil[1]); ?></p>
                        <p><strong>Contenu:</strong> <?php echo htmlspecialchars($conseil[2]); ?></p>
                        <p><strong>Posté par:</strong> <?php echo htmlspecialchars($conseil[3]); ?></p>
                        <?php if (isset($conseil[4]) && $conseil[4]): ?>
                            <img src="<?php echo htmlspecialchars($conseil[4]); ?>" alt="Image du conseil">
                        <?php endif; ?>
                        <?php if (isset($conseil[5]) && $conseil[5]): ?>
                            <video controls>
                                <source src="<?php echo htmlspecialchars($conseil[5]); ?>" type="video/mp4">
                                Votre navigateur ne supporte pas la vidéo.
                            </video>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['username']) && $_SESSION['username'] == $conseil[3]): ?>
                            <form action="modifier_conseil.php" method="get" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($conseil[0]); ?>">
                                <button type="submit">Modifier</button>
                            </form>
                            <form action="supprimer_conseil.php" method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($conseil[0]); ?>">
                                <button type="submit">Supprimer</button>
                            </form>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>Plateforme de conseils et d'astuces - Tous droits réservés</p>
        </div>
    </footer>
</body>
</html>
