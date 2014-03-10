<?php

require_once __DIR__ . '/../vendor/autoload.php';

/* USING DOT */

$raw = '10.2';

/* INTEGER */

echo Filter\Filter::int($raw) . PHP_EOL;

/* FLOAT */

echo Filter\Filter::float($raw) . PHP_EOL;

/* USING COMMA */

$raw = '10,2';

/* INTEGER */

echo Filter\Filter::int($raw) . PHP_EOL;

/* FLOAT */

echo Filter\Filter::float($raw) . PHP_EOL;