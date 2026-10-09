<?php
$a = json_decode(file_get_contents('storage/app/aliran_data_all.json'), true);
print_r(array_keys($a[0]));
