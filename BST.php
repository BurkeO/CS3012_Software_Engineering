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

     function arrayInOrder()
     {
       $treeTrav = array();
       $this->arrayInOrderRecurs($this->Root, $treeTrav);
       return $treeTrav;
     }

     function arrayInOrderRecurs($Root, &$treeTrav)
     {
       if ($Root != NULL)
       {
         $this->arrayInOrderRecurs($Root->left, $treeTrav);
         array_push($treeTrav, $Root->value);
         $this->arrayInOrderRecurs($Root->right, $treeTrav);
       }
     }


   }
?>
