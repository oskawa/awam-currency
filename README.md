# AWAM'Currency
## _Test réalisé par Maxime Eloir le 23 / 10 /2022_


Bonjour à toute l'équipe de chez Awam, je suis ravi d'avoir pu participer à ce petit test / challenge pour montrer mes compétences et ce que je sais faire. Je me présente, si jamais c'est la première fois que vous voyez mon travail. Je m'appelle Maxime Eloir, je suis originaire du Nord de la France où j'ai fait mes premières armes en tant qu'indépendant il y a de ça 2 ans et demi. J'ai ensuite rejoint une première entreprise en janvier 2021 puis une seconde en décembre 2021.

Le test technique d'aujourd'hui était une grande première pour moi ; habitué aux tests d'intégration front avec un CMS, c'est la première fois qu'on me demandait de réaliser une petite application PHP.

Pour rappel donc : 

- Application d'additions de devises
- Contrainte de 2h
- PHP natif ou framework
- Envoi de mail à la fin de journée
 

Si vous n'avez pas envie de tout lire ce qu'il y en dessous, je vous joins une petite vidéo, résumé de mon test ! 

https://www.youtube.com/watch?v=vcFY0EJfRf8&ab_channel=MaximeEloir

 ## Le projet

Pour des raisons d'emploi du temps, je n'ai pu m'attaquer au projet que ce dimanche 23 octobre. J'avais lu en diagonale le test que l'on me demandait mais je ne voulais pas commencer à me mettre des idées en tête ou commencer à réfléchir avant même de pouvoir coder. J'ai tenté de jouer le jeu jusqu'au bout ! 

Afin de débuter convenablement et pour respecter cette limite, je me suis lancé un chrono de 2h et j'ai commencé à travailler.

### Etape 1 - Réflexion

Avec une lecture plus approfondie, et pour éviter de coder au fur et à mesure sans prendre le temps de réfléchir, j'ai pris 10 min afin de marquer et poser les éléments sur un tableau blanc (sur Figma). Pensant au début réaliser mon projet sans base de données, je me suis aperçu qu'une fonctionnalité de mail reprenant l'intégralité des calculs de la journée devait être pensé ainsi qu'une gestion des devises.

Deux BDD sont donc créés : 
 awam_currency -> Gestion des devises
- Name
- Name_reference
- Percentage

L'EURO étant la référence, le taux de change est calculé par rapport à cette monnaie. 

awam_operation_list -> Sauvegarde des calculs
- Date
- Currency_one
- Amount_one
- Currency_two
- Amount_two
- Total

Je partirais donc avec un total de 4 input (2 textes + 2 select) ainsi qu'un bouton pour valider le calcul. Vu que je souhaite faire cela de manière dynamique, je vais passer par de l'AJAX ( nous verrons après que plusieurs soucis -ridicules- vont se mettre sur ma route ) 


### Etape 2 - Conception

Je mets en place mon architecture et très rapidement, je pars sur une fonctionnalité de ce type : Lorsque je clique sur le bouton de calcul, je souhaite récupérer les valeurs des champs SELECT afin de comparer leur nom dans la BDD et récupérer le pourcentage affilié.

Un problème principal a été soulevé très rapidement : lors de mon appel AJAX, pour une raison qui m'échappait, la réponse à mon exécution était la page entière, comme si le chemin d'accès au fichier que j'avais spécifié n'était pas pris en compte. Je vous montre le code AVANT/APRES : 

AVANT 
```sh
 $.ajax({
        URL: 'core/Currencies.php',
        type: 'POST',
        data: {}
```

APRES 
```sh
 $.ajax({
        url: 'core/Currencies.php',
        type: 'POST',
        data: {}
```

Effectivement, pour une raison qui m'échappe, mon "url" est passé en majuscule lorsque je l'ai tapé, donc l'appel ne fonctionnait pas ! 20min à tenter de résoudre ce problème pour que ce soit une simple erreur de syntaxe.


### Etape 2.1 - Remise en question

Au bout du compte, après avoir réussi à aller chercher dans la BDD les informations que je souhaitais, je me suis rendu compte du manque de logique que je faisais preuve : pourquoi aller chercher dans la base de données des informations que je pourrais venir inscrire directement dans les options de mon select input ?

Il me restait alors 45 min, je reprends tout à plat et je réfléchis à la meilleure façon de faire les choses : 

> Chaque champ "options" que j'ai réalise une connexion à la table afin de remplir dynamiquement les champs, je peux donc tout à fait lui faire passer un data-attribute contenant le pourcentage, réalisé le calcul en JS et tout envoyer après en AJAX pour sauvegarder les informations ! 

