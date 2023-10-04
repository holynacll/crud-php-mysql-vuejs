<?php

require __DIR__.'/../../../vendor/autoload.php';

use \App\Services\UserService;
use \App\Transformers\UserTransformer;

$user = UserService::find($_GET['id']);
$data = UserTransformer::toArray($user);
echo json_encode(['user' => $data]);