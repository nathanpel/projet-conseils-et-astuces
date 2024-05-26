<?php
session_start();

function getConseilsByCategory($category) {
    $file = 'conseils.csv';
    $conseils = [];

    if (file_exists($file)) {
        if (($handle = fopen($file, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                if (isset($data[1]) && $data[1] == $category) {
                    $conseils[] = $data;
                }
            }
            fclose($handle);
        }
    }

    return $conseils;
}

function getCommentaires($conseilId) {
    $file = 'commentaires.csv';
    $commentaires = [];

    if (file_exists($file)) {
        if (($handle = fopen($file, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                if ($data[0] == $conseilId) {
                    $commentaires[] = $data;
                }
            }
            fclose($handle);
        }
    }

    return $commentaires;
}

function getAverageRating($conseilId) {
    $file = 'notes.csv';
    $total = 0;
    $count = 0;

    if (file_exists($file)) {
        if (($handle = fopen($file, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                if ($data[0] == $conseilId) {
                    $total += $data[1];
                    $count++;
                }
            }
            fclose($handle);
        }
    }

    return $count ? $total / $count : 0;
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

                        <div class="rating">
                            <form action="noter.php" method="post">
                                <input type="hidden" name="conseil_id" value="<?php echo htmlspecialchars($conseil[0]); ?>">
                                <label for="rating">Note :</label>
                                <select name="rating" id="rating">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <button type="submit">Noter</button>
                            </form>
                            <span>Note moyenne: <?php echo number_format(getAverageRating($conseil[0]), 2); ?> / 5</span>
                        </div>
                        <div class="comments">
                            <h4>Commentaires :</h4>
                            <?php
                            $commentaires = getCommentaires($conseil[0]);
                            foreach ($commentaires as $commentaire):
                            ?>
                                <p><?php echo htmlspecialchars($commentaire[1]); ?> - <strong><?php echo htmlspecialchars($commentaire[2]); ?></strong></p>
                            <?php endforeach; ?>
                            <?php if (isset($_SESSION['username'])): ?>
                                <form action="commentaire.php" method="post">
                                    <input type="hidden" name="conseil_id" value="<?php echo htmlspecialchars($conseil[0]); ?>">
                                    <textarea name="comment" placeholder="Laisser un commentaire"></textarea>
                                    <button type="submit">Commenter</button>
                                </form>
                            <?php else: ?>
                                <p><a href="connexion.html">Connectez-vous</a> pour laisser un commentaire.</p>
                            <?php endif; ?>
                        </div>
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

                        <div class="rating">
                            <form action="noter.php" method="post">
                                <input type="hidden" name="conseil_id" value="<?php echo htmlspecialchars($conseil[0]); ?>">
                                <label for="rating">Note :</label>
                                <select name="rating" id="rating">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <button type="submit">Noter</button>
                            </form>
                            <span>Note moyenne: <?php echo number_format(getAverageRating($conseil[0]), 2); ?> / 5</span>
                        </div>
                        <div class="comments">
                            <h4>Commentaires :</h4>
                            <?php
                            $commentaires = getCommentaires($conseil[0]);
                            foreach ($commentaires as $commentaire):
                            ?>
                                <p><?php echo htmlspecialchars($commentaire[1]); ?> - <strong><?php echo htmlspecialchars($commentaire[2]); ?></strong></p>
                            <?php endforeach; ?>
                            <?php if (isset($_SESSION['username'])): ?>
                                <form action="commentaire.php" method="post">
                                    <input type="hidden" name="conseil_id" value="<?php echo htmlspecialchars($conseil[0]); ?>">
                                    <textarea name="comment" placeholder="Laisser un commentaire"></textarea>
                                    <button type="submit">Commenter</button>
                                </form>
                            <?php else: ?>
                                <p><a href="connexion.html">Connectez-vous</a> pour laisser un commentaire.</p>
                            <?php endif; ?>
                        </div>
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

                        <div class="rating">
                            <form action="noter.php" method="post">
                                <input type="hidden" name="conseil_id" value="<?php echo htmlspecialchars($conseil[0]); ?>">
                                <label for="rating">Note :</label>
                                <select name="rating" id="rating">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <button type="submit">Noter</button>
                            </form>
                            <span>Note moyenne: <?php echo number_format(getAverageRating($conseil[0]), 2); ?> / 5</span>
                        </div>
                        <div class="comments">
                            <h4>Commentaires :</h4>
                            <?php
                            $commentaires = getCommentaires($conseil[0]);
                            foreach ($commentaires as $commentaire):
                            ?>
                                <p><?php echo htmlspecialchars($commentaire[1]); ?> - <strong><?php echo htmlspecialchars($commentaire[2]); ?></strong></p>
                            <?php endforeach; ?>
                            <?php if (isset($_SESSION['username'])): ?>
                                <form action="commentaire.php" method="post">
                                    <input type="hidden" name="conseil_id" value="<?php echo htmlspecialchars($conseil[0]); ?>">
                                    <textarea name="comment" placeholder="Laisser un commentaire"></textarea>
                                    <button type="submit">Commenter</button>
                                </form>
                            <?php else: ?>
                                <p><a href="connexion.html">Connectez-vous</a> pour laisser un commentaire.</p>
                            <?php endif; ?>
                        </div>
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
