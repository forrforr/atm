<?php
/**
 * Created by JetBrains PhpStorm.
 * User: rob
 * Date: 2/07/2014
 * Time: 10:19 AM
 * To change this template use File | Settings | File Templates.
 */
require dirname(__FILE__).'/../../vendor/autoload.php';

class AtmTest extends \PHPUnit_Framework_TestCase
{

    public function testInstanceOfAtm(){

        $oInstance = \Atm\Atm::getInstance(3,4);

        $this->assertTrue(($oInstance instanceof \Atm\Atm));


    }

    /**
     * @expectedException Exception
     * @dataProvider providerIncorectInput
     */
    public function testInputAtmInstantiateException($fifties,$twenties){

        \Atm\Atm::getInstance($fifties,$twenties);

    }

    /**
     * @param $fifties
     * @param $twenties
     * @param $amount
     * @dataProvider providerIncorectWithdrawInput
     * @expectedException Exception
     */
    public function testWitdrawing($fifties,$twenties,$amount){

        //var_dump(func_get_args());
        $oAtm = \Atm\Atm::getInstance($fifties,$twenties);
        $oAtm->withdraw($amount);


    }


    public function providerIncorectInput(){
        return array(
            array(3,'text'),
            array('te',4),
            array(null,null),
            array(3.5, 35.5),
        );

    }
    public function providerIncorectWithdrawInput(){
        return array(
            array(3,2,4000),
            array(1,1,-25)
        );

    }

}