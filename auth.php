<?php
    require_once ("templates/header.php");
?>

<div id="main-container" class="container-fluid">
    <div class="col-md-12">
        <div class="row" id="auth-row">
            <div class="col-md-4" id="login-container">
                <h2>Entrar</h2>
                <form action="<?= $BASE_URL ?>auth_process.php" method="post">
                    <input type="hidden" name="type" value="login">
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Digite seu e-mail">
                    </div>
                    <div class="form-group">
                        <label for="password">Senha:</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Digite sua senha">
                    </div>
                    <input type="submit" class="btn card-btn" value="Entrar">
                </form>
            </div>
            <div class="col-md-4" id="register-container">
                <h2>Criar Conta</h2>
                <form action="<?= $BASE_URL ?>auth_process.php" method="post">
                    <input type="hidden" name="type" value="register">
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Digite seu e-mail">
                    </div>
                    <div class="form-group">
                        <label for="name">Nome:</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Digite seu Nome">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Sobrenome:</label>
                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Digite seu Sobrenome">
                    </div>
                    <div class="form-group">
                        <label for="password">Senha:</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Digite sua senha">
                    </div>
                    <div class="form-group">
                        <label for="confirmpassword">Confirmação de Senha:</label>
                        <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Confirme sua Senha">
                    </div>
                    <input type="submit" class="btn card-btn" value="Registrar">
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    require_once ("templates/footer.php");
?>