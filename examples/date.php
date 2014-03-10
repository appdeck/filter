<?php

require_once __DIR__ . '/../vendor/autoload.php';

/* VALID FORMAT */

$raw = '10/01/2014';

$filtered = Filter\Filter::date($raw);

echo 'yyyy/mm/dd: ' . $filtered . PHP_EOL;

/* INVALID FORMAT */

$raw = '32/01/2000';

$filtered = Filter\Filter::date($raw);

if (is_null($filtered))
	echo 'Invalid date format.' . PHP_EOL;
else
	echo 'This is not going to be displayed.' . PHP_EOL;