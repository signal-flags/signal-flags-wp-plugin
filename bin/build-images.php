<?php

const SOURCE_DIR = __DIR__.'/../../signal-flag-images/images/';
const DEST_DIR = __DIR__.'/../signal-flags/vendor/opensums/signal-flags/flags/';

$inputFiles = glob(SOURCE_DIR.'/**/*.json');

// file_put_contents(DEST_DIR.'/test.txt', "Hello World. Testing!");

foreach ($inputFiles as $input) {
    $json = file_get_contents($input);
    $array = json_decode($json, true);
    $outFileName = substr(basename($input, '.json'), 4, 15) . '.php';
    $outFile = "<?php return ".var_export($array, true).";";
    file_put_contents(DEST_DIR.$outFileName, $outFile);
}
