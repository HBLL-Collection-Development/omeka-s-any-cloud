<?php

// Get version from the tag name passed from `release.yml` action
// Strip prefix `v` if it exists
$version = ltrim($argv[1], 'v');

// Get `module.ini` content
$ini = file_get_contents('./config/module.ini');

// Replace `%s` with correct version from the tag name
$file = sprintf($ini, $version);

// Open the `module.ini` file
$fp = fopen('./config/module.ini', 'w');

// Replace contents with the new version number
fwrite($fp, $file);
