<?php require_once 'support/HtmlHelper.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/css/style.css">
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
                <ul id="header-menu" class="nav navbar-nav">
                    <li <?= HtmlHelper::checkActiveNavigationElement($data, 'index'); ?>><a href="/">Главная</a></li>
                    <li <?= HtmlHelper::checkActiveNavigationElement($data, 'create_task'); ?>><a href="/task/task/create">Создать задачу</a></li>
                    <?php if( Auth::loggedIn() ): ?>
                    <li><a href="/auth/auth/logout">Выйти</a></li>
                    <?php else: ?>
                    <li <?= HtmlHelper::checkActiveNavigationElement($data, 'login'); ?>><a href="/auth/auth/login">Войти</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </div>
    <div class="container"><h1><?= $data['title']; ?></h1></div>

