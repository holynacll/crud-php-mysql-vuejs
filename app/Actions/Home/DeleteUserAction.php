<?php

require __DIR__.'/../../../vendor/autoload.php';

use \App\Services\UserService;

$user = UserService::find($_GET['id']);
$user->delete();
header('location: index.php?status=success');
exit;