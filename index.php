<?php
session_start();
require_once 'connect/connection.php';

$page = explode('?', urldecode($_SERVER['REQUEST_URI'] ))[0];
$_GET = explode('?', urldecode($_SERVER['REQUEST_URI'] ))[1] ?? '';
parse_str($_GET, $_GET);
$page = substr($page, 1);
$pages = explode('/', $page);
$page = $pages[0] ?? '';

switch(mb_strtolower($page)){

case '':
 include('pages/index.php');
 break;
case 'login':
 include('pages/login.php');
 break;
case 'logout':
 include('pages/logout.php');
 break;
case 'info':
 include('pages/info.php');
 break;
case 'error':
 include('pages/404.php');
 break;
default:
 include('pages/index.php');
 break;
}