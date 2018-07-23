<?php
require_once "support/UploadHandler.php";
class PhotoModel{

    public function __construct(){
    }

    public function uploadPhoto() {
        $uploadHandler = new UploadHandler(array(
            'upload_dir' => FILES_DIRECTORY,
            'max_width' => '340',
            'max_height' => '240'

        ));
    }
}

?>