<?php
    require_once ("templates/header.php");

    $lastestMovies = $movieDao->getLastestMovies();

    $actionMovies = $movieDao->getMoviesByCategory("Ação");

    $comedyMovies = $movieDao->getMoviesByCategory("Comédia");

?>

<div id="main-container" class="container-fluid">
    <h2 class="section-title">Filmes Novos</h2>
    <p class="section-description">Veja os Últimos Filmes Adicionados!</p>
    <div class="movies-container">
        <?php foreach ($lastestMovies as $movie) :?>
            <?php require ("templates/movie_card.php") ?>
        <?php endforeach; ?>
        <?php if (empty($lastestMovies)): ?>
            <p class="empty-list">Ainda não existem filmes cadastrados nessa categoria!</p>
        <?php endif; ?>
    </div>
    <h2 class="section-title">Ação</h2>
    <p class="section-description">Os Melhores Filmes de Ação!</p>
    <div class="movies-container">
        <?php foreach ($actionMovies as $movie) :?>
            <?php require ("templates/movie_card.php") ?>
        <?php endforeach; ?>
        <?php if (empty($actionMovies)): ?>
            <p class="empty-list">Ainda não existem filmes cadastrados nessa categoria!</p>
        <?php endif; ?>
    </div>
    <h2 class="section-title">Comédia</h2>
    <p class="section-description">Os Melhores da Comédia!</p>
    <div class="movies-container">
        <?php foreach ($comedyMovies as $movie) :?>
            <?php require ("templates/movie_card.php") ?>
        <?php endforeach; ?>
        <?php if (empty($comedyMovies)): ?>
            <p class="empty-list">Ainda não existem filmes cadastrados nessa categoria!</p>
        <?php endif; ?>
    </div>
</div>

<?php
    require_once ("templates/footer.php");
?>