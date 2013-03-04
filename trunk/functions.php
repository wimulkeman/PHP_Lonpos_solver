<?php
/**
 * Laat debug informatie zien
 *
 * @param mixed $input De informatie die getoond moet worden
 *
 * @return void
 * @author WIM
 */
function debug($input, $exit = false)
{
    // Kijk waar de debug functie word aangeroepen
    $requestPosition = debug_backtrace();
    $line = $requestPosition[0]['line'];
    $file = $requestPosition[0]['file'];

    print_r('File: ' . $file . ' - line: ' . $line . "\n");
    print_r($input);
    if ($exit === true) {
        exit;
    }
}

/**
 * Geeft een tijdstamp voor een indicatie hoelang iets al duurt
 *
 * @param string  $event De omschrijving van de gebeurtenis
 *
 * @return integer
 * @author WIM
 */
function monitor($event = '')
{
    global $startTime;
    return $event . ': ' . ((float) (time() + microtime()) - $startTime) . "<br/>\n";
}
