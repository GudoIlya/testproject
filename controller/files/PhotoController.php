<?php

require_once 'model/files/PhotoModel.php';

Class PhotoController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function upload() {
        $photoModel = new PhotoModel();
        return $photoModel->uploadPhoto();
    }

}

?>