<?php 

Class View{

    public function __construct() {

    }

	public function getView($template, $data) {
        include "view/".$template.".php";
	}

}

?>