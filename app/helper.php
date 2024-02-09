<?php

function formatAmount(float $amount){

    return ($amount<0 ? '-':'').number_format(abs($amount) ,3).'$'; 
}

function formDates(string $d){
    return date('M j,Y',strtotime($d));
}