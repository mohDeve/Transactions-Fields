<?php

declare(strict_types = 1);

// Your Code

// find csv file location and return a file  location as string
function getTransactionsFiles(string $path){
    $files =[];
    foreach(scandir($path) as $file){
        if(is_dir($file)){
            continue;
        }
        $files[]= $path.$file;
    }
    //var_dump($files);
    return $files;
}

function getTransactions(string $fileName){
    if(!file_exists($fileName)){
        trigger_error('File "'.$fileName.'" does not exist',E_USER_ERROR);
    }
    //open file
    $file = fopen($fileName,'r');
    fgetcsv($file);
    $transactions =[];
    //Gets line from file pointer and parse for CSV fields using fgetcsv
    while (($transaction = fgetcsv($file))!== false) {
      
        $transactions[]=extractTransaction($transaction);
    }
    return $transactions;
}

function extractTransaction(array $transactionRow){
        [$date , $checkNumber ,$description ,$amount] = $transactionRow;

        $amount = (float)str_replace(["$",","],"",$amount);
        return [
                    'date'=>$date , 
                    'checkNumber'=>$checkNumber ,
                    'description'=>$description ,
                    'amount'=>$amount
                ] ;
}

function calculateTotals(array $transactions){
    $totals = ['netTotal'=> 0 , 'totalIncome'=> 0 , 'totalExpense'=>0];
    foreach ($transactions as $t) {
        $totals['netTotal'] += $t['amount'];
        if($t['amount'] >= 0 ){
            $totals['totalIncome'] += $t['amount'];
        }else{
            $totals['totalExpense'] -= $t['amount'];
        }
    }
    return $totals;
}