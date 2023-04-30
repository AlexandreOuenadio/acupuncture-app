# Projet TIDAL-Groupe 15

## Description du projet

L'objectif du projet était de concevoir et réaliser une plateforme en ligne pour une association d'acupuncteurs afin d'aborder et de comprendre l'ensemble des notions encadrant les techniques de l'Internet Dynamique et de l'architecture logicielle (intégration de maquettes à une base PHP par templating, architecture PHP objet, accès et utilisation d'une base de données et mise en place d'une API REST).

## Organisation du site

Nous étions libre de choisir comment organiser notre site mais avions tout de même un cahier des charges décrivant les différentes fonctionnalités que devaient posséder notre site :

  * Disposer d'un service en ligne permettant aux membres de l'association de consulter la liste des symptômes des principales pathologies en acupuncture
  * Pouvoir afficher uniquement certaines pathologies en fonction de différents critères (type de pathologie, choix des méridiens,etc)
  * Rechercher les pathologies comportant certains symptômes.
  
Les pages du site sont les suivantes :

  * Une page d'accueil (avec menu et formulaire)
  * Une page présentant les pathologies (avec des filtres et accessibles uniquement si l'utilisateur est connecté)
  * Une page d'information expliquant les étapes de construction du site 
  * Une page de connexion permettant que l'utilisateur puisse créer un compte et/ou se connecter
  
## Architecture MVC

Notre site possède une architecture MVC (Model, View, Controller). Nous avons développé:
* Une classe <strong>Router</strong> qui est capable de rediriger des requêtes GET et POST de l'utilisateur (récupération de page, des informations de la base de donnée ou authentication utilisateur), cette dernière appelle sous couche jacente des controlleurs matérialisés par des fonctions.
* Des <strong>controlleurs</strong> qui effectuent des actions appelées par le routeur telles que l'affichage d'une page, la connexion d'un utilisateur, ou bien la récupération de données via le Model présentes dans une base de données PostgreSQL.
* Une classe <strong>Database</strong> qui représente notre <strong>Model</strong> et qui a pour but de faire des requêtes SQL spécifiques pour la récupération de donnée sur les pathologies ou sur les comptes utilisateurs enregistrés

## Nos ajouts suite à la séance d'évaluation

* __Recherche pathologique fonctionnelle__

Pour utiliser cette page, il suffit d'appuyer une fois sur le bouton de recherche pour afficher les listes de filtres, ainsi que toutes les pathologies en résultat. Il est possible de rentrer des méridiens et des mots-clés, ainsi qu'un type pour effectuer le filtrage. Lorsqu'un type est rentré, il suffit d'appuyer une nouvelle fois sur le bouton de recherche pour afficher les caractéristiques associées à ce type (il faut veiller à re-sélectionner le type avec les caractéristiques). Ces dernières peuvent également être utilisées pour effectuer un filtrage. Ces changements ont donc amélioré la fonctionnalité et l'efficacité de la page pathologie.

* __Connexion/Inscription utilisateur avec base de donnée fonctionnelle__
* __Ajout de messages d'erreur sur le formulaire de  connexion et d'inscription utilisateur__
* __Ajout de la page Informations__

Il y a eu des changements significatifs apportés au modèle depuis la dernière séance. Tout d'abord, certaines fonctions ont été redéfinies pour améliorer leur efficacité et leur fonctionnement. Ensuite, des corrections de bogues ont été apportées, ce qui a permis un fonctionnement complet de la page pathologie. 
