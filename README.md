config.php : Crée une classe pour gérer la connexion à la base de données SQLite de manière sécurisée et efficace, en utilisant une propriété statique pour stocker l'instance unique de la connexion, un constructeur privé pour empêcher l'instanciation directe de la classe, et une méthode statique pour obtenir cette instance de connexion.

connexion.html : Structure une page de connexion avec des sections distinctes pour la tête, l'en-tête, le contenu principal (formulaire de connexion) et le pied de page, facilitant ainsi une interface utilisateur claire et fonctionnelle.

conseils.php : Affiche une page de conseils catégorisés avec des options de gestion pour les utilisateurs connectés, en utilisant PHP pour récupérer les conseils depuis un fichier CSV et HTML pour afficher les conseils par catégorie.

deconnexion.php : Gère la déconnexion des utilisateurs en effaçant et détruisant la session, puis redirigeant vers la page de connexion.

index.html: Crée une page d'accueil pour une plateforme de conseils avec une navigation, des sections de contenu et un formulaire de recherche, offrant ainsi une expérience utilisateur complète dès la page d'accueil.

index.php : Offre une interface utilisateur pour explorer différents conseils et astuces dans divers domaines de la vie quotidienne, en fournissant des sections distinctes pour les conseils populaires et les conseils récents.

init_csv.php : Assure que les fichiers CSV nécessaires existent et sont correctement formatés pour stocker les informations des utilisateurs et des conseils, en créant les fichiers avec les en-têtes appropriés s'ils n'existent pas déjà.

inscription.html : Permet aux utilisateurs de s'inscrire sur la plateforme en fournissant leur nom d'utilisateur, leur email et leur mot de passe, structurant ainsi une page d'inscription avec un formulaire et des liens de navigation.

mise_a_jour_profil.php : Permet aux utilisateurs connectés de mettre à jour leurs informations de profil, telles que leur nom d'utilisateur, leur email et leur mot de passe, en fournissant un formulaire pré-rempli pour la mise à jour et en vérifiant la session utilisateur.

modifier_conseil.php : Permet à un utilisateur connecté de modifier les détails d'un conseil spécifique sur la plateforme, en récupérant et en affichant le conseil existant dans un formulaire pré-rempli et en permettant à l'utilisateur de soumettre des modifications.

profil.php : Affiche la page de profil d'un utilisateur avec ses informations personnelles et les conseils qu'il a soumis, en offrant des fonctionnalités de mise à jour du profil et de déconnexion.
