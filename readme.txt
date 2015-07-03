Importer la base de données symfony.sql (à la racine).
L'acces est root et pas de mot de passe.

Utilisateur :
l'admin : login : admin passwd : admin
Tanguy : login : Tanguy passwd : tanguy
Marlene : login : Marlene passwd : marlene

Le 1er Compte créé est le compte Admin
http://localhost/PhpEsi/web/app_dev.php/admin :
Administration des utilisateurs (pas accessible si l'on est pas l'utilisateur 1 (Admin), renvoie sur l'index)

http://localhost/PhpEsi/web/app_dev.php/modify :
Pas accessible s'il l'on est pas connecté, sinon cela retourne sur l'index

http://localhost/PhpEsi/web/app_dev.php/video/{id} :
dans les commentaires, le bouton Edit n'apparait que si l'on est log avec l'utilisateur 1 (Admin)
