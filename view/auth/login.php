<?php
require_once "view/layout/header.php";
?>
<div class="container">
<form action="/auth/auth/login" method="POST">
    <div class="form-group">
        <label for="login">Логин</label>
        <input type="text" class="form-control" id="login" name="login" value="<?= isset($_SESSION['auth.old_login']) ? $_SESSION['auth.old_login'] : '' ?>">
    </div>
    <div class="form-group">
        <label for="password">Пароль</label>
        <input name="password" type="password" class="form-control" id="password">
    </div>
    <input name="token" type="hidden" value="<?= $_SESSION['csrf_token'] ?>" />
    <button type="submit" class="btn btn-default">Войти</button>
</form>
</div>
<?php
require_once "view/layout/footer.php";
?>

