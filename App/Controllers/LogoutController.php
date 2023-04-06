<?php
namespace App\Controllers;
require_once '../../vendor/autoload.php';
use App\Models\Auth\Auth;
use App\Models\Sessions\Session;

Session::startSession();

$auth = new Auth();

$auth->logout();
header('Location:../Views/login.php');



?>