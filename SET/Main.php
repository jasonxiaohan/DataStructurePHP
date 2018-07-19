<?php
/**
 * Created by PhpStorm.
 * User: daixiaohan
 * Date: 2018/7/19
 * Time: 8:05
 */

// 集合测试类
require_once "BSTSET.php";

$bst = new BSTSET();
$bst->add(1);
$bst->add(1);
$bst->add(1);
$bst->add(2);
$bst->add(3);
$bst->add(4);
$bst->add(4);
print($bst->getSize());