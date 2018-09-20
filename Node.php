<?php
   class Node
   {
     var $value;
     var $left, $right;

     function __construct($value)
     {
       $this->value = $value;
       $this->left = NULL;
       $this->right = NULL;
     }
   }
?>
