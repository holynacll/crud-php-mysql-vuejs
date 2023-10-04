<?php

require __DIR__.'/../../../vendor/autoload.php';

use \App\Services\AddressService;

AddressService::update($_POST);