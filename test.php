<?php
$n = 5 ;
$card =  array(1,2,3);
function maxCardCount($n, $card) {
    return dp(0, $n-1, $card, 0);
}

function dp($i, $n, $card, $sum) {
    if ($i == $n) {
        return $sum;
    } else if ($sum + $card[$i] >= 0) {
        return max(dp($i + 1, $n, $card, $sum + $card[$i]), dp($i + 1, $n, $card, $sum));
    } else {
        return dp($i + 1, $n, $card, $sum);
    }
}

// Read input values
$n = trim(fgets(STDIN));
$cards = array_map('intval', explode(' ', trim(fgets(STDIN))));

// Find the maximum number of cards that can be picked up
$result = maxCardCount($n, $cards);

// Print the result
echo $result . PHP_EOL;
?>