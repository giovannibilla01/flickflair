<?php
    require_once ("templates/header.php");

    $id = filter_input(INPUT_GET, "id");

    if (empty($id)) {
        if (!empty($userData)) {
            $id = $userData->id;
        } else {
            $message->setMessage("Usuário não encontrado!", "error", "index.php");
        }
    } else {

        $userData = $userDAO->findById($id);

        if (!$userData) {
            $message->setMessage("Usuário não encontrado!", "error", "index.php");
        }
    }

    $fullname = $user->getFullName($userData);

    if (empty($userData->image)) {
        $userData->image = "user.png";
    }

    $userMovies = $movieDAO->getMoviesByUserId($id);
?>

<div id="main-container" class="container-fluid">
    <div class="col-md-8 offset-md-2">
        <div class="row profile-container">
            <div class="col-md-12 about-container">
                <h1 class="page-title"><?= $fullname ?></h1>
                <div id="profile-image-container" class="profile-image" style="background-image: url('<?= $BASE_URL ?>img/users/<?= $userData->image ?>');"></div>
                <h3 class="about-title">Sobre:</h3>
                <?php if (!empty($userData->bio)): ?>
                    <p class="profile-description"><?= $userData->bio ?></p>
                <?php else: ?>
                    <p class="profile-description">O usuário ainda nao tem uma Biografia!</p>
                <?php endif; ?>
            </div>
            <div class="col-md-12 added-movies-container">
                <h3>Filmes deste usuário</h3>
                <div class="movies-container">
                    <?php foreach ($userMovies as $movie): ?>
                        <?php require("templates/movie_card.php"); ?>
                    <?php endforeach; ?>
                    <?php if (count($userMovies) == 0): ?>
                        <p class="empty-list">O usuário não possui filmes!</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require_once ("templates/footer.php");
?>