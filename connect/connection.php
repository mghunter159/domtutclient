<?php
require_once 'constants.php'; // подключаем скрипт


 // подключаемся к серверу
	$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));

	?>