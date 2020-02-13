<?php
// A futtatandó szkript kiválasztása az URL-ből
$url = explode('/', $_GET["url"]);
$action = $url[0];

require "$action.php";

?>