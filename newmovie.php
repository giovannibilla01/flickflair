<?php
    require_once ("templates/header.php");

    $userData = $userDAO->verifyToken(true);
?>

<div id="main-container" class="container-fluid">
    <div class="offset-md-4 col-md-4 new-movie-container">
        <h1 class="page-title">Adicionar Filme</h1>
        <p class="page-description">Adicione sua critica e compartilhe:</p>
        <form action="<?= $BASE_URL ?>movie_process.php" id="add-movie-form" method="post" enctype="multipart/form-data">
            <input type="hidden" name="type" value="create">
            <div class="form-group">
                <label for="title">Título:</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Digite o título do seu Filme">
            </div>
            <div class="form-group">
                <label for="image">Imagem:</label>
                <input type="file" class="form-control" name="image" id="image">
            </div>
            <div class="form-group">
                <label for="length">Duração:</label>
                <input type="text" class="form-control" name="length" id="length" placeholder="Digite a duração do seu Filme">
            </div>
            <div class="form-group">
                <label for="category">Categoria:</label>
                <select name="category" id="category" class="form-control">
                    <option value="">Selecione</option>
                    <option value="Ação">Ação</option>
                    <option value="Drama">Drama</option>
                    <option value="Comédia">Comédia</option>
                </select>
            </div>
            <div class="form-group">
                <label for="trailer">Trailer:</label>
                <input type="text" class="form-control" name="trailer" id="trailer" placeholder="Insira o Link do Trailer">
            </div>
            <div class="form-group">
                <label for="description">Descrição:</label>
                <textarea name="description" class="form-control" id="description" rows="5"></textarea>
            </div>
            <input type="submit" class="btn card-btn" value="Adcionar">
        </form>
    </div>
</div>

<?php
    require_once ("templates/footer.php");
?>