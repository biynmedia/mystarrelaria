<?php

use App\Provider\IndexControllerProvider;
use App\Provider\EventControllerProvider;

$app->mount('/', new IndexControllerProvider());
$app->mount('/evenement', new EventControllerProvider());