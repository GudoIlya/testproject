<?php
require_once "view/layout/header.php";
?>
<div class="container">
    <form id="create_task_form" action="/task/task/create" method="POST">
        <div class="form-group">
            <label for="username">Имя пользователя</label>
            <input type="text" class="form-control" id="username" name="username" minlength="1" value="<?= isset($data['username']) ? $data['username'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input name="email" type="email" class="form-control" id="email" value="<?= isset($data['email']) ? $data['email'] : ''?>">
        </div>
        <div class="form-group">
            <label for="description">Описание задачи</label>
            <textarea class="form-control" name="description">
                <?= isset($data['description']) ? $data['description'] : '' ?>
            </textarea>
        </div>
        <div class="form-group">
            <label for="fileupload">Фото</label>
            <input id="fileupload" type="file" name="files[]" data-url="/files/photo/upload" multiple accept=".jpg,.jpeg,.gif,.png">
        </div>
        <input name="token" type="hidden" value="<?= $_SESSION['csrf_token'] ?>" />
        <button type="submit" class="btn btn-default">Создать задачу</button>
        <button id="preview_task" type="submit" class="btn btn-info">Предварительный просмотр</button>
    </form>
</div>
<?php
require_once "view/layout/footer.php";
?>
<script type="text/javascript" src="/static/js/jquery-validate.js"></script>
<script src="/static/js/jquery.ui.widget.js"></script>
<script src="/static/js/jquery.iframe-transport.js"></script>
<script src="/static/js/jquery.fileupload.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#create_task_form").validate({
            rules: {
                username: {
                    rules : {
                        required : true
                    }
                },
                email : {
                    rules : {
                        required : true,
                        email : true
                    }
                },
                description : {
                    rules : {
                        required : true
                    }
                }
            }
        });

        $('#fileupload').fileupload({
            dataType: 'json',
            disableImageResize: false,
            imageMaxWidth: 340,
            imageMaxHeight: 240,
            imageCrop : true,
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    $('<p/>').text(file.name).appendTo(document.body);
                });
            }
        });

    });
</script>

