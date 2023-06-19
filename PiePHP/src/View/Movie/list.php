<h1>MY CINEMA BY PIEPHP</h1>
<h3><a href="/PiePHP/W-PHP-502-MAR-2-1-PiePHP-anthony.gibilaro/User/show">Mon profil</a></h3>
<h3><a href="/PiePHP/W-PHP-502-MAR-2-1-PiePHP-anthony.gibilaro/Movie/add"><button>Ajouter un film</button></a></h3>
<table>
    <tbody>
        @foreach ($movies as $movie)
        <tr>
            <td>
                <a href="./show/{{$movie['id']}}">
                    {{ $movie['title'] }}
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>