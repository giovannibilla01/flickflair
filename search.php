<?php
    require_once ("templates/header.php");

    $q = filter_input(INPUT_GET, "q");

    $movies = $movieDAO->findByTitle($q) ?? [];
?>

<div id="main-container" class="container-fluid">
    <h2 class="section-title">Busca por: <span id="search-result"><?= $q ?></span></h2>
    <p class="section-description">Veja os Filmes Encontrados!</p>
    <div class="movies-container">
        <?php foreach ($movies as $movie) :?>
            <?php require ("templates/movie_card.php") ?>
        <?php endforeach; ?>
        <?php if (empty($movies)): ?>
            <p class="empty-list">Nenhum filme encontrado! <a href="<?= $BASE_URL ?>" class="back-link">Voltar</a>.</p>
        <?php endif; ?>
    </div>
</div>

<?php
    require_once ("templates/footer.php");
?>