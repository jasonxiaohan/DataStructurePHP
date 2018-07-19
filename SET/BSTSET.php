<?php
/**
 * Created by PhpStorm.
 * User: daixiaohan
 * Date: 2018/7/19
 * Time: 7:55
 */

require_once '../BST/BinarySearchTree.php';
require_once 'Set.php';

class BSTSET implements Set
{
    private $bst;
    public function __construct()
    {
        $this->bst = new BinarySearchTree();
    }

    public function add($e)
    {
        // TODO: Implement add() method.
        $this->bst->add($e);
    }

    public function remove($e)
    {
        // TODO: Implement remove() method.
        $this->bst->remove($e);
    }

    public function contains($e)
    {
        // TODO: Implement contains() method.
        return $this->bst->contains($e);
    }

    public function getSize()
    {
        // TODO: Implement getSize() method.
        return $this->bst->getSize();
    }

    public function isEmpty()
    {
        // TODO: Implement isEmpty() method.
        return $this->bst->isEmpty();
    }
}