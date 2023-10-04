<?php

require __DIR__.'/../../../vendor/autoload.php';

use \App\Services\UserService;

$userId = UserService::create($_POST);
echo json_encode(['userId' => $userId]);