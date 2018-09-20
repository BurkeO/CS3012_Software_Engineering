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
       $this->Root = insertRecurs($this->Root, $newValue);
     }

     function insertRecurs($Root, $newValue)
     {
       if ($Root == NULL)
       {
         $Root = new Node($newValue);
         return $Root;
       }
       if ($newValue < $Root->value)
       {
         $Root->left = insertRecurs($Root->left, $newValue);
       }
       else if ($newValue > $Root->value)
       {
         $Root->right = insertRecurs($Root->right, $newValue);
       }
       return $Root;
     }

     function printInOrder()
     {
       printInOrderRecurs($this->Root);
     }

     function printInOrderRecurs($Root)
     {
       if ($Root != NULL)
       {
         printInOrderRecurs($Root->left);
         print("$Root\n");
         printInOrderRecurs($Root->right);
       }
     }


   }
?>
