<?php
/**
 * Created by PhpStorm.
 * User: tom
 * Date: 2018/8/8
 * Time: 15:50
 */

require_once "../Map/Map.php";
require_once "../FileOperation.php";

class Node
{
    public $key,$value = null;
    public $left,$right = null;
    public $height = 0;

    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
        $this->height = 1;
    }
}

class AVLTree implements Map
{
    public $root = null;
    public $size = 0;

    public function __construct()
    {
        $this->size = 0;
    }

    /**
     *  判断二叉树是否是一棵二分搜索树
     */
    public function isBST()
    {
        $this->inOrder($this->root,$keys);

        $lenght = count($keys);
        for ($i = 1; $i < $lenght; $i++) {
            if (strcmp($keys[$i-1], $keys[$i]) > 0)
                return -1;
        }
        return true;
    }

    /** 中序遍历
     * @param $node
     * @param $keys
     */
    private function inOrder($node, &$keys=array())
    {
        if ($node == null)
            return;
        $this->inOrder($node->left, $keys);
        $keys[] = $node->key;
        $this->inOrder($node->right, $keys);
    }

    /**
     *  判断该二叉树是否是一颗平衡二叉树
     */
    public function isBalanced()
    {
        return $this->__isBalanced($this->root);
    }

    /** 判断以node为根的二叉树是否是一颗平衡二叉树，递归算法
     * @param $node
     */
    private function __isBalanced($node)
    {
        if ($node == null)
            return true;
        $balanceFactor = $this->getBalanceFactor($node);
        if (abs($balanceFactor) > 1)
            return -1;
        return $this->__isBalanced($node->left) && $this->__isBalanced($node->right);
    }

    /** 获取节点node的平衡因子
     * @param $node
     */
    private function getBalanceFactor($node)
    {
        if ($node == null)
            return 0;
        return intval($this->getHeight($node->left) - $this->getHeight($node->right));
    }

    /** 获取节点node的高度
     * @param $node
     */
    private function getHeight($node)
    {
        if ($node == null)
            return 0;
        return $node->height;
    }

    public function add($key, $value)
    {
        // TODO: Implement add() method.
        $this->root = $this->__add($this->root, $key, $value);
    }

    private function __add($node, $key, $value)
    {
        if ($node == null) {
            $this->size += 1;
            return new Node($key, $value);
        }
        if ($key < $node->key) {
            $node->left = $this->__add($node->left, $key, $value);
        } elseif ($key > $node->key) {
            $node->right = $this->__add($node->right, $key, $value);
        }else
        {
            $node->value = $value;
        }

        // 更新height值
        $node->height = 1 + intval(max($this->getHeight($node->left), $this->getHeight($node->right)));
        // 计算平衡因子
        $balanceFactor = $this->getBalanceFactor($node);
        if (abs($balanceFactor) > 1)
            print("unbalanced：".$balanceFactor.PHP_EOL);
        // 平衡维护
        return $node;
    }

    /**
     *  对节点nodeY进行向右旋转操作，返回旋转后新的根节点x
      y                                 x
     / \                             /   \
      x   T4     向右旋转 (y)        z     y
     / \       - - - - - - - ->    / \   / \
     z   T3                       T1  T2 T3 T4
    /  \
    T1  T2
     * @param $y
     */
    private function rightRotate($y)
    {
        $x = $y->left;
        $T3 = $x->right;
        //  向右旋转
        $x->right = $y;
        $y->left = $T3;

        // 更新height值
        $y->height = max($this->getHeight($y->left), $this->getHeight($y->right)) + 1;

    }

    public function remove($key)
    {
        // TODO: Implement remove() method.
        $node = $this->getNode($this->root, $key);
        if($node != null)
        {
            $this->root = $this->__remove($this->root, $key);
            return $node;
        }
        return null;
    }

    public function contains($key)
    {
        // TODO: Implement contains() method.
        return $this->getNode($this->root, $key) != null;
    }

    public function get($key)
    {
        // TODO: Implement get() method.
        $node = $this->getNode($this->root, $key);
        return $node != null ? $node->value : null;
    }

    public function set($key, $value)
    {
        // TODO: Implement set() method.
        $node = $this->getNode($this->root, $key);
        if($node == null)
        {
            throw new Exception($key+" doesn't exist!");
        }
        $node->value = $value;
    }

    public function getSize()
    {
        // TODO: Implement getSize() method.
        return $this->size;
    }

    public function isEmpty()
    {
        // TODO: Implement isEmpty() method.
        return $this->size == 0;
    }

    public function getNode($node, $key)
    {
        if($node == null)
            return null;
        if($key == $node->key)
        {
            return $node;
        }
        if($key < $node->key){
            return $this->getNode($node->left, $key);
        }else
            return $this->getNode($node->right, $key);
    }

    // 寻找二分搜索树的最小元素
    public function minimum()
    {
        if($this->size == 0)
            throw new Exception("BST is empty.");
        return $this->__minimum($this->root)->key;
    }

    private function __minimum($node)
    {
        if($node->left == null)
            return $node;
        return $this->__minimum($node->left);
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

    // 删除以node为根的二分搜索树中值为e的节点，递归算法
    // 返回删除节点后新的二分搜索树的根
    private function __remove($node, $key)
    {
        if($node == null)
            return null;
        if($key < $node->key)
        {
            $node->left = $this->__remove($node->left, $key);
            return $node;
        }
        elseif ($key > $node->key)
        {
            $node->right = $this->__remove($node->right, $key);
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
}

$filepath = "../pride-and-prejudice.txt";
FileOperation::readFile($filepath, $words);
print(count($words).PHP_EOL);
$avl = new AVLTree();
foreach ($words as $word) {
    if ($avl->contains($word))
        $avl->set($word, $avl->get($word) + 1);
    else
        $avl->add($word, 1);
}
print("Total different words：".$avl->getSize().PHP_EOL);
print("Frequency of PRIDE：".$avl->get("pride").PHP_EOL);
print("Frequency of PREJUDICE：".$avl->get("prejudice").PHP_EOL);

print("is BST：".$avl->isBST().PHP_EOL);
print("is Balanced：".$avl->isBalanced().PHP_EOL);
