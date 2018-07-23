<?php 

Class Controller{

	
	protected $view;

	public function __construct() {
	    if(isset($_POST) AND !empty($_POST)) {
	        if(!Csrf::check()){
	            return false;
            }
        }
		$this->view = new View();
	}

}

?>