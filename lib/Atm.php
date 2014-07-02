<?php
namespace Atm;

class Atm {

    private $fifties;
    private $twenties;
    private $total;

    private function __construct($fifties,$twenies){
        $this->fifties = $fifties;
        $this->twenties = $twenies;

        $this->total = (50*$fifties) + (20*$twenies);
    }

    public static function getInstance($fifties,$twenies){

        return new self($fifties,$twenies);
    }

    public function withdraw($amount){
        if ($this->validateInput($amount)){

            $this->validateBankNotes($amount);
        }
    }

    /**
     * Check numeric and max and min values for ATM withdraw
     * @param $amount
     * @return bool
     */
    private function validateInput($amount){
        return (is_numeric($amount) &&
                ($amount>0) &&
                ($amount<$this->total));

    }

    private function validateBankNotes($amount){
        if ($amount%50 == 0)
            return true;

        if ($amount%20 == 0)
            return true;



    }
}