<?php
    require_once ("templates/header.php");

    $userData = $userDAO->verifyToken(true);

    $fullName = $user->getFullName($userData);

    if (empty($userData->image)) {
        $userData->image = "user.png";
    }
?>

<div id="main-container" class="container-fluid">
    <div class="col-md-12">
        <form action="<?= $BASE_URL ?>user_process.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <div class="row">
                <div class="col-md-4">
                    <h1><?= $fullName ?></h1>
                    <p class="page-description">
                        Altere seus dados no formulario abaixo:
                    </p>
                    <div class="form-group">
                        <label for="name">Nome:</label>
                        <input type="text" class="form-control"  name="name" id="name" placeholder="Digite o seu Nome:" value="<?= $userData->name ?>">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Sobrenome:</label>
                        <input type="text" class="form-control"  name="lastname" id="lastname" placeholder="Digite o seu Sobrenome:" value="<?= $userData->lastname ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control disabled"  name="email" id="email" placeholder="Digite o seu Sobrenome:" value="<?= $userData->email ?>" readonly>
                    </div>
                    <input type="submit" class="btn card-btn" value="Alterar">
                </div>
                <div class="col-md-4">
                    <div id="profile-image-container" style="background-image: url('<?= $BASE_URL ?>img/users/<?= $userData->image ?>');">
                    </div>
                    <div class="form-group">
                        <label for="image">Foto:</label>
                        <input type="file" class="form-control" name="image" id="image">
                    </div>
                    <div class="form-group">
                        <label for="bio">Sobre Voce:</label>
                        <textarea class="form-control" name="bio" id="bio" rows="5" placeholder="Conte Sobre voce..."><?= $userData->bio ?></textarea>
                    </div>
                </div>
            </div>
        </form>

        <div class="row" id="change-password-container">
            <div class="col-md-4">
                <h2>Alterar Senha:</h2>
                <p class="page-description">Digite a nova senha e confirme, para alterar:</p>
                <form action="<?= $BASE_URL ?>user_process.php" method="post">
                    <input type="hidden" name="type" value="changepassword">
                    <div class="form-group">
                        <label for="password">Nova Senha:</label>
                        <input type="password" class="form-control"  name="password" id="password" placeholder="Digite a sua nova senha:">
                    </div>
                    <div class="form-group">
                        <label for="confirmpassword">Confirmação:</label>
                        <input type="password" class="form-control"  name="confirmpassword" id="confirmpassword" placeholder="Confirme a sua nova senha:">
                    </div>
                    <input type="submit" class="btn card-btn" value="Alterar Senha">
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    require_once ("templates/footer.php");
?>