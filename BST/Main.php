<?php
/**
 * Created by PhpStorm.
 * User: daixiaohan
 * Date: 2018/7/19
 * Time: 8:01
 */

require_once 'BinarySearchTree.php';

$bst = new BinarySearchTree();
//$nums = [5,3,6,8,4,2];
$nums = [41,58,50,42,53,60,59,63];
for($i=0;$i<count($nums);$i++)
{
    $bst->add($nums[$i]);
}
/////////////////
//      5      //
//    /   \    //
//   3    6    //
//  / \    \   //
// 2  4     8  //
/////////////////
//$bst->preOrder();
/*echo PHP_EOL;
print($bst);*/
/*$bst->preOrderNR();
//print $bst;
print PHP_EOL;

$bst->levelOrder();
print PHP_EOL;

// 测试removeMin
$bst->removeMin();
print $bst;
// 测试removeMax
$bst->removeMax();
print $bst;*/
//$bst->remove(8);
print $bst;
