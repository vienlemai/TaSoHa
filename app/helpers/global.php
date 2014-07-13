<?php

function monthsForSelect($count = 3) {
    $months = array();
    $tmp = \Carbon\Carbon::now()->addMonth();
    for ($i = 0; $i < $count; $i++) {
        $tmp->subMonth()->startOfMonth();
        array_push($months, $tmp->format('Y-m-d'));
    }
    return $months;
}
/**
 * 
 * @param string $text      -> the string wants to truncate
 * @param integer $limit    -> the length limited of given string
 * @param string $pad       -> replace truncated string by
 * @return string
 */
function truncate($text, $limit, $pad = "...") {

    $words = explode(' ', $text, ($limit + 1));
    if (count($words) > $limit) {
        array_pop($words);
        array_push($words, $pad);
    }
    return implode(' ', $words);
}

?>
