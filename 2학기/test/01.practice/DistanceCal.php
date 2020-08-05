<?php

$speedOfLight = 30;
$planet = ['mercury' => 5790, 'earth' => 15000, 'mars' => 23000];

$minutes = round($planet[$_POST[ischeked]] / $speedOfLight / 60,2);

echo "Trave time from Sun to {$_POST['ischeked']} :" .$minutes. "minutes";