<h2><?= $movie['title'] ?></h2>
<h3>Distributor : <?= $distributor['name'] ?></h3>
<h3>Genres:</h3>
@foreach ($movie['genre'] as $genre)
<p>#{{$genre['name']}}</p>
@endforeach