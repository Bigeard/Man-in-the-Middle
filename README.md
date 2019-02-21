# Man-in-the-Middle

## Installation Scapy

```
git clone https://github.com/secdev/scapy
cd scapy
./run_scapy
```

Ou

```
curl https://bootstrap.pypa.io/get-pip.py -o get-pip.py
python get-pip.py
pip install scapy
```
## Réseau

![alt text](./IMG-README/diag1.svg "Man In The Middle / Theory")

![alt text](./IMG-README/diag2.svg "Man In The Middle / Action Hacker")

![alt text](./IMG-README/diag3.svg "Man In The Middle / Application")

![alt text](./IMG-README/conf1.svg "Configuration 1")

## Installation d'un serveur Apache 2 / PHP / PhpMyAdmin

```
apt-get update
apt-get upgrade
```

```
apt-get install apache2
systemctl reload apache2
```
Tester le server: http://10.44.0.3/ ou http://localhost

```
apt-get install php5
apt-get install mysql-server
apt-get install php5-mysql
```

```
apt-get install phpmyadmin

cd /var/www/html/example.org/public_html
sudo ln -s /usr/share/phpmyadmin

systemctl reload apache2
```
Tester le server: http://10.44.0.3/phpmyadmin ou http://localhost/phpmyadmin


`cd /var/www/html/`  - Ceci est le lien pour deposer le fichier visible sur le réseau.

```
chmod 644 -R /var/www/html/
rm /var/www/html/index.html
```

On utilise Filezilla pour le trensfere les fichiers d'un ordinateur à un serveur.
https://filezilla-project.org/

On utilisera du SFTP du coup il faeur.
udra activer le SSH sur le serveur.

## Présentation des serveur Original / Fake

le server original est basique il y a une page de connexion et une page qui indique que la connexion est réussi.

Et pour le serveur fake on a une page de connexion qui resemble de très près a la page de connexion de du serveur original sauf que a la place de s'appeler matodon on la appeler mastoodon avec deux "o". On remarque la difference grace au logo et au nom de domaine. 

Un fois que l'utilisateur se connecte sur le serveur fake, l'email et le mot de passe sont enregistrer dans une base de donner. En suite, l'utilisateur est rediriger sur le vrais site avec un message d'erreur.

Dans la meilleur optique le serveur fake devrais verifier en même temps si l'email et le mot de passe sont correcte sur le serveur original pour valider la connexion et envoyer un cookie à l'utilisateur cible pour eviter tous soupson.

## Configuration des DNS



## Configuration des Firewall



## Comment éviter le man in the middle ?

ARP Spoofing
HTTP packet manipulation

- Il faut eviter de se connecter sur un réseau public si posible.

- Il ne faut pas se connecter sur un site qui ne possede pas de certifica SSL. Car grace un WireShark un haker peu les indetifcation de connexion en claire.

- Il faut faire très attention au nom de domain ou vous vous connectez car il y a des posibilité que le site soit un site web fake.

- Si posible il faut utiliser un gestionnaire de mot de passe comme Keepassxc. 

Un gestionnaire de mot de passe permet de garder en memore des mots de passe dans une base de donnée crypté. Il a pour but d'eviter les utilisateurs de mettre de mot de passe trop coerrent qui pourrais etre réferencer dans un dictionaire de mot de passe.

Mais le gestionnaire de mot de passe à une autre utiliter. Si on installe le module pour sont navigateur le gestionnaire mot de passe à la posibliliter de verifier si le nom de domaine et le certifica SSL sont correcte et si ce n'est pas le cas de prevenir l'utilisateur.


Keepassxc est un gestionnaire de mot de passe gratuit et open source.