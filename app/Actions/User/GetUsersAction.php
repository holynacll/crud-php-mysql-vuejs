<?php

require __DIR__.'/../../../vendor/autoload.php';

use \App\Services\UserService;

$users = UserService::getManySortedByUpdatedAt();
echo json_encode($users);