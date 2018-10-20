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
       if (is_int($newValue) == FALSE)
       {
         //echo "Invalid type - must be int\n";
         return;
       }
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
       if (is_int($value) == FALSE)
       {
         //echo "Invalid type - must be int\n";
         return NULL;
       }
       if ($this->Root == NULL)
       {
         return NULL;
       }
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

     function getLCA($valOne, $valTwo)  //Returns the LCA (lowest common ancestor) in the tree for the two values provided.
     {                                  //LCA = The deepest node that has X and Y as descendants (a node can be a descendant of itself).
       if (is_int($valOne) == FALSE || is_int($valTwo) == FALSE)
       {
         //echo "Invalid type - must be int\n";
         return NULL;
       }
       if (($this->search($valOne)) == NULL || ($this->search($valTwo)) == NULL)
       {
         return NULL;
       }
       else
       {
         return $this->getLCA_Recurs($this->Root, $valOne, $valTwo);
       }
     }

     private function getLCA_Recurs($node, $valOne, $valTwo) //LCA = the node at which the paths diverge (including if one path stops).
     {
       if ($node->value > $valOne && $node->value > $valTwo)
       {
         return $this->getLCA_Recurs($node->left, $valOne, $valTwo);
       }
       else if ($node->value < $valOne && $node->value < $valTwo)
       {
         return $this->getLCA_Recurs($node->right, $valOne, $valTwo);
       }
       else
       {
         return $node;
       }
     }
   }
?>
