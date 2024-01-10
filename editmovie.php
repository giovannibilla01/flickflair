<?php
    require_once ("templates/header.php");

    $userData = $userDAO->verifyToken(true);

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
?>

<div id="main-container" class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 offset-md-1">
                    <h1><?= $movie->title ?></h1>
                    <p class="page-description">Altere os dados do filme:</p>
                    <form id="edit-movie-form" action="<?= $BASE_URL ?>movie_process.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="type" value="update">
                        <input type="hidden" name="id" value="<?= $movie->id ?>">
                        <div class="form-group">
                            <label for="title">Título:</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Digite o título do seu Filme" value="<?= $movie->title ?>">
                        </div>
                        <div class="form-group">
                            <label for="image">Imagem:</label>
                            <input type="file" class="form-control" name="image" id="image">
                        </div>
                        <div class="form-group">
                            <label for="length">Duração:</label>
                            <input type="text" class="form-control" name="length" id="length" placeholder="Digite a duração do seu Filme" value="<?= $movie->length ?>">
                        </div>
                        <div class="form-group">
                            <label for="category">Categoria:</label>
                            <select name="category" id="category" class="form-control">
                                <option value="">Selecione</option>
                                <option value="Ação" <?= $movie->category == "Ação" ? "selected" : "" ?>>Ação</option>
                                <option value="Drama" <?= $movie->category == "Drama" ? "selected" : "" ?>>Drama</option>
                                <option value="Comédia" <?= $movie->category == "Comédia" ? "selected" : "" ?>>Comédia</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="trailer">Trailer:</label>
                            <input type="text" class="form-control" name="trailer" id="trailer" placeholder="Insira o Link do Trailer" value="<?= $movie->trailer ?>">
                        </div>
                        <div class="form-group">
                            <label for="description">Descrição:</label>
                            <textarea name="description" class="form-control" id="description" rows="5"><?= $movie->description ?></textarea>
                        </div>
                        <input type="submit" class="btn card-btn" value="Atualizar">
                    </form>
                </div>
                <div class="col-md-3">
                    <div class="movie-image-container" style="background-image: url('<?= $BASE_URL ?>img/movies/<?= $movie->image ?>');"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require_once ("templates/footer.php");
?>