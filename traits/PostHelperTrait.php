<?php

trait PostHelperTrait {
    function sanatizePost() {
        if(isset($_POST) AND !empty($_POST)) {
            foreach ($_POST as &$item) {
                trim(htmlspecialchars($item));
            }
        }
    }
}

?>