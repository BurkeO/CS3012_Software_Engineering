<?php
use PHPUnit\Framework\TestCase;
//include("Node.php");
include("BST.php");

class LCA_Test extends TestCase
{
    public function testNodeClass()
    {
        $testNode = new Node(4);
        $this->assertEquals(4, $testNode->value); //Testing Node constructor

        $tempLeftNode = new Node(5);
        $testNode->left = $tempLeftNode;
        $tempRightNode = new Node(10);
        $testNode->right = $tempRightNode;
        $this->assertEquals($tempLeftNode, $testNode->left);
        $this->assertEquals($tempRightNode, $testNode->right);
        $this->assertEquals(5, $testNode->left->value);
        $this->assertEquals(10, $testNode->right->value); //Testing creation of child nodes

        $newLeftNode = new Node(15);
        $testNode->left = $newLeftNode;
        $this->assertEquals(15, $testNode->left->value);
        $this->assertEquals($newLeftNode, $testNode->left); //Testing overwrite of child node
    }

    public function testBstClass()
    {
      $Tree = new BST();
      $Tree->insert(50);
      $Tree->insert(30);
      $Tree->insert(20);
      $Tree->insert(40);
      $Tree->insert(70);
      $Tree->insert(60);
      $Tree->insert(80);

      //$Tree->arrayInOrder();
      $this->assertEquals("20\n30\n40\n50\n60\n70\n80", implode("\n", $Tree->arrayInOrder()));
    }
}
?>
