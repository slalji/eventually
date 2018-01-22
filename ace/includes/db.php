<?php
define( "DB_HOST", "localhost" );
define( "DB_USER", "root" );
define( "DB_PASS", "roots" );
define( "DB_NAME", "selcom_bridge" );

/*DB_HOST = 'localhost';
DB_USER = 'root';
DB_PASS = 'roots';
DB_NAME = 'selcom_bridge';
*/
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
?>
