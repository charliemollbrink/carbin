<?php
require_once('Resource.class.php');
require_once('Api.class.php');
mysql_connect('localhost','root','root');
mysql_select_db('drinkproj');
mysql_query("SET NAMES 'utf8'"); 
if(isset($_GET) && $_GET){ 
    $api = new Api();
}
 
?>