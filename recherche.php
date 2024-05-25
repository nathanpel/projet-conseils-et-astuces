<?php
// recherche.php

// Fonction pour récupérer les conseils correspondant aux critères de recherche
function searchConseils($keyword, $category) {
    $file = 'conseils.csv';
    $results = [];

    if (file_exists($file)) {
        if (($handle = fopen($file, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                // Vérifier si le conseil correspond aux critères de recherche
                $title = isset($data[0]) ? $data[0] : '';
                $conseilCategory = isset($data[1]) ? $data[1] : '';
                $content = isset($data[2]) ? $data[2] : '';
                $username = isset($data[3]) ? $data[3] : '';
                $image = isset($data[4]) ? $data[4] : '';
                $video = isset($data[5]) ? $data[5] : '';

                if (($keyword === '' || stripos($title, $keyword) !== FALSE || stripos($content, $keyword) !== FALSE) 
                    && ($category === '' || $conseilCategory === $category)) {
                    $results[] = $data;
                }
            }
            fclose($handle);
        }
    }

    return $results;
}

// Récupérer les critères de recherche depuis la requête GET
$keyword = isset($_GET['q']) ? $_GET['q'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Effectuer la recherche
$results = searchConseils($keyword, $category);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de la recherche</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Résultats de la recherche</h1>
            <nav>
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
            <h2>Résultats de la recherche</h2>
            <ul>
                <?php if (!empty($results)): ?>
                    <?php foreach ($results as $conseil): ?>
                        <li>
                            <h3><?php echo htmlspecialchars($conseil[0]); ?></h3>
                            <p><strong>Catégorie:</strong> <?php echo htmlspecialchars($conseil[1]); ?></p>
                            <p><strong>Contenu:</strong> <?php echo htmlspecialchars($conseil[2]); ?></p>
                            <p><strong>Posté par:</strong> <?php echo htmlspecialchars($conseil[3]); ?></p>
                            <?php if ($conseil[4]): ?>
                                <img src="<?php echo htmlspecialchars($conseil[4]); ?>" alt="Image du conseil">
                            <?php endif; ?>
                            <?php if ($conseil[5]): ?>
                                <video controls>
                                    <source src="<?php echo htmlspecialchars($conseil[5]); ?>" type="video/mp4">
                                    Votre navigateur ne supporte pas la vidéo.
                                </video>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>Aucun résultat trouvé.</li>
                <?php endif; ?>
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

