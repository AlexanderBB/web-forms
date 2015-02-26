<?php
session_start();

$_SESSION[include_engine]   = 'on';
function __autoload($class_name) {
    include_once __DIR__ . '/' . $class_name . '.class.php';
}

/**
 * Navigation
 */

class init {
        
	/**
         * Selecting the action to take.
         * 
         * @param string $act - action to be initialised. Where 'register' is for processing the data.
         * @example new init() - displays the empty register form;
         * @example new init('register') - this is called by AJAX method (js/_custom.js) for processing the data from the form;
         */
	public function __construct($act){
		$this->router($act);
	}
	public function router($act){
		switch ($act){
			case 'register':
                                $obj= new register();
                                $obj->init();
		break;
			default: 
				$display = new display();
				$display->init();
		break;
		}
	}
	
	
}
?>