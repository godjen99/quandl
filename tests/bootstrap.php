<?php
// Load all the composer dependencies.
require __DIR__.'/../vendor/autoload.php';

/**
 * Dumps a given variable and terminates the program.
 *
 * @param $var
 */
function dd($var)
{
    dump($var);
    die(1);
}