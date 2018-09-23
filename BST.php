<?php

include("Node.php");

   class BST
   {
     var $Root;

     function __construct() //Creates root of binary tree.
     {
       $this->Root = NULL;
     }

     function insert($newValue) //Insert new value to tree. Recursively travels down tree in insertRecurs.
     {
       $this->Root = $this->insertRecurs($this->Root, $newValue);
     }

     private function insertRecurs($node, $newValue)  //Travels down tree to find position to insert new value.
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

     function arrayInOrder()  //Returns an array of nodes that represent the tree in InOrder traversal.
     {
       $treeTrav = array();
       $this->arrayInOrderRecurs($this->Root, $treeTrav);
       return $treeTrav;
     }

     private function arrayInOrderRecurs($node, &$treeTrav) //Recursively traverses tree InOrder.
     {
       if ($node != NULL)
       {
         $this->arrayInOrderRecurs($node->left, $treeTrav);
         array_push($treeTrav, $node->value);
         $this->arrayInOrderRecurs($node->right, $treeTrav);
       }
     }

     function search($value)  //Returns the node that matches the value the caller wishes to find in the tree.
     {
       $desiredNode = $this->searchRecurs($this->Root, $value);
       return $desiredNode;
     }

     private function searchRecurs($node, $value) //Travels down tree comparing values in nodes to find the desired node. Returns NULL if not found.
     {                                      //Else returns the node that matches the desired value.
       if ($node->value == $value)
       {
         return $node;
       }
       if ($value < $node->value)
       {
         if ($node->left == NULL)
         {
           return NULL;
         }
         return $this->searchRecurs($node->left, $value);
       }
       else if ($value > $node->value)
       {
         if ($node->right == NULL)
         {
           return NULL;
         }
         return $this->searchRecurs($node->right, $value);
       }
     }



     function getLCA()
     {

     }


   }
?>
