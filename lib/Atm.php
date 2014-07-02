<?php
namespace Atm;

class Atm {

    private $fifties;
    private $twenties;
    private $total;

    /**
     * @param $fifties
     * @param $twenies
     */
    private function __construct($fifties,$twenies){

        if ((!is_numeric($fifties) || !is_int($fifties)) ||
            (!is_numeric($twenies) || !is_int($twenies)))
            throw new \Exception('Invalid inputs ');

        $this->fifties = $fifties;
        $this->twenties = $twenies;

        $this->total = (50*$fifties) + (20*$twenies);
    }

    public static function getInstance($fifties,$twenies){

        return new self($fifties,$twenies);
    }

    public function withdraw($amount){
        if (! $this->validateWithdrawInput($amount))
            throw new \Exception('Incorect amount');


        //Validate final withdraw
        $this->validateBankNotes($amount);

    }

    /**
     * Check numeric and max and min values for ATM withdraw
     * @param $amount
     * @return bool
     */
    private function validateWithdrawInput($amount){
        return (is_numeric($amount) &&
                ($amount>0) &&
                ($amount < $this->total));

    }

    private function validateBankNotes($amount){
        if ($amount%50 == 0)
            return true;

        if ($amount%20 == 0)
            return true;

    }


    
}