<h1>Connexion</h1>
<form method="POST" action="/PiePHP/W-PHP-502-MAR-2-1-PiePHP-anthony.gibilaro/User/SigninUser">
    <label for="email">Email :</label>
    <input type="email" name="email" required>
    <br>
    <label for="password">Mot de passe :</label>
    <input type="password" name="password">
    <br>
    <button type="submit">Se connecter</button>
</form>

<?php

// use Model\UserModel;

// Création d'une instance de UserModel
// $userModel = new UserModel();

// Créer un nouvel utilisateur
// $newUser = $userModel->Register('test200@test.com', 'test');
// echo "Utilisateur créé avec succès : " . print_r($newUser, true) . PHP_EOL;

// // Lire les informations d'un utilisateur
// $user = $userModel->Reader(4);
// echo "Informations utilisateur : " . print_r($user, true) . PHP_EOL;

// // Mettre à jour un utilisateur existant
// $updatedUser = $userModel->UpdateUser(5, 'bassim@lol', 'lol');
// echo "Utilisateur mis à jour avec succès : " . print_r($updatedUser, true) . PHP_EOL;

// // Lire tous les utilisateurs
// $allUsers = $userModel->read_all();
// echo "Tous les utilisateurs : " . print_r($allUsers, true) . PHP_EOL;

// Supprimer un utilisateur
// $deletedUser = $userModel->delete($userModel->table, 6);
// echo "Utilisateur supprimé avec succès : " . print_r($deletedUser, true) . PHP_EOL;