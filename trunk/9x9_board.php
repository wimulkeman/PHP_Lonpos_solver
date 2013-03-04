<?php
// Begin met het optekenen van het bord. Het bord heeft origineel gezien een
// opervlakte van 9 bij 9, maar is uitgerust met een 1 border waardoor het
// totaal op 11 bij 11 komt. Elke rij bevat dus 11 bits
//
// X = kan niks geplaatst worden
// - = kan iets geplaatst worden
//
// X X X X X X X X X X X
// X - - - - - - X X X X
// X - - - - - - - X X X
// X - - - - - - - - X X
// X - - X - - - - - - X
// X - - - - - - - - - X
// X - - - - - - - X X X
// X X - - - - - X X X X
// X X X - - - X X X X X
// X X X X - - X X X X X
// X X X X X X X X X X X
$cleanBoardArray = array(
    '1111 1111 111', // Rij 1
    '1000 0001 111', // Rij 2
    '1000 0000 111', // Rij 3
    '1000 0000 011', // Rij 4
    '1001 0000 001', // Rij 5
    '1000 0000 001', // Rij 6
    '1000 0000 111', // Rij 7
    '1100 0001 111', // Rij 8
    '1110 0011 111', // Rij 9
    '1111 0011 111', // Rij 10
    '1111 1111 111', // Rij 11
);
// Zet de weergave om naar een bit string en sla de lengte gelijk op voor later
// gebruikt bij het berekenen van de mogelijke stuk posities
$cleanBoardBit = (string) str_replace(' ', '', implode('', $cleanBoardArray));
$lineLength = strlen(str_replace(' ', '', $cleanBoardArray[0]));
