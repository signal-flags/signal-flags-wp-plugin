<?php

const SOURCE_DIR = __DIR__.'/../../signal-flag-images/images';
const DEST_DIR = __DIR__.'/../signal-flags/vendor/opensums/signal-flags/flags/';

$inputFiles = glob(SOURCE_DIR.'/**/*.json');

// file_put_contents(DEST_DIR.'/test.txt', "Hello World. Testing!");

$i = 0;
foreach ($inputFiles as $input) {
    $input = realpath($input);

    echo("Reading $input\n");
    $json = file_get_contents($input);
    $array = json_decode($json, true);

    // $outFileName = substr(basename($input, '.json'), 4, 15) . '.php';
    $outFileName = "flags-$i.php";
    $outFile = "<?php return ".var_export($array, true).";";
    echo("Writing $outFileName (" . number_format(strlen($outFile)) . " bytes)\n");
    file_put_contents(DEST_DIR.$outFileName, $outFile);
    $i++;
}
