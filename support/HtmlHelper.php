<?php

class HtmlHelper{

    public function __construct()
    {
    }

    public static function checkActiveNavigationElement($pageData, $page) {
        $activeClass = "class='active'";
        if(isset($pageData['page']) AND $pageData['page'] == $page) {
            return $activeClass;
        }
        return '';
    }
}

?>