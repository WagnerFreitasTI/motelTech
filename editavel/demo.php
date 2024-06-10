<?php
require_once 'src/mobile/src/MobileDetect.php';

$detect = new \Detection\MobileDetect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');

echo $deviceType ;