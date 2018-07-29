<?php

require_once "support/Paginator.php"; ?>
    <div class="pagination_wrapper">
        <?php
        /* Пагинация */
        $totalItems = $data['tasks']['rows_number'];
        $itemsPerPage = $data['tasks']['items_per_page'];
        $currentPage = $data['current_page'];
        $urlPattern = '?page=(:num)';

        $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
        echo $paginator;
        ?>
    </div>
    <?php
    if(!isset($data['tasks']['taskList'])) { return 'Еще нет задач'; }
    if(isset($data['tasks'])) {
        foreach ($data['tasks']['taskList'] as $task) {
            $imageSrc = isset($task['photo']) ? FILES_DIRECTORY_URL . $task['photo'] : FILES_IMAGES_URL . 'no_photo.jpg';
            ?>
            <div class="col-sm-4 pagination__list ">
                <h4><?= $task['username']; ?></h4>
                <h5><?= $task['email']; ?></h5>
                <div class="container-fluid">
                    <p class="t_img_wrapper"><img src="<?= $imageSrc; ?>" alt=""></p>
                    <p class="t_description_wrapper"><?= $task['description']; ?></p>
                </div>
                <?php if (Auth::checkIsAdmin()) { ?>
                    <a href="task/task/edit?task=<?= $task['id']; ?>" class="editTask btn btn-info">Редактировать</a> <?php
                } ?>
            </div>
        <?php }
    }
    ?>

