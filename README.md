#Mamadou Dépannage

Site de vente en ligne de pièces automobiles.

Créateur : Ludwig Pskyco

Changelog du 18/01/2017 v1.3.4,
- Modification du dropdown de la boutique, passage en bootstrap
- Ajout d'une option "TOUTES CATEGORIES" pour de nouveau afficher l'ensemble des articles de la boutique
- 

Changelog du 17/01/2017 v1.3.3,
- Correction d'un bug dans les validateurs JQuery ;
- Gestion des informations "doublons" dans la modification de profil
-- Une erreur en clair était affichée lorsque l'on tentait de duppliquer une entrée 'tel' ou 'mail' (modif profil)
-- Elle est désormais gérée correctement avec un message d'erreur Bootstrap
- Fix d'une faille qui affichait en clair le msg d'erreur lorsque l'ont duppliquait une entrée 'tel' ou 'mail' (inscription)
- L'affichage des factures est désormais croissant selon l'état ET l'id_facture
- Les produits de la boutique sont désormais affichés par ordre croissant d'id_produit

Changelog du 15/01/2017 v1.3.2,
- Corrections d'UTF8 dans la gestion des articles
- Préparation du JQuerry AJAX d'auto-complétion par adresse mail (panel admin)
- Modification des utilisateurs (panel admin)
- Fix d'un bug sur l'envoi d'un boolean avec bindParam (clientBD.class)
-- $sql->bindValue(':admin', boolval($admin),PDO::PARAM_BOOL);
-- au lieu de
-- $sql->bindValue(':admin', $admin);
-- car un bindParam prends de base un paramètre String, et transforme donc "true" en "1" et "false" en ""
- Mise à jour des messages de validation JQuery
- Validation JQuery sur les formulaires d'inscription, de modification de profil (user/admin)

Changelog du 15/01/2017 v1.3.1,
- Documentation des classes DB

Changelog du 15/01/2017 v1.3.0,

- Fix d'un bug sur la modification de profil
- Fix des messages de confirmation de commandes
- Ajout d'une colonne "prix" dans la table comporte
- Modification des détails factures dans le panel admin
- Ajout de la génération de PDF facture dans le panel admin
- Correction de la fonction de comparaison des prix sur facture/en stock