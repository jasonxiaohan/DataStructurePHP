<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/15
 * Time: 16:59
 */

require_once '../ARRAY/LinkedListStack.php';
require_once '../ARRAY/LinkedList.php';

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
     *  二分搜索树的层序遍历(广度优先遍历)
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

    // 寻找二分搜索树的最小元素
    public function minimum()
    {
       if($this->size == 0)
           throw new Exception("BST is empty.");
       return $this->__minimum($this->root)->e;
    }

    private function __minimum($node)
    {
        if($node->left == null)
            return $node;
        return $this->__minimum($node->left);
    }

    // 寻找二分搜索树的最大元素(返回以node为根的二分搜索树的最大值所在的节点)
    public function maximum()
    {
        return $this->__maximum($this->root)->e;
    }

    private function __maximum($node)
    {
        if($this->size == 0)
            throw new Exception("BST is empty.");
        if($node->right == null)
            return $node;
        return $this->__maximum($node->right);
    }

    // 从二分搜索树中删除最小值所在节点，返回最小值
    public function removeMin()
    {
        $e = $this->minimum();
        $this->root = $this->__removeMin($this->root);
        return $e;
    }

    // 删除以node为根的二分搜索树中的最小节点
    // 返回删除节点后新的二分搜索树的根
    private function __removeMin($node)
    {
        if($node->left == null)
        {
            $rightNode = $node->right;
            $node->right = null;
            $this->size -= 1;
            return $rightNode;
        }
        $node->left = $this->__removeMin($node->left);
        return $node;
    }

    // 删除以node为根的二分搜索树中的最大节点
    // 返回删除节点后的二分搜索树的根
    public function removeMax()
    {
        $e = $this->maximum();
        $this->root = $this->__removeMax($this->root);
        return $e;
    }

    private function __removeMax($node)
    {
        if($node->right == null)
        {
            $leftNode = $node->left;
            $node->left = null;
            $this->size -= 1;
            return $leftNode;
        }
        $node->right = $this->__removeMax($node->right);
        return $node;
    }

    // 从二分搜索树中删除元素为e的节点
    public function remove($e)
    {
        $this->root = $this->__remove($this->root, $e);
    }

    // 删除以node为根的二分搜索树中值为e的节点，递归算法
    // 返回删除节点后新的二分搜索树的根
    private function __remove($node, $e)
    {
        if($node == null)
            return null;
        if($e < $node->e)
        {
            $node->left = $this->__remove($node->left, $e);
            return $node;
        }
        elseif ($e > $node->e)
        {
            $node->right = $this->__remove($node->right, $e);
            return $node;
        }
        else {
            // 待删除节点左子树为空的情况
            if($node->left == null)
            {
                $nodeRight = $node->right;
                $node->right = null;
                $this->size -= 1;
                return $nodeRight;
            }
            // 待删除节点右子树为空的情况
            if($node->right == null)
            {
                $nodeLeft = $node->left;
                $this->size -= 1;
                $node->left = null;
                return $nodeLeft;
            }

            // 待删除节点左右子树均不为空的情况

            // 找到比待删除节点大的最小节点, 即待删除节点右子树的最小节点
            // 用这个节点顶替待删除节点的位置

            $successor = $this->__minimum($node->right);
            $successor->right = $this->__removeMin($node->right);
            $successor->left = $node->left;
            $node->right = $node->left = null;
            return $successor;
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
echo PHP_EOL;
print($bst);
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
$bst->remove(58);
print $bst;