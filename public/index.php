<?php

include 'bootstrap.php';

$app = new Cms\App($di);
$app->run('Page', 'index');
