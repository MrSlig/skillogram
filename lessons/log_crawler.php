<?php

$log_encoded = file_get_contents('radio.log');

/* decode */

if ($length = strlen($log_encoded)) {
    
    for (
    $start_pos = 0,
    $end_pos = 0,
    $offset = 0,
    $i = 0,
    $log[
        [
          'ip',
          'date',
          'request',
          'magic',
          'engine'
        ]
    ];
    $start_pos < $length;
    $i++
    ) {
    
    $offset = strpos($log_encoded, " - - ", $start_pos); // ip - - [date]
    $end_pos = $offset - $start_pos - 1; //end of ip adress
    $log[$i]['ip'] = substr($log_encoded, $start_pos, $end_pos); //got ip
    
    $start_pos = $end_pos + 6; //now it is set on first $date char
    $end_pos = strpos($log_encoded, "] ", $start_pos) - 1; //end of date
    $log[$i]['date'] = substr($log_encoded, $start_pos, $end_pos); //got date
    
    $start_pos = $end_pos + 3; // [date] "request"
    $end_pos = strpos($log_encoded, "] ", $start_pos) - 1; //end of request
    $log[$i]['request'] = substr($log_encoded, $start_pos, $end_pos); //got request
    
    $start_pos = $end_pos + 2; // "request" magic numbers "-"
    $end_pos = strpos($log_encoded, ' "-" ', $start_pos) - 1; //end of magic :sob:
    $log[$i]['magic'] = substr($log_encoded, $start_pos, $end_pos); //we got magic!
    
    $start_pos = $end_pos + 6; // magic numbers "-" "engine"
    $end_pos = strpos($log_encoded, '"', $start_pos) - 1; //end of engine
    $log[$i]['engine'] = substr($log_encoded, $start_pos, $end_pos); //got engine
    
    $start_pos = $end_pos + 1;
    }
    
}

echo $log;