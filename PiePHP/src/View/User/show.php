<h1>Profil de l'utilisateur</h1>
<p>Id : <?= $_SESSION['id'] ?></p>
<p>Prénom : <?= $me['firstname'] ?></p>
<p>Nom : <?= $me['lastname'] ?></p>
<p>Date : <?= $me['birthdate'] ?></p>
<p>Adresse : <?= $me['address'] ?></p>
<p>Code postal : <?= $me['zipcode'] ?></p>
<p>Ville : <?= $me['city'] ?></p>
<p>Pays : <?= $me['country'] ?></p>
<p>Email : <?= $me['email'] ?></p>
<a href="/PiePHP/W-PHP-502-MAR-2-1-PiePHP-anthony.gibilaro/User/edit"><button>Modifier mon profil</button></a>
<a href="/PiePHP/W-PHP-502-MAR-2-1-PiePHP-anthony.gibilaro/User/Logout"><button>Déconnexion</button></a>
