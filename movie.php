<?php
    require_once ("templates/header.php");

    $id = filter_input(INPUT_GET, "id");

    $movie;

    if (empty($id)) {
        $message->setMessage("O filme não foi encontrado!", "error", "index.php");
    } else {

        $movie = $movieDAO->findById($id);

        if (!$movie) {
            $message->setMessage("O filme não foi encontrado!", "error", "index.php");
        }
    }

    if (empty($movie->image)) {
        $movie->image = "movie_cover.jpg";
    }

    $userOwnsMovie = false;

    if (!empty($userData)) {
        if ($userData->id === $movie->users_id) {
            $userOwnsMovie = true;
        }
    }

    $alreadyReviewed = false;

    $movieReviews = $reviewDAO->getMoviesReview($id);

?>

<div id="main-container" class="container-fluid">
    <div class="row">
        <div class="offset-md-1 col-md-6 movie-container">
            <h1 class="page-title"><?= $movie->title ?></h1>
            <p class="movie-details">
                <span>Duração: <?= $movie->length ?></span>
                <span class="pipe"></span>
                <span>Duração: <?= $movie->category ?></span>
                <span class="pipe"></span>
                <span><i class="fas fa-star"></i> 9</span>
            </p>
            <iframe src="<?= $movie->trailer ?>" width="560" height="315" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <p><?= $movie->description ?></p>
        </div>
        <div class="col-md-4">
            <div class="movie-image-container" style="background-image: url('<?= $BASE_URL ?>/img/movies/<?= $movie->image ?>');"></div>
        </div>
    </div>
    <div class="row">
        <div class="offset-md-1 col-md-10" id="reviews-container">
            <h3 id="reviews-title">Avaliações:</h3>
            <?php if (!empty($userData) && !$userOwnsMovie && !$alreadyReviewed) :?>
            <div class="row">
                <div class="col-md-12" id="review-form-container">
                    <h4>Envie sua avaliação:</h4>
                    <p class="page-description">
                        Preencha o formulário com a note e comentario sobre o filme:
                    </p>
                    <form action="<?= $BASE_URL ?>review_process.php" id="review-form" method="post">
                        <input type="hidden" name="type" value="create">
                        <input type="hidden" name="movies_id" value="<?= $movie->id ?>">
                        <div class="form-group">
                            <label for="rating">Nota do Filme:</label>
                            <select name="rating" id="rating" class="form-control">
                                <option value="">Selecione</option>
                                <option value="10">10</option>
                                <option value="9">9</option>
                                <option value="8">8</option>
                                <option value="7">7</option>
                                <option value="6">6</option>
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="review">Seu Comentario:</label><br>
                            <textarea name="review" id="review" rows="3" placeholder="O que você achou do filme?"></textarea>
                        </div>
                        <input type="submit" value="Enviar comentário" class="btn card-btn">
                    </form>
                </div>
            </div>
            <?php endif; ?>
            <?php foreach ($movieReviews as $review): ?>
                <?php require("templates/user_review.php") ?>
            <?php endforeach; ?>
            <?php if (count($movieReviews) == 0): ?>
                <p class="empty-list">Não há comentarios!</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
    require_once ("templates/footer.php");
?>