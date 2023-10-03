<?php

require __DIR__.'/../../../vendor/autoload.php';

use \App\Services\UserService;

$user = UserService::create($_POST);
header('location: index.php?status=success');
exit;