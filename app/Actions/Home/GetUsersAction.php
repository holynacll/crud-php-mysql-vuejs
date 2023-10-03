<?php

require __DIR__.'/../../../vendor/autoload.php';

use \App\Services\UserService;

$users = UserService::getMany();
echo $users;
exit;