<form method="POST" action="/PiePHP/W-PHP-502-MAR-2-1-PiePHP-anthony.gibilaro/User/editDb">
    <label for="firstname">Prenom :</label>
    <input type="text" name="firstname" value={{$me["firstname"]}} required>
    <br>
    <label for="lastname">Nom :</label>
    <input type="text" name="lastname" value={{$me["lastname"]}} required>
    <br>
    <label for="birthdate">Date :</label>
    <input type="date" name="birthdate" value={{$me["birthdate"]}} required>
    <br>
    <label for="address">Adresse :</label>
    <input type="text" name="address" value={{$me["address"]}} required>
    <br>
    <label for="zipcode">Code postal :</label>
    <input type="text" name="zipcode" value={{$me["zipcode"]}} required>
    <br>
    <label for="city">Ville :</label>
    <input type="text" name="city" value={{$me["city"]}} required>
    <br>
    <label for="country">Pays :</label>
    <input type="text" name="country" value={{$me["country"]}} required>
    <br>
    <label for="email">Email :</label>
    <input type="email" name="email" value={{$me["email"]}} required>
    <br>
    <label for="password">Mot de passe :</label>
    <input type="password" name="password" value={{$me["password"]}} required>
    <br>
    <button type="submit">Mettre à jour</button>
</form>
<a href="/PiePHP/W-PHP-502-MAR-2-1-PiePHP-anthony.gibilaro/User/deleteAccount"><button>Supprimer le compte</button></a>