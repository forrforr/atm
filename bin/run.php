<?php
require dirname(__FILE__).'/../vendor/autoload.php';

echo "Please load ATM with fifties: ";
$handle = fopen ("php://stdin","r");
$line = fgets($handle);
if(is_numeric(trim($line))){
    $nFifties = $line;
}

echo "Please load ATM with twenties: ";
$handle = fopen ("php://stdin","r");
$line = fgets($handle);
if(is_numeric(trim($line))){
    $nTwenties = $line;
}



echo "Please Withdraw from ATM amount: ";
$handle = fopen ("php://stdin","r");
$line = fgets($handle);
if(is_numeric(trim($line))){
    $howMuch = $line;
}


try {
    $oAtm = \Atm\Atm::getInstance((integer)$nFifties,(integer)$nTwenties);
    $oAtm->withdraw((integer)$howMuch);
    echo "Withdraw was succesfull \n";
    echo $oAtm;
} catch (\Exception $e){
    echo "Withdraw was not succesfull \n";
    echo $e->getMessage();
    echo $oAtm;
}


?>