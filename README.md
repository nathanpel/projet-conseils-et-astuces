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
Ce script est chargé de traiter les données soumises via un formulaire de soumission de conseils. Voici un aperçu de son fonctionnement :

Session Handling: Le script démarre une session PHP pour gérer les sessions utilisateur.
Vérification de l'Authentification: Il vérifie si l'utilisateur est authentifié en vérifiant la présence de la clé 'username' dans la session. Si l'utilisateur n'est pas authentifié, il est redirigé vers la page de connexion.

Suppression d'un Conseil: Le script récupère l'identifiant d'un conseil à supprimer à partir des données POST. Ensuite, il ouvre le fichier 'conseils.csv' et crée un nouveau fichier temporaire pour stocker les conseils à conserver. Il parcourt ensuite chaque ligne du fichier CSV d'origine, et s'il trouve une correspondance avec l'identifiant du conseil à supprimer, il ne copie pas cette ligne dans le fichier temporaire. Enfin, il renomme le fichier temporaire pour écraser le fichier CSV d'origine.

Redirection: Une fois que la suppression est effectuée, l'utilisateur est redirigé vers la page 'conseils.php'.

Ce fichier CSS contient les styles utilisés pour mettre en forme les différentes pages de l'application. Voici un résumé de ses fonctionnalités :

Styles Généraux: Il définit les styles de base pour le corps, l'en-tête, la navigation, le contenu principal et le pied de page.
Styles Spécifiques: Il contient des styles spécifiques pour la page d'accueil, la page des conseils, ainsi que la barre de recherche.
Classes Réutilisables: Il définit des classes réutilisables pour les grands boutons, les grands champs de saisie, etc.
Positionnement: Il contient des styles pour positionner le logo de l'application de manière absolue dans l'en-tête.

Cette page HTML est destinée à permettre aux utilisateurs de soumettre de nouveaux conseils. Voici un aperçu de son contenu :

En-tête: L'en-tête contient le titre de la page et la navigation vers d'autres pages de l'application.
Formulaire de Soumission: Un formulaire est fourni avec des champs pour le titre, la catégorie, le contenu, une image et une vidéo pour le conseil.
Footer: Le pied de page affiche le message de droits d'auteur pour l'application.

Ce script PHP est responsable de la recherche de conseils en fonction de critères spécifiques. Voici un aperçu de son fonctionnement :

Fonction de Recherche: Il contient une fonction searchConseils qui parcourt le fichier CSV contenant les conseils et retourne les résultats correspondant aux critères de recherche fournis.
Récupération des Critères de Recherche: Les critères de recherche (mot-clé et catégorie) sont récupérés à partir des paramètres GET.
Affichage des Résultats: Les résultats de la recherche sont affichés sous forme de listes, avec des détails tels que le titre, la catégorie, le contenu, le nom de l'utilisateur, et éventuellement une image ou une vidéo du conseil.
Gestion des resultats vides: Si aucun résultat n'est trouvé pour les critères de recherche donnés, un message approprié est affiché.

