<?php
/**
 * 
 *    Using MySqli php class for acquiring an obj instance.
 *    DB's:
 *    ---------------------------------------------------------------------
 *    1. db_test
 *    ---------------------------------------------------------------------
 *
 *    Settings
 *    ----------------------
 *    user: db_test
 *    pass: testpass
 *    
 *    This is example DB mapping for the used fields in the Database table.
 *    DB map:
 * 	 1	id              int(5)		
 *	 2	name            varchar(35)	utf8_general_ci
 *	 3	sirname         varchar(35)	utf8_general_ci
 *	 4	tel             varchar(15)	utf8_general_ci
 *	 5	email           varchar(64)	utf8_general_ci
 *	 6	university	varchar(150)	utf8_general_ci
 *	 7	specialty	varchar(150)	utf8_general_ci
 *	 8	current_year	varchar(10)	utf8_general_ci
 *	 9	question_field	varchar(1000)	utf8_general_ci
 *	 10	created         timestamp	CURRENT_TIMESTAMP
 *	 11	ip              varchar(15)	utf8_general_ci
 */
session_start();

if ($_SESSION[include_engine] != 'on'){header('Location: http://www.vuzf.bg/');}

/**
 * 
 * Return DB object after openning connection to the DataBase
 * 
 */
class db extends mysqli{
    
        /**
         * Enter the hostname for your database server.
         * @var string $_dbHost 
         */
	private $_dbHost = 'localhost';
        
        /**
         * Enter the username for your Database
         * 
         * @var srting $_dbUser
         */
	private $_dbUser = 'db_test';
        
        /**
         * Enter the password for your Database
         * 
         * @var srting $_dbPass
         */
	private $_dbPass = 'testpass';
        
	private static $_dbInstance;
	
        /**
         * Get database connection.
         * 
         * @return OBJ mysqli()
         * 
         * @example $db = new DataBaseConnect(); - call instance with default db_name
         * @example $db = new DataBaseConnect('new_db'); - call instance with selected new_db as database 
         *
         */
	public function __construct($dbName = 'db_test') {
		self::$_dbInstance = 
			parent::__construct($this->_dbHost, $this->_dbUser, $this->_dbPass, $dbName);
		return self::$_dbInstance;
	}
}