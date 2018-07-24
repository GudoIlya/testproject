<?php
require_once "support/UploadHandler.php";
require_once "support/ImageResizeHelper.php";

class PhotoModel{
    private $max_width = 340;
    private $max_height = 240;

    public function __construct(){
    }

    public function uploadPhoto() {
        if(!empty($_FILES)) {
            ImageResizeHelper::resizeImageIfExceed($_FILES["files"]["tmp_name"][0],$this->max_width, $this->max_height);
            $uploadHandler = new UploadHandler(array(
                'upload_dir' => FILES_DIRECTORY,
                'upload_url' => FILES_DIRECTORY,
                'max_width' => $this->max_width,
                'max_height' => $this->max_height,
                'discard_aborted_uploads' => false
            ));
        }
    }
}

?>