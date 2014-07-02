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


    
}