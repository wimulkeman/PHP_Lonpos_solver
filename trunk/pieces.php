<?php
// Define the possible pieces. The location of a piece is defined by a bitstring
// where the first part of the piece in the upper left corner is defined by the
// first character of the string
$pieces = array(
    'A' => array(
        'color' => 'purple',
        'terminalColor' => chr(27) . "[0;35m%s" . chr(27) . "[0m",
        'coords' => array(
            // . . . .
            // . A . .
            // . A . .
            // . A A .
            // . . . .
            '1' . str_repeat('0', $lineLength - 1) . '1' 
            . str_repeat('0', $lineLength - 1) . '11',
            // . . . .
            // . . A .
            // . . A .
            // . A A .
            // . . . .
            '1' . str_repeat('0', $lineLength - 1) . '1' 
            . str_repeat('0', $lineLength - 2) . '11',
            // . . . .
            // . A A .
            // . A . .
            // . A . .
            // . . . .
            '11' . str_repeat('0', $lineLength - 2) . '1' 
            . str_repeat('0', $lineLength - 1) . '1',
            // . . . .
            // . A A .
            // . . A .
            // . . A .
            // . . . .
            '11' . str_repeat('0', $lineLength - 1) . '1' 
            . str_repeat('0', $lineLength - 1) . '1',
            // . . . . .
            // . A A A .
            // . A . . .
            // . . . . .
            '111' . str_repeat('0', $lineLength - 3) . '1',
            // . . . . .
            // . A A A .
            // . . . A .
            // . . . . .
            '111' . str_repeat('0', $lineLength - 1) . '1',
            // . . . . .
            // . A . . .
            // . A A A .
            // . . . . .
            '1' . str_repeat('0', $lineLength - 1) . '111',
            // . . . . .
            // . . . A .
            // . A A A .
            // . . . . .
            '1' . str_repeat('0', $lineLength - 3) . '111',
       )
    ),
    'B' => array(
        'color' => 'blue',
        'terminalColor' => chr(27) . "[0;34m%s" . chr(27) . "[0m",
        'coords' => array(
            // . . . .
            // . . B .
            // . B B .
            // . B B .
            // . . . .
            '1' . str_repeat('0', $lineLength - 2) . '11' 
            . str_repeat('0', $lineLength - 2) . '11',
            // . . . .
            // . B . .
            // . B B .
            // . B B .
            // . . . .
            '1' . str_repeat('0', $lineLength - 1) . '11' 
            . str_repeat('0', $lineLength - 2) . '11',
            // . . . .
            // . B B .
            // . B B .
            // . B . .
            // . . . .
            '11' . str_repeat('0', $lineLength - 2) . '11' 
            . str_repeat('0', $lineLength - 2) . '1',
            // . . . .
            // . B B .
            // . B B .
            // . . B .
            // . . . .
            '11' . str_repeat('0', $lineLength - 2) . '11' 
            . str_repeat('0', $lineLength - 1) . '1',
            // . . . . .
            // . B B B .
            // . B B . .
            // . . . . .
            '111' . str_repeat('0', $lineLength - 3) . '11',
            // . . . . .
            // . B B . .
            // . B B B .
            // . . . . .
            '11' . str_repeat('0', $lineLength - 2) . '111',
            // . . . . .
            // . B B B .
            // . . B B .
            // . . . . .
            '111' . str_repeat('0', $lineLength - 2) . '11',
            // . . . . .
            // . . B B .
            // . B B B .
            // . . . . .
            '11' . str_repeat('0', $lineLength - 3) . '111',
        )
    ),
    'C' => array(
        'color' => 'cyan',
        'terminalColor' => chr(27) . "[0;36m%s" . chr(27) . "[0m",
        'coords' => array(
            // . . . .
            // . C . .
            // . C . .
            // . C . .
            // . C C .
            // . . . .
            '1' . str_repeat('0', $lineLength - 1) . '1' 
            . str_repeat('0', $lineLength - 1) . '1' 
            . str_repeat('0', $lineLength - 1) . '11',
            // . . . .
            // . . C .
            // . . C .
            // . . C .
            // . C C .
            // . . . .
            '1' . str_repeat('0', $lineLength - 1) . '1' 
            . str_repeat('0', $lineLength - 1) . '1' 
            . str_repeat('0', $lineLength - 2) . '11',
            // . . . .
            // . C C .
            // . C . .
            // . C . .
            // . C . .
            // . . . .
            '11' . str_repeat('0', $lineLength - 2) . '1' 
            . str_repeat('0', $lineLength - 1) . '1' 
            . str_repeat('0', $lineLength - 1) . '1',
            // . . . .
            // . C C .
            // . . C .
            // . . C .
            // . . C .
            // . . . .
            '11' . str_repeat('0', $lineLength - 1) 
            . '1' . str_repeat('0', $lineLength - 1) . '1' 
            . str_repeat('0', $lineLength - 1) . '1',
            // . . . . . .
            // . C C C C .
            // . C . . . .
            // . . . . . .
            '1111' . str_repeat('0', $lineLength - 4) . '1',
            // . . . . . .
            // . C C C C .
            // . . . . C .
            // . . . . . .
            '1111' . str_repeat('0', $lineLength - 1) . '1',
            // . . . . . .
            // . C . . . .
            // . C C C C .
            // . . . . . .
            '1' . str_repeat('0', $lineLength - 1) . '1111',
            // . . . . . .
            // . . . . C .
            // . C C C C .
            // . . . . . .
            '1' . str_repeat('0', $lineLength - 4) . '1111',
        )
    ),
    'D' => array(
        'color' => 'magenta',
        'terminalColor' => chr(27) . "[1;33m%s" . chr(27) . "[0m",
        'coords' => array(
            // . . . .
            // . D . .
            // . D . .
            // . D D .
            // . D . .
            // . . . .
            '1' . str_repeat('0', $lineLength - 1) . '1' 
            . str_repeat('0', $lineLength - 1) . '11' 
            . str_repeat('0', $lineLength - 2) . '1',
            // . . . .
            // . . D .
            // . . D .
            // . D D .
            // . . D .
            // . . . .
            '1' . str_repeat('0', $lineLength - 1) . '1' 
            . str_repeat('0', $lineLength - 2) . '11' 
            . str_repeat('0', $lineLength - 1) . '1',
            // . . . .
            // . D . .
            // . D D .
            // . D . .
            // . D . .
            // . . . .
            '1' . str_repeat('0', $lineLength - 1) . '11' 
            . str_repeat('0', $lineLength - 2) . '1' 
            . str_repeat('0', $lineLength - 1) . '1',
            // . . . .
            // . . D .
            // . D D .
            // . . D .
            // . . D .
            // . . . .
            '1' . str_repeat('0', $lineLength - 2) . '11' 
            . str_repeat('0', $lineLength - 1) . '1' 
            . str_repeat('0', $lineLength - 1) . '1',
            // . . . . . .
            // . D D D D .
            // . . D . . .
            // . . . . . .
            '1111' . str_repeat('0', $lineLength - 3) . '1',
            // . . . . . .
            // . D D D D .
            // . . . D . .
            // . . . . . .
            '1111' . str_repeat('0', $lineLength - 2) . '1',
            // . . . . . .
            // . . D . . .
            // . D D D D .
            // . . . . . .
            '1' . str_repeat('0', $lineLength - 2) . '1111',
            // . . . . . .
            // . . . D . .
            // . D D D D .
            // . . . . . .
            '1' . str_repeat('0', $lineLength - 3) . '1111',
        )
    ),
    'E' => array(
        'color' => 'grey',
        'terminalColor' => chr(27) . "[0;37m%s" . chr(27) . "[0m",
        'coords' => array(
            // . . . .
            // . E . .
            // . E . .
            // . E E .
            // . . E .
            // . . . .
            '1' . str_repeat('0', $lineLength - 1) . '1' 
            . str_repeat('0', $lineLength - 1) . '11' 
            . str_repeat('0', $lineLength - 1) . '1',
            // . . . .
            // . . E .
            // . . E .
            // . E E .
            // . E . .
            // . . . .
            '1' . str_repeat('0', $lineLength - 1) . '1' 
            . str_repeat('0', $lineLength - 2) . '11' 
            . str_repeat('0', $lineLength - 2) . '1',
            // . . . .
            // . . E .
            // . E E .
            // . E . .
            // . E . .
            // . . . .
            '1' . str_repeat('0', $lineLength - 2) . '11' 
            . str_repeat('0', $lineLength - 2) . '1' 
            . str_repeat('0', $lineLength - 1) . '1',
            // . . . .
            // . E . .
            // . E E .
            // . . E .
            // . . E .
            // . . . .
            '1' . str_repeat('0', $lineLength - 1) . '11' 
            . str_repeat('0', $lineLength - 1) . '1' 
            . str_repeat('0', $lineLength - 1) . '1',
            // . . . . . .
            // . E E E . .
            // . . . E E .
            // . . . . . .
            '111' . str_repeat('0', $lineLength - 1) . '11',
            // . . . . . .
            // . . E E E .
            // . E E . . .
            // . . . . . .
            '111' . str_repeat('0', $lineLength - 4) . '11',
            // . . . . . .
            // . E E . . .
            // . . E E E .
            // . . . . . .
            '11' . str_repeat('0', $lineLength - 1) . '111',
            // . . . . . .
            // . . . E E .
            // . E E E . .
            // . . . . . .
            '11' . str_repeat('0', $lineLength - 4) . '111',
        )
    ),
    'F' => array(
        'color' => 'lime',
        'terminalColor' => chr(27) . "[1;32m%s" . chr(27) . "[0m",
        'coords' => array(
            // . . . .
            // . F . .
            // . F F .
            // . . . .
            '1' . str_repeat('0', $lineLength - 1) . '11',
            // . . . .
            // . . F .
            // . F F .
            // . . . .
            '1' . str_repeat('0', $lineLength - 2) . '11',
            // . . . .
            // . F F .
            // . F . .
            // . . . .
            '11' . str_repeat('0', $lineLength - 2) . '1',
            // . . . .
            // . F F .
            // . . F .
            // . . . .
            '11' . str_repeat('0', $lineLength - 1) . '1',
        )
    ),
    'G' => array(
        'color' => 'pink',
        'terminalColor' => chr(27) . "[1;35m%s" . chr(27) . "[0m",
        'coords' => array(
            // . . . . .
            // . G . . .
            // . G . . .
            // . G G G .
            // . . . . .
            '1' . str_repeat('0', $lineLength - 1) . '1' 
            . str_repeat('0', $lineLength - 1) . '111',
            // . . . . .
            // . . . G .
            // . . . G .
            // . G G G .
            // . . . . .
            '1' . str_repeat('0', $lineLength - 1) . '1' 
            . str_repeat('0', $lineLength - 3) . '111',
            // . . . . .
            // . G G G .
            // . G . . .
            // . G . . .
            // . . . . .
            '111' . str_repeat('0', $lineLength - 3) . '1' 
            . str_repeat('0', $lineLength - 1) . '1',
            // . . . . .
            // . G G G .
            // . . . G .
            // . . . G .
            // . . . . .
            '111' . str_repeat('0', $lineLength - 1) . '1' 
            . str_repeat('0', $lineLength - 1) . '1',
        )
    ),
    'H' => array(
        'color' => 'green',
        'terminalColor' => chr(27) . "[0;32m%s" . chr(27) . "[0m",
        'coords' => array(
            // . . . . .
            // . H . . .
            // . H H . .
            // . . H H .
            // . . . . .
            '1' . str_repeat('0', $lineLength - 1) . '11' 
            . str_repeat('0', $lineLength - 1) . '11',
            // . . . . .
            // . . . H .
            // . . H H .
            // . H H . .
            // . . . . .
            '1' . str_repeat('0', $lineLength - 2) . '11' 
            . str_repeat('0', $lineLength - 3) . '11',
            // . . . . .
            // . . H H .
            // . H H . .
            // . H . . .
            // . . . . .
            '11' . str_repeat('0', $lineLength - 3) . '11' 
            . str_repeat('0', $lineLength - 2) . '1',
            // . . . . .
            // . H H . .
            // . . H H .
            // . . . H .
            // . . . . .
            '11' . str_repeat('0', $lineLength - 1) . '11' 
            . str_repeat('0', $lineLength - 1) . '1',
        )
    ),
    'I' => array(
        'color' => 'yellow',
        'terminalColor' => chr(27) . "[0;33m%s" . chr(27) . "[0m",
        'coords' => array(
            // . . . .
            // . I I .
            // . I . .
            // . I I .
            // . . . .
            '11' . str_repeat('0', $lineLength - 2) . '1' 
            . str_repeat('0', $lineLength - 1) . '11',
            // . . . .
            // . I I .
            // . . I .
            // . I I .
            // . . . .
            '11' . str_repeat('0', $lineLength - 1) . '1' 
            . str_repeat('0', $lineLength - 2) . '11',
            // . . . . .
            // . I I I .
            // . I . I .
            // . . . . .
            '111' . str_repeat('0', $lineLength - 3) . '1' . '0' . '1',
            // . . . . .
            // . I . I .
            // . I I I .
            // . . . . .
            '1' . '0' . '1' . str_repeat('0', $lineLength - 3) . '111',
        )
    ),
    'J' => array(
        'color' => 'red',
        'terminalColor' => chr(27) . "[0;31m%s" . chr(27) . "[0m",
        'coords' => array(
            // . . .
            // . J .
            // . J .
            // . J .
            // . J .
            // . . .
            '1' . str_repeat('0', $lineLength - 1) . '1' 
            . str_repeat('0', $lineLength - 1) . '1' 
            . str_repeat('0', $lineLength - 1) . '1',
            // . . . . . .
            // . J J J J .
            // . . . . . .
            '1111',
        )
    ),
    'K' => array(
        'color' => 'orange',
        'terminalColor' => chr(27) . "[1;31m%s" . chr(27) . "[0m",
        'coords' => array(
            // . . . .
            // . K K .
            // . K K .
            // . . . .
            '11' . str_repeat('0', $lineLength - 2) . '11',
        )
    ),
    'L' => array(
        'color' => 'white',
        'terminalColor' => chr(27) . "[1;37m%s" . chr(27) . "[0m",
        'coords' => array(
            // . . . . .
            // . . L . .
            // . L L L .
            // . . L . .
            // . . . . .
            '1' . str_repeat('0', $lineLength - 2) . '111' 
            . str_repeat('0', $lineLength - 2) . '1',
        )
    )
);
// Use the lines below to visualize the possible positions of the defined pieces
//foreach ($pieces as $pieceValue => $piece) {
    //foreach ($piece['coords'] as $key => $position) {
        //$pieceBitstring = preparePieceBitstring($cleanBoardBit, $position);
        //$solution = drawZero(strlen($cleanBoardBit), 1);
        //$solution = updateSolution($pieceBitstring, $pieceValue, $solution);
        //drawBoard($solution);
    //}
//}
//exit;
