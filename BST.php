<?php

include("Node.php");

   class BST
   {
     var $Root;

     function __construct()
     {
       $this->Root = NULL;
     }

     function insert($newValue)
     {
       $this->Root = $this->insertRecurs($this->Root, $newValue);
     }

     function insertRecurs($node, $newValue)
     {
       if ($node == NULL)
       {
         $node = new Node($newValue);
         return $node;
       }
       if ($newValue < $node->value)
       {
         $node->left = $this->insertRecurs($node->left, $newValue);
       }
       else if ($newValue > $node->value)
       {
         $node->right = $this->insertRecurs($node->right, $newValue);
       }
       return $node;
     }

     function printInOrder()
     {
       $this->printInOrderRecurs($this->Root);
     }

     function printInOrderRecurs($Root)
     {
       if ($Root != NULL)
       {
         $this->printInOrderRecurs($Root->left);
         print("$Root->value\n");
         $this->printInOrderRecurs($Root->right);
       }
     }


   }
?>
