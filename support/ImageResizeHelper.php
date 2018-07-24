<?php
require_once "support/ImageResize.php";
require_once "support/ImageResizeException.php";

class ImageResizeHelper{

    public static function resizeImageIfExceed($filepath,$max_h, $max_w) {
        list($image_w, $image_h) = getimagesize($filepath);
        $image = new ImageResize($filepath);
        $resized = false;
        if($image_h > $max_h) {
            $image->resizeToHeight($max_h);
            $resized = true;
        } else if($image_w > $max_w) {
            $image->resizeToWidth($max_w);
            $resized = true;
        }
        if($resized) {
            $image->resizeToWidth(300);
            $image->save($filepath);
        }
        return true;
    }

}

?>