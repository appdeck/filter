<?php

require_once __DIR__ . '/../vendor/autoload.php';

/* RAW STRING */

$raw = '<script>alert();</script>';

echo Filter\Filter::string($raw) . PHP_EOL;

/* NO TAGS */

echo Filter\Filter::noTags($raw) . PHP_EOL;