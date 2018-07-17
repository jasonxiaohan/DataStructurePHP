<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/15
 * Time: 16:59
 */

include 'ARRAY\LinkedListStack.php';
include 'ARRAY\LinkedList.php';

class BinaryNode
{
    public $e = null;
    public $left,$right = null;

    public function __construct($e)
    {
        $this->e = $e;
    }
}

/**
 * 二叉树[二分搜索树]
 * Class BinarySearchTree
 */
class BinarySearchTree
{
    public $root = null;
    public $size = 0;

    public function __construct()
    {
        $this->size = 0;
    }

    // 获取二分树的长度
    public function getSize()
    {
        return $this->size;
    }

    public function isEmpty()
    {
        return $this->size == 0;
    }

    // 向二分搜索树中添加元素e
    public function add($e)
    {
        $this->root = $this->__add($this->root, $e);
    }

    // 向node为根的二分搜索树中插入元素e，递归算法
    // 返回插入新节点后二分搜索树的根
    private function __add($node, $e)
    {
        if ($node == null) {
            $this->size += 1;
            return new BinaryNode($e);
        }

        if ($e < $node->e) {
            $node->left = $this->__add($node->left, $e);
        } elseif ($e > $node->e) {
            $node->right = $this->__add($node->right, $e);
        }
        return $node;
    }

    public function contains($e)
    {
        return $this->__contains($this->root, $e);
    }

    // 看以node为根的二分搜索树中是否包含元素e，递归算法
    private function __contains($node, $e)
    {
        if ($node == null)
            return false;
        if ($node->e == $e) {
            return true;
        } elseif ($e < $node->e) {
            return $this->__contains($node->left, $e);
        } else {
            return $this->__contains($node->right, $e);
        }
    }

    // 二分搜索树前序遍历
    public function preOrder()
    {
        $this->__preOrder($this->root);
    }

    // 前序遍历以node为根的二分搜索树，递归算法
    public function __preOrder($node)
    {
        if($node == null)
            return;
        print($node->e.PHP_EOL);
        $this->__preOrder($node->left);
        $this->__preOrder($node->right);
    }

    // 前序遍历以node为根的二分搜索树，非递归算法
    public function preOrderNR()
    {
       $stack = new \Home\Interfaces\LinkedListStack();
       $stack->push($this->root);
       while (!$stack->isEmpty())
       {
           $cur = $stack->pop();
           print $cur->e.PHP_EOL;
           if($cur->right != null)
                $stack->push($cur->right);
           if($cur->left != null)
                $stack->push($cur->left);
       }
    }

    /**
     *  二分搜索树的层序遍历
     */
    public function levelOrder()
    {
        $queue = new \Home\Interfaces\LinkedList();
        $queue->addFirst($this->root);
        while (!$queue->isEmpty())
        {
            $cur = $queue->removeFirst();
            print $cur->e.PHP_EOL;
            if($cur->left != null)
                $queue->addLast($cur->left);
            if($cur->right != null)
                $queue->addLast($cur->right);
        }
    }

    public function __toString()
    {
        $res = "";
        $this->generateBSTString($this->root, 0, $res);
        return $res;
    }

    // 生成以root为根节点，深度为depth的描述二叉树的字符串
    private function generateBSTString($node, $depth, &$res)
    {
        if($node == null)
        {
            $res .= $this->generateDepthString($depth)."null".PHP_EOL;
            return;
        }
        $res .= $this->generateDepthString($depth).$node->e.PHP_EOL;
        $this->generateBSTString($node->left, $depth+1,$res);
        $this->generateBSTString($node->right, $depth+1,$res);
    }

    private function generateDepthString($depth)
    {
        $res = "";
        for($i=0; $i < $depth; $i++){
            $res .="--";
        }
        return $res;
    }
}

$bst = new BinarySearchTree();
$nums = [5,3,6,8,4,2];
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
echo PHP_EOL;
//print($bst);
$bst->preOrderNR();
//print $bst;
print PHP_EOL;

$bst->levelOrder();
