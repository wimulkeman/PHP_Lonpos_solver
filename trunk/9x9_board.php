<?php
// Start with drawing out the bord. Originaly the bord has a surface of 9 by 9.
// With the border included this makes a square of 11x11. Each row consists of
// 11 bits
//
// X = Static filled spot
// - = Available spot
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
    '1111 1111 111', // Row 1
    '1000 0001 111', // Row 2
    '1000 0000 111', // Row 3
    '1000 0000 011', // Row 4
    '1001 0000 001', // Row 5
    '1000 0000 001', // Row 6
    '1000 0000 111', // Row 7
    '1100 0001 111', // Row 8
    '1110 0011 111', // Row 9
    '1111 0011 111', // Row 10
    '1111 1111 111', // Row 11
);
// Concat the rows together to one string en remember the length of the rows for
// later purposes
$cleanBoardBit = (string) str_replace(' ', '', implode('', $cleanBoardArray));
$lineLength = strlen(str_replace(' ', '', $cleanBoardArray[0]));
