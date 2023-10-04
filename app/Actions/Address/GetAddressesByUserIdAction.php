<?php

require __DIR__.'/../../../vendor/autoload.php';

use \App\Services\AddressService;

$addresses = AddressService::getManyByUserIdSortedByUpdatedAt($_GET['id']);
echo json_encode(['addresses' => $addresses]);