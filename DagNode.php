<?php
   class DagNode
   {
     var $key;
     var $value;
     var $AdjNodes;

     function __construct($key, $value)
     {
       $this->key = $key;
       $this->value = $value;
       $this->AdjNodes = array();
     }

     function pointTo($dagNode)
     {
       array_push($this->AdjNodes, $dagNode);
     }

     function setValue($newValue)
     {
       $this->value = $newValue;
     }

     function printNode()
     {
       print("Key = $this->key Value = $this->value\n");
       for ($i = 0; $i < sizeof($this->AdjNodes); $i++)
       {
         print("Adj Key = ".$this->AdjNodes[$i]->key." Val = ".$this->AdjNodes[$i]->value."\n");
       }
     }

     function isConnectedTo($key)
     {
       if($this->key == $key)
       {
         return TRUE;
       }
       for ($i = 0; $i < sizeof($this->AdjNodes); $i++)
       {
         if($this->AdjNodes[$i]->isConnectedTo($key) == TRUE)
          return TRUE;
       }
       return FALSE;
     }
   }

   $newNode = new DagNode("One", 1);
   $tempNode1 = new DagNode("Two", 2);
   $tempNode2 = new DagNode("Three", 3);
   $newNode->pointTo($tempNode1);
   $newNode->pointTo($tempNode2);

   $newNode->printNode();

   echo "\n\n";

   $isCon = $newNode->isConnectedTo("Two");
   print($isCon."\n");
   $isCon = $newNode->isConnectedTo("Three");
   print($isCon."\n");
   $isCon = $newNode->isConnectedTo("Four");
   print($isCon."\n");








?>
