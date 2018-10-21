<?php
   class DagNode
   {
     var $key;
     var $value;
     var $adjNodes;

     function __construct($key, $value)
     {
       $this->key = $key;
       $this->value = $value;
       $this->adjNodes = array();
     }

     function pointTo($dagNode) //adds the passed node to the adjacency array, representing a directed edge to the passed node.
     {
       array_push($this->adjNodes, $dagNode);
     }

     function setValue($newValue) //updates the value in a node. This is called if a node is added with a key that already exists in the graph.
     {                            //in which case, the node with that key is updated with the value of the node trying to be added.
       $this->value = $newValue;
     }

     /*function printNode() //prints the information of a node and shows its adjacent nodes.
     {
       print("Key = \"$this->key\" Value = $this->value\n");
       for ($i = 0; $i < sizeof($this->adjNodes); $i++)
       {
         print("Adj : Key = \"".$this->adjNodes[$i]->key."\" | Val = ".$this->adjNodes[$i]->value."\n");
       }
     }*/

     function isConnectedTo($key) //recursively goes through the adjacency array of a node's adjacent nodes to find a node with
     {                            //the passed key, in which case, a path exists between the two nodes.
       if($this->key == $key)
       {
         return TRUE;
       }
       for ($i = 0; $i < sizeof($this->adjNodes); $i++)
       {
         if($this->adjNodes[$i]->isConnectedTo($key) == TRUE)
          return TRUE;
       }
       return FALSE;
     }
   }

   /*$newNode = new DagNode("One", 1);
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
   print($isCon."\n");*/








?>
