<?php
/**
 * Created by PhpStorm.
 * User: daixiaohan
 * Date: 2018/8/2
 * Time: 11:13
 */

require_once "../FileOperation.php";
require_once "Trie.php";
require_once "../SET/BSTSET.php";

class TrieAndBSTSetTest
{
    /** 测试Trie
     * @param $data
     */
    public static function testTrie($data) {
        $trie = new Trie();
        $startTime = microtime(true);
        foreach($data as $val) {
           $trie->add($val);
        }
        foreach($data as $val) {
            $trie->contains($val);
        }
        $endTime = microtime(true);
        print("Total different words：".$trie->getSize().PHP_EOL);
        print("Trie：". round($endTime-$startTime, 3)." s ".PHP_EOL);
    }

    public static function testBstSET($data) {
        $set = new BSTSET();
        $startTime = microtime(true);
        foreach($data as $val) {
            $set->add($val);
        }
        foreach($data as $val) {
            $set->contains($val);
        }
        $endTime = microtime(true);
        print("Total different words：".$set->getSize().PHP_EOL);
        print("BSTSET：". round($endTime-$startTime, 3)." s ".PHP_EOL);
    }
}
$filepath = "../pride-and-prejudice.txt";
FileOperation::readFile($filepath, $words);
TrieAndBSTSetTest::testTrie($words);
TrieAndBSTSetTest::testBstSET($words);