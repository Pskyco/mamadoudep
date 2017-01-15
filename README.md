#Mamadou Dépannage

Site de vente en ligne de pièces automobiles.

Créateur : Ludwig Pskyco

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