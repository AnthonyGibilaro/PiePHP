<h1>Ajouter un film</h1>
<form method="POST" action="/PiePHP/W-PHP-502-MAR-2-1-PiePHP-anthony.gibilaro/movie/addDb">
    <label for="title">Titre du film :</label>
    <input type="text" name="title" required>
    <br>
    <label for="director">Distributeur :</label>
    <input type="text" name="director" required>
    <br>
    <label for="duration">Durée :</label>
    <input type="text" name="duration" required>
    <br>
    <label for="release_date">Date de sortie :</label>
    <input type="text" name="release_date" required>
    <br>
    <label for="rating">Notation :</label>
    <input type="text" name="rating" required>
    <br>
    <button type="submit">Soumettre</button>
</form>