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
Ce script est chargé de traiter les données soumises via un formulaire de soumission de conseils. 
recherche.php : Gère la fonction de recherche sur la plateforme en permettant aux utilisateurs d'entrer un mot-clé pour trouver des conseils pertinents. Ce script charge les conseils à partir d'un fichier CSV, filtre les résultats pour trouver ceux correspondant au mot-clé entré par l'utilisateur, puis affiche les résultats dans une page HTML structurée.

resultat-recherche.html : Affiche les résultats de la recherche avec une mise en page claire et organisée, permettant aux utilisateurs de visualiser facilement les conseils correspondant à leur recherche.

soumission.html : Structure une page de soumission de conseils avec un formulaire permettant aux utilisateurs de proposer de nouveaux conseils à ajouter à la plateforme. Cette page offre une interface conviviale pour collecter les informations nécessaires sur les nouveaux conseils.

style.css : Fournit les règles de style CSS pour mettre en forme et styliser les éléments HTML des différentes pages de la plateforme, garantissant une présentation cohérente et attrayante pour les utilisateurs.

supprimer_conseil.php : Permet aux utilisateurs connectés de supprimer un conseil spécifique qu'ils ont soumis sur la plateforme, en traitant les données soumises via un formulaire de suppression et en supprimant les informations correspondantes du fichier CSV des conseils.

traitement-connexion.php : Gère le processus de connexion des utilisateurs à la plateforme en vérifiant les informations d'identification soumises via un formulaire de connexion, en créant et en maintenant une session utilisateur active, et en redirigeant vers la page appropriée après la connexion.

traitement-inscription.php : Gère le processus d'inscription des utilisateurs sur la plateforme en vérifiant les informations fournies via un formulaire d'inscription, en créant un nouveau compte utilisateur et en redirigeant vers la page de connexion une fois l'inscription réussie.

traitement_mise_a_jour.php : Traite les données soumises via un formulaire de mise à jour de profil, permettant aux utilisateurs connectés de modifier leurs informations personnelles telles que leur nom d'utilisateur, leur email et leur mot de passe.

traitement-soumission.php : Traite les données soumises via un formulaire de soumission de conseils, permettant aux utilisateurs de proposer de nouveaux conseils à ajouter à la plateforme en enregistrant les informations dans un fichier CSV dédié.

traiter_modification.php : Traite les données soumises via un formulaire de modification de conseils, permettant aux utilisateurs connectés de modifier les détails d'un conseil spécifique sur la plateforme en mettant à jour les informations correspondantes dans le fichier CSV des conseils.






