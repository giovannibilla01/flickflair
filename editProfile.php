<?php
    require_once ("templates/header.php");

    $userData = $userDAO->verifyToken(true);
?>

<div id="main-container" class="container-fluid">
    <h1>Editar</h1>
</div>

<?php
    require_once ("templates/footer.php");
?>