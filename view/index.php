<?php
require_once "view/layout/header.php";
?>
<div class="container">
    <?php
    if(isset($data['tasks'])) {
    foreach ($data['tasks'] as $task) {
    $imageSrc = isset($task['photo']) ? FILES_DIRECTORY_URL . $task['photo'] : FILES_IMAGES_URL . 'no_photo.jpg';
    ?>
    <div class="col-sm-4">
        <h3><?= $task['username']; ?></h3>
        <h4><?= $task['email']; ?></h4>
            <div class="container-fluid">
                <p><img src="<?= $imageSrc; ?>" alt=""></p>
                <p><?= $task['description']; ?></p>
            </div>
            <?php if (Auth::checkIsAdmin()) { ?>
                <button class="editTask btn btn-info">E</button> <?php
            } ?>
    </div>
            <?php }
            } ?>
    <ul class="pagination">
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
    </ul>
</div>
<?php
require_once "view/layout/footer.php";
?>