C'est reparti : je prends donc l'information utile que j'intègre dans un data-attribute.

Dans mon script.js, je décide simplement de comparer les deux valeurs des selecteurs afin d'afficher la bonne devise :
- Si les deux sélecteurs sont les mêmes, on réalise une simple opération et on affiche la devise courante après le résultat
- Si les sélecteurs sont différents, c'est l'EURO qui prend le dessus et on affiche la devise EURO après le résultat


La simple subtilité était que je devais transformer le champ input en Number.

Le calcul fait, une requête AJAX part pour venir sauvegarder la valeur dans la BDD, le tout avec une requête préparée.
```sh
 if ($_POST['callFunction'] == "save_currency") {
        $db = Database::getInstance();
        $stmt = mysqli_prepare($db, 'INSERT INTO awam_operation_list(`Currency_one`,`Amount_one`,`Currency_two`,`Amount_two`,`Total`) VALUES ( ?, ? , ? , ?, ?)');
        mysqli_stmt_bind_param($stmt, 'sdsdd', $_POST['currency_one'], $_POST['amount_one'], $_POST['currency_two'], $_POST['amount_two'], $_POST['result']  );
        $result = mysqli_stmt_execute($stmt) or die(mysqli_error($db));
    }
```


Pour terminer, ma fonction d'envoi de mail est très basique : 
- Récupération des informations du jour dans la table
- Boucle et affichage dans le corps du texte
- Envoi du mail à la fin

Pour voir les informations du jours, je les print à cette url http://localhost/awam-currency/core/Mail.php


Et... Les deux heures sont terminées ! Deux heures intenses de réflexion et de changement de direction. J'avais beau m'être préparé et avoir fait un petit schéma, j'aurais du être plus attentif et réfléchir un peu plus avant de me lancer dans l'écriture du code.

Malgré ça, la fonctionnalité est fonctionnelle même si elle mériterait quelques petites améliorations, que je vais détailler dans la partie suivante.

## Et si j'avais 10h ?

10h, c'est beaucoup, mais j'ai certains axes d'améliorations à évoquer.

### Architecture

- POO : Effectivement, ma table de devises aurait pu mériter d'avoir sa propre classe et ses propres fonctions, notamment de GET ou de SET ( que j'expliquerais un peu après ) afin d'avoir un code beaucoup plus structuré
- Tests sur les inputs : Actuellement, j'ai mis un minimum de 0.1 sur les champs Number, et je vérifie s'ils ne sont pas vides. Je devrais augmenter la sécurité en créant des tests supplémentaires : est ce vraiment un nombre ? Est il supérieur à 0 ? Ce genre de petites subtilités mais qui rendent une application plus fiable

### Fonctionnalités
- CRUD : En complément de la POO citée juste avant, le fait d'avoir une page dédiée pour éditer, supprimer ou ajouter ses devises serait un plus pour l'application et la gestion.
- Création d'un système d'utilisateurs, dans la lignée de ce qui est fait par mail pour l'administrateur : chaque utilisateur / Client aurait un historique des actions qu'il a réalisé le jour même ou les jours précédents

### Visuel
- Ce n'est pas bien compliqué : tout est a créer bien entendu. C'est parce que je tiens à respecter la règle des deux heures, mais j'aurais bien fait une maquette très simple avec ces deux champs inputs et le bouton pour une version responsible
- Dans cette mouvance, améliorer l'expérience utilisateur : rendre le bouton disabled et avec une opacité plus légère pour indiquer à l'utilisateur qu'il ne peut pas cliquer s'il n'a pas tout rempli correctement.




## Mon ressenti --

J'en ai déjà parlé un petit peu juste avant, mais ce fut une expérience très intéressante ! Pour une fois, je n'ai pas une maquette de site internet à réaliser. Même si j'adore la réalisation front, ce défi technique me permet de mieux comprendre et de mieux structurer mon code sur une période donnée, voilà pourquoi j'ai tenu à me chronométrer mais également à me filmer. ça me permet de faire un débrief par la suite, et de revoir calmement les erreurs que j'ai pu commettre ! 

Cette vidéo et ce README me permet de vous montrer ma motivation, mon envie d'apprendre et ma remise en question permanente. Je ne reste pas sur des acquis et j'ai envie d'aller plus loin, de voir plus de code et de discuter avec des pairs.


## Installation

Je n'ai pas réalisé de fichiers créant la table automatiquement. Ainsi, vous la trouverez dans le git dans le dossier database.

Si besoin, les informations de connexion sont dans le database.php.

 