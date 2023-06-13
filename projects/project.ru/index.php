<?php
include 'vendor/autoload.php';
use Ssrc\Api;

echo 'Введите код'.PHP_EOL;
$line = trim(fgets(STDIN));
$new = new Api();
$result = $new->pizza($line);
echo $result[0].PHP_EOL;
echo 'Количество вариантов: '.$result[1].PHP_EOL;
?>
