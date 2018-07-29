<?php
require_once "view/layout/header.php";

$new = true;
if(isset($data['task'])) {
    $new = false;
    $task = $data['task'];
    $task_id = $task['id'];
    $username = $task['username'];
    $email = $task['email'];
    $description = $task['description'];
    $isdone = $task['is_done'];
    $photos = $task['photos'];
    $action = '/task/task/edit';
    $actionText = "Сохрарнить";
} else {
    $action = '/task/task/create';
    $actionText = "Создать задачу";
}
?>
<div class="container">
    <p class="text-success"><?= $data['message']; ?></p>
    <p class="text-danger"><?= $data['error']; ?></p>
    <form id="create_task_form" action="<?= $action; ?>" method="POST">
        <?php if(Auth::checkIsAdmin() AND $new == false) { ?>
        <div class="form-group">
            <input type="checkbox" id="isdone" name="is_done" value="on" <?= (isset($isdone) AND $isdone=='1') ? 'checked' : '' ?>>
            <label for="username">Задача выполнена</label>
        </div>
        <?php } ?>
        <div class="form-group">
            <label for="username">Имя пользователя</label>
            <input type="text" class="form-control toPreview" data-inputclass="username" id="username" name="username" minlength="1" value="<?= isset($username) ? $username : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input name="email" type="email" class="form-control toPreview" data-inputclass="email" id="email" value="<?= isset($email) ? $email : ''?>" required>
        </div>
        <div class="form-group">
            <label for="description">Описание задачи</label>
            <textarea class="form-control toPreview" name="description" data-inputclass="description" required><?= isset($description) ? $description : '' ?></textarea>
        </div>
        <div class="form-group">
            <label for="fileupload">Фото</label>
            <input id="fileupload" type="file" name="files[]" data-url="/files/photo/upload" multiple accept=".jpg,.jpeg,.gif,.png">
        </div>
        <div class="form-group">
            <div class="attachedPhotos">
                <?php if(isset($photos) && count($photos) > 0) {
                    foreach ($photos as $photo) { ?>
                        <div class='row'><div class='container'><img src='<?= FILES_DIRECTORY_URL.$photo['file_name']; ?>'></div></div>
                        <input type='hidden' name='files[]' value='<?= $photo['file_name']; ?>' />
                    <?php }
                } ?>
            </div>
        </div>
        <input type="hidden" name="id" value="<?= $task_id; ?>">
        <input name="token" type="hidden" value="<?= $_SESSION['csrf_token'] ?>" />
        <button type="submit" class="btn btn-default"><?= $actionText; ?></button>
        <button id="preview_task" type="submit" class="btn btn-info">Предварительный просмотр</button>
    </form>

    <div id="taskPreviewDiv" class="hiddenDiv container">
        <div class="row">
            <div class="col-sm-3">Имя пользователя</div>
            <div class="col-sm-9"><p class="username"><?= isset($username) ? $username : '' ?></p></div>
        </div>
        <div class="row">
            <div class="col-sm-3">Email</div>
            <div class="col-sm-9"><p class="email"><?= isset($email) ? $email : '' ?></p></div>
        </div>
        <div class="row">
            <div class="col-sm-3">Описание</div>
            <div class="col-sm-9"><p class="description"><?= isset($description) ? $description : '' ?></p></div>
        </div>
        <div class="row">
            <div class="col-sm-12">Фото</div>
            <div class="col-sm-12 images">
                <?php if(isset($photos) && count($photos) > 0) {
                    foreach ($photos as $photo) { ?>
                        <div class='row'><div class='container'><img src='<?= FILES_DIRECTORY_URL.$photo['file_name']; ?>'></div></div>
                    <?php }
                } ?>
            </div>
        </div>
    </div>
</div>
<?php
require_once "view/layout/footer.php";
?>
<script src="/static/js/jquery.ui.widget.js"></script>
<script src="/static/js/jquery.iframe-transport.js"></script>
<script src="/static/js/jquery.fileupload.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var uploadedImagesDir = '<?= FILES_DIRECTORY_URL; ?>';
        var taskForm = $('#create_task_form');
        var previewDiv = $("#taskPreviewDiv");
        var previewUserField = $(previewDiv).find('.username');
        var previewEmailField = $(previewDiv).find('.email');
        var previewDescriptionField = $(previewDiv).find('.description');
        var previewPhotoField = $(previewDiv).find('.images');
        $(taskForm).on('click', '#preview_task', function(e){
            var window = new SupportModalWindow();
            window.showModalWindow('Предпросмотр', $(previewDiv).html());
            e.preventDefault();
        });
        $('#fileupload').fileupload({
            dataType: 'json',
            disableImageResize: false,
            imageMaxWidth: 340,
            imageMaxHeight: 240,
            imageCrop : true,
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    var div = "<div class='row'><div class='container'><img src='"+uploadedImagesDir+file.name+"'></div></div>";
                    var hiddenInput = "<input type='hidden' name='files[]' value='"+file.name+"' />";
                    $(hiddenInput).appendTo(taskForm);
                    $(div).appendTo($(taskForm).find('.attachedPhotos'));
                    $(div).appendTo(previewPhotoField);
                });
            }
        });

        $(document).on('change', '.toPreview', function(e){
            var previewParagraphClass = $(this).attr('data-inputclass');
            var inputValue = $(this).val();
            $(previewDiv).find("."+previewParagraphClass).html(inputValue);
        });

    });
</script>

