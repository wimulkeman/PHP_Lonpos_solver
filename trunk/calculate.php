<?php
// Include the required files
include_once('./functions.php');
include_once('./9x9_board.php');
include_once('./pieces.php');

$startTime = (float) (time() + microtime());
echo monitor('Files included');

// The exceptions to detect invalid situations
// . . . . .
// . . 1 . .
// . 1 0 1 .
// . . 1 . .
// . . . . .
$regex = '/1[01]{' . ($lineLength - 2) . '}101[01]{'
    . ($lineLength -2) . '}1/';
// . . . . .
// . . 1 . .
// . 1 0 1 .
// . 1 0 1 .
// . . 1 . .
// . . . . .
$regex2 = '/1[01]{' . ($lineLength - 2) . '}101'
    . '[01]{' . ($lineLength - 3) . '}101' . '[01]{'
    . ($lineLength -2) . '}1/';
// . . . . . .
// . . 1 1 . .
// . 1 0 0 1 .
// . . 1 1 . .
// . . . . . .
$regex3 = '/11[01]{' . ($lineLength - 3) . '}1001[01]{'
    . ($lineLength - 3) . '}11/';
// . . . . .
// . . 1 . .
// . 1 0 1 .
// . 1 0 1 .
// . 1 0 1 .
// . . 1 . .
// . . . . .
$regex4 = '/1[01]{' . ($lineLength - 2) . '}101'
    . '[01]{' . ($lineLength - 3) . '}101'
    . '[01]{' . ($lineLength - 3) . '}101' . '[01]{'
    . ($lineLength -2) . '}1/';
// . . . . . . .
// . . 1 1 1 . .
// . 1 0 0 0 1 .
// . . 1 1 1 . .
// . . . . . . .
$regex5 = '/111[01]{' . ($lineLength - 4) . '}1001[01]{'
    . ($lineLength - 4) . '}111/';

// Enable the script to run as long as needed
set_time_limit(0);

// Keep track of the progress made by the script
$log = array(
    'solutions' => 0,
    'solutionsDrawn' => array(),
    'mis_piecevalue' => 0,
    'mis_pieceposition' => 0,
    'mis_piece_to_long' => 0,
    'mis_isoleted_field' => 0,
);

/**
 * Calculate all possible solutions
 *
 * @param array  &$pieces  The available pieces
 * @param string $solution The solution calculation upto this point
 * @param string $bitboard The status of the bitboard upto this point
 *
 * @return void
 * @author WIM
 */
function calculateSolution(&$pieces, $solution, $bitboard, $step = 0)
{
    global $cleanBoardBit;
    global $lineLength;
    global $log;

    global $regex;
    global $regex2;
    global $regex3;

    // If the calculation has reached its last step, draw the solution
    if ($step >= sizeof($pieces)) {
    //if ($step >= 1) {
        $parts = str_split($solution, $lineLength);

        $text = '';
        $text .= str_repeat(chr(27) . "[1;30m=" . chr(27) . "[0m", $lineLength * 2 + 5);
        $text .= "\n";

        $count = 0;
        $nrCharacters = 0;
        $uniqueCharacters = array();
        foreach ($parts as $part) {
            $text .= chr(27) . "[1;30m|| " . chr(27) . "[0m";

            $characters = str_split($part, 1);
            foreach ($characters as $character) {
                if ($character != '0') {
                    $text .= sprintf(
                        $pieces[$character]['terminalColor'],
                        $character
                    ) . ' ';

                    if (!in_array($character, $uniqueCharacters)) {
                        ++ $nrCharacters;
                        $uniqueCharacters[] = $character;
                    }
                } elseif ($cleanBoardBit[$count] == '1') {
                    $text .= chr(27) . '[1;30mX ' . chr(27) . "[0m";
                } else {
                    $text .= chr(27) . '[1;30m- ' . chr(27) . "[0m";
                }
                ++ $count;
            }
            $text .= chr(27) . "[1;30m|| " . chr(27) . "[0m\n";
        }

        $text = "\n" . chr(27) . "[1;30mStap: $nrCharacters - oplossing: "
            . ($log['solutions'] + 1) . chr(27) . "[0m\n" . $text;

        $text .= str_repeat(chr(27) . "[1;30m=" . chr(27) . "[0m", $lineLength * 2 + 5);
        $text .= "\n";

        echo $text;

        //$log['solutionsDrawn'][] = $solution;
        ++ $log['solutions'];

        // No further actions needed, quit this calculation
        return;
    }

    // Check if any of the pieces could provide a possible match
    foreach ($pieces as $pieceValue => $piece) {
        // Check if the piece isn't allready on the board
        if (strpos($solution, $pieceValue) !== false) {
            ++ $log['mis_piecevalue'];
            continue;
        }

        foreach ($piece['coords'] as $position) {
            //echo $step . ' | ';

            // Determine the postion where the piece will be placed, en prefix it with 0
            // upto that point
            $curPosition = str_repeat('0', strpos($bitboard, '0')) . $position;
            // Check if the piece won't run off the board
            if (strlen($curPosition) >= strlen($bitboard)) {
                ++ $log['mis_piece_to_long'];
                continue;
            }
            // Fill the string for the piece to match the board length. Account 1 extra
            $curPosition .= str_repeat('0', (strlen($bitboard) - strlen($curPosition)));

            // Check if the calculated position is available
            if (($curPosition & $bitboard) != 0) {
                ++ $log['mis_pieceposition'];
                continue;
            }

            // Recalculate the board with the new piece inlcuded
            $newBitboard = ($bitboard | $curPosition);

            // Check for invalid isolated cels
            if (preg_match($regex, $newBitboard)
                || preg_match($regex2, $newBitboard)
                || preg_match($regex3, $newBitboard)
            ) {
                ++ $log['mis_isoleted_field'];
                continue;
            }

            // Generate the new solution
            $newSolution = $solution;
            // Check the position of the new piece and use it to rewrite the solution string
            while (strpos($curPosition, '1') !== false) {
                $bitPosition = strpos($curPosition, '1');

                $newSolution[$bitPosition] = $pieceValue;
                $curPosition[$bitPosition] = '0';
            }

            // Calculate the possible solutions for the generated temporary solution
            calculateSolution($pieces, $newSolution, $newBitboard, $step + 1);
        }
    }
}

// Start with an empty solution
$solution = str_repeat('0', strlen($cleanBoardBit));

// Start calculating solutions
calculateSolution($pieces, $solution, $cleanBoardBit);

debug($log);

echo monitor('Calculating solutions finished');
