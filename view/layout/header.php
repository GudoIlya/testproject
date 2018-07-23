<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <title>Тест<?= isset($data['title']) ? " - ".$data['title'] : ''; ?></title>
</head>
<body>
<div class="row">
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Задачи</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="/">Главная</a></li>
                    <li><a href="/task/task/create">Создать</a></li>
                    <?php if( Auth::checkAuth() ): ?>
                    <li><a href="/auth/auth/logout">Выйти</a></li>
                    <?php else: ?>
                    <li><a href="/auth/auth/login">Войти</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </div>
    <div class="container"><h1><?= $data['title']; ?></h1></div>

