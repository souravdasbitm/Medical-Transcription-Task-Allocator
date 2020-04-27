<?php

function timeformat($param) {
    
    $seconds=($param);
    $getHours = floor($seconds / 3600);
    $getMins = floor(($seconds - ($getHours*3600)) / 60);
    $getSecs = floor($seconds % 60);
   // echo $getHours.':'.$getMins.':'.$getSecs;
    
    return array($getHours,$getMins,$getSecs);
}

?>