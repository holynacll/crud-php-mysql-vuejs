<?php

require __DIR__.'/../../../vendor/autoload.php';

use \App\Services\AddressService;

$userId = AddressService::delete($_POST);