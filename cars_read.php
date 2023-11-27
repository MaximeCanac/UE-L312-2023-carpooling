<?php

use App\Controllers\AnnouncementsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new AnnouncementsController();
echo $controller->getAnnouncements();
