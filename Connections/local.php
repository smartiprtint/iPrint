<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_local = "localhost";
$database_local = "iprint";
$username_local = "iprint";
$password_local = "stinova123";
$local = mysql_pconnect($hostname_local, $username_local, $password_local) or trigger_error(mysql_error(),E_USER_ERROR); 
?>