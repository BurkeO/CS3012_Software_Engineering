<?php

include("BST.php");

   /*class LCA
   {
     function makeTree()
     {*/
       $Tree = new BST();
       $Tree->insert(50);
       $Tree->insert(30);
       $Tree->insert(20);
       $Tree->insert(40);
       $Tree->insert(70);
       $Tree->insert(60);
       $Tree->insert(80);

       $temp = $Tree->arrayInOrder();
       $temp = implode("\n", $temp);
       echo $temp;

       $Tree = new BST();
       $Tree->insert(10);
       $Tree->insert(20);
       $Tree->insert(30);
       $Tree->insert(40);
       $Tree->insert(50);
       $Tree->insert(60);

       $temp = $Tree->arrayInOrder();
       $temp = implode("\n", $temp);
       echo $temp;


     /*}
   }*/
?>
