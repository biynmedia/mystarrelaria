<?php

use App\Provider\IndexControllerProvider;
use App\Provider\MembreControllerProvider;
use App\Provider\ArtisteControllerProvider;

$app->mount('/', new IndexControllerProvider());
$app->mount('/membre', new MembreControllerProvider());
$app->mount('/artiste', new ArtisteControllerProvider());