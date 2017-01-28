<?php
$lineLength = 11;
require 'trunk/pieces.php';

$intPieces = [];
foreach ($pieces as $letter => $piecePositions) {
    foreach ($piecePositions['coords'] as $piecePosition) {
        $intPieces[$letter][] = bindec($piecePosition);
    }
}
print_r($intPieces);