<?php
/**
 * Display debug information
 *
 * @param mixed $input The information that needs to be displayed
 *
 * @return void
 * @author WIM
 */
function debug($input, $exit = false)
{
    // Backtrace the place where this function whas requested
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
 * Create a timestamp to indicate the running time of a process
 *
 * @param string $event The description of the process
 *
 * @return integer
 * @author WIM
 */
function monitor($event = '')
{
    global $startTime;
    return $event . ': ' . ((float) (time() + microtime()) - $startTime) . "<br/>\n";
}
