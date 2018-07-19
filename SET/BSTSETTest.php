<?php
/**
 * Created by PhpStorm.
 * User: daixiaohan
 * Date: 2018/7/19
 * Time: 16:55
 */


require_once '../SET/BSTSET.php';

class BSTSETTest extends PHPUnit_Framework_TestCase
{
    public $bst = null;
    public function __construct()
    {
        $this->bst = new BSTSET();
        $this->bst->add(1);
        $this->bst->add(2);
        $this->bst->add(3);
    }

    public function testContains()
    {
        $this->assertEquals(true, $this->bst->contains(2));
    }

    public function testGetSize()
    {
        $this->assertEquals(3, $this->bst->getSize());
    }

    public function testIsEmpty()
    {
        $this->assertEquals(false, $this->bst->isEmpty());
    }
}
