<?php
// Laad de bestanden in
include_once('./functions.php');
include_once('./9x9_board.php');
include_once('./pieces.php');

$startTime = (float) (time() + microtime());
echo monitor('Bestanden ingeladen');

// De uitzonderingen voor geisolleerde vakken
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

// Geef het script weer wat meer tijd
set_time_limit(0);

// Houd een log bij
$log = array(
    'solutions' => 0,
    'solutionsDrawn' => array(),
    'mis_piecevalue' => 0,
    'mis_pieceposition' => 0,
    'mis_piece_to_long' => 0,
    'mis_isoleted_field' => 0,
);

/**
 * Zoek naar de mogelijke oplossingen
 *
 * @param array  &$pieces  De te bekijken stukken
 * @param string $solution De tot dan toe gevonden oplossing
 * @param string $bitboard De bitboard in zijn staat van dat moment
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

    // Als de stap op het juiste niveau is, teken dan de oplossing
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

        // Geen verdere actie nodig
        return;
    }

    // Loop door alle stukken en kijk welke zouden passen
    foreach ($pieces as $pieceValue => $piece) {
        // Controleer of het soort stuk niet al op het bord ligt
        if (strpos($solution, $pieceValue) !== false) {
            ++ $log['mis_piecevalue'];
            continue;
        }

        foreach ($piece['coords'] as $position) {
            //echo $step . ' | ';

            // Bepaal waar het stuk geplaatst moet worden en plaats 0 karakters voor
            // die lengte
            $curPosition = str_repeat('0', strpos($bitboard, '0')) . $position;
            // Controleer of het stuk niet te lang word.
            if (strlen($curPosition) >= strlen($bitboard)) {
                ++ $log['mis_piece_to_long'];
                continue;
            }
            // Controleer of het stukje niet langer word dan het bord
            // Vul de string aan met 0 karakters totdat het even lang is als het bord
            // zelf. tel een 1 erbij voor het vakje uitzondering systeem in de drawZero
            // functie
            $curPosition .= str_repeat('0', (strlen($bitboard) - strlen($curPosition)));

            // Kijk of er ruimte vrij is
            if (($curPosition & $bitboard) != 0) {
                ++ $log['mis_pieceposition'];
                continue;
            }

            // Werk het bord bji
            $newBitboard = ($bitboard | $curPosition);

            // Controleer op geisolleerde cellen
            if (preg_match($regex, $newBitboard)
                || preg_match($regex2, $newBitboard)
                || preg_match($regex3, $newBitboard)
            ) {
                ++ $log['mis_isoleted_field'];
                continue;
            }

            // Werk de oplossing bij
            $newSolution = $solution;
            // Zoek naar de positie van de 1 in de string en werk deze posite in de
            // oplossing bij met de waarde van het stuk
            while (strpos($curPosition, '1') !== false) {
                $bitPosition = strpos($curPosition, '1');

                $newSolution[$bitPosition] = $pieceValue;
                $curPosition[$bitPosition] = '0';
            }

            // Bereken voor dit stuk de mogelijke oplossingen
            calculateSolution($pieces, $newSolution, $newBitboard, $step + 1);
        }
    }
}

// Er word begonnen met een lege oplossing
$solution = str_repeat('0', strlen($cleanBoardBit));

// Begin met het berekenen
calculateSolution($pieces, $solution, $cleanBoardBit);

debug($log);

echo monitor('Einde berekenen oplossingen');
