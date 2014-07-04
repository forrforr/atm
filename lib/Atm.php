<?php
namespace Atm;

class Atm {

    private $fifties;
    private $twenties;
    private $total;

    CONST FIFTIES = 50;
    CONST TWENTIES= 20;
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

        $this->total = (self::FIFTIES*$fifties) + (self::TWENTIES*$twenies);
    }

    public static function getInstance($fifties,$twenies){

        return new self($fifties,$twenies);
    }

    public function withdraw($amount){
        if (! $this->validateWithdrawInput($amount))
            throw new \Exception('Incorect amount');


        //Validate final withdraw
        $nFifties = $this->precalculateFifties($amount);

        return $this->validateBankNoteAmount($amount,$nFifties);

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



    private function precalculateFifties($amount){


        $nFifties = floor($amount / self::FIFTIES);

        return ($nFifties < $this->fifties) ?  $nFifties : $this->fifties;
    }

    private function precalculateTwenties($diff,$nFifties){

        $nTwenties = floor($diff / self::TWENTIES);

        if ($nTwenties === 0 && $nFifties === 0) return false;

        return ($nTwenties <= $this->twenties) ?  $nTwenties : false;

    }

    public function validateBankNoteAmount($amount,$nFifties){


            // when you can get amount only in fifties bill
            if ($nFifties > 0){
                if ($amount % ($nFifties * self::FIFTIES) == 0){

                    $this->fifties-= $nFifties;
                    return true;
                }
            }


            $diff = $amount - ($nFifties * self::FIFTIES);


            $nTwenties = $this->precalculateTwenties($diff,$nFifties);
            //var_dump(sprintf("diff %s : twenties %s: fifties %s and dif/20 %s",$diff,$nTwenties,$nFifties,$diff % self::TWENTIES));

            if ($nTwenties !== false){

                if ($diff % self::TWENTIES === 0){

                    $this->fifties-= $nFifties;
                    $this->twenties-= $nTwenties;
                    return true;
                } elseif ($nFifties == 0) {

                    return false;
                } else {

                    $nFifties--;
                    return $this->validateBankNoteAmount($amount,$nFifties);
                }

            } else {
                return false;
            }

    }
}