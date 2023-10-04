<?php

require __DIR__.'/../../../vendor/autoload.php';

use \App\Services\AddressService;

$addressId = AddressService::create($_POST);
echo json_encode(['addressId' => $addressId]);