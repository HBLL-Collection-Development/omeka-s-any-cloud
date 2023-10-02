<?php

// Get version from the tag name passed from `release.yml` action
// Strip prefix `v` if it exists
$version = ltrim($argv[1], 'v');

// Get `module.ini` content
$ini = file_get_contents('./AnyCloud/config/module.ini');

// Replace with correct version from the tag name
$file = preg_replace('/(version\s*=\s)\"(.*?)\"(.*?)\n/', '$1"'.$version.'"$3'."\n", $ini);

// Open the `module.ini` file
$fp = fopen('./AnyCloud/config/module.ini', 'w');

// Replace contents with the new version number
fwrite($fp, $file);
