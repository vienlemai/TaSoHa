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

?>
