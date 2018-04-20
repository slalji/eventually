<?php
    //set off all error for security purposes
	//error_reporting(E_ALL);
	

	//define some contstant


define( "DB_HOST", "localhost" );
define( "DB_DSN", "mysql:host=localhost;dbname=selcom_bridge" );
define( "DB_USER", "salma" );
define( "DB_PASS", "@selcom09" );
define( "CLS_PATH", "class" );
define( "U_TABLE", "users" );
define( "DB_NAME", "selcom_bridge" );

/*define( "DB_HOST", "localhost" );
define( "DB_USER", "root" );
define( "DB_PASS", "roots" );
define( "DB_NAME", "selcom_bridge" );

DB_HOST = 'localhost';
DB_USER = 'root';
DB_PASS = 'roots';
DB_NAME = 'selcom_bridge';
*/
//$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.'';
$dsn = DB_DSN;
//define("DB_DSN", $dsn);
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
?>
