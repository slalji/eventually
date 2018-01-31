<?php
session_start();
unset($_SESSION["token"]);
unset($_SESSION["firstname"]);
unset($_SESSION["authenticated"]);// where $_SESSION["nome"] is your own variable. if you do not have one use only this as follow **session_unset();**
//header("Location: eventually/index.php");