<?php

require __DIR__.'/../../../vendor/autoload.php';

use \App\Services\UserService;

$userId = UserService::delete($_POST);