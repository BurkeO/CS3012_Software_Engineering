<?php

  include("DagNode.php");


  class Dag
  {

    var $nodeList;

    function __construct()
    {
      $this->nodeList = array();
    }

    /*function toString() //prints each node in the graph and shows their adjacent nodes.
    {
      for ($i = 0; $i < sizeof($this->nodeList); $i++)
      {
        $this->nodeList[$i]->printNode();
        echo "\n";
      }
    }*/

    function addNode($key, $value) //adds a node to the graph node list, if there doesn't exist a node with the passed key already.
    {
      for($i = 0; $i < sizeof($this->nodeList); $i++)
      {
        if ($this->nodeList[$i]->key == $key)
        {
          $this->nodeList[$i]->setValue($value);
          return;
        }
      }
      $newNode = new DagNode($key, $value);
      array_push($this->nodeList, $newNode);
    }

    function addEdge($fromKey, $toKey)  //adds the corresponding node with the toKey to the adjacency list of the node with the
    {                                   //fromKey, representing an edge.
      for ($i = 0; $i < sizeof($this->nodeList); $i++)
      {
        if ($this->nodeList[$i]->key == $fromKey)
        {
          for ($j = 0; $j < sizeOf($this->nodeList); $j++)
          {

            if($this->nodeList[$j]->key == $toKey && $this->nodeList[$j]->isConnectedTo($fromKey) == FALSE)
            {
              //ispathfrom tokey to $fromKey
              $this->nodeList[$i]->pointTo($this->nodeList[$j]);
              break;
            }

            /*if($this->nodeList[$j]->key == $toKey && $this->nodeList[$j]->isConnectedTo($fromKey) == TRUE)
            {
              echo "Will create a cycle from \"$fromKey\" to \"$toKey\" - Edge not added\n\n";
            }*/

          }
          break;
        }
      }
    }


  }

  /*$newNode = new DagNode("One", 1);
  $tempNode1 = new DagNode("Two", 2);
  $tempNode2 = new DagNode("Three", 3);
  $newNode->pointTo($tempNode1);
  $tempNode1->pointTo($tempNode2);

  $newNode->printNode();

  echo "\n\n";

  $isCon = $newNode->isConnectedTo("Two");
  print($isCon."\n");
  $isCon = $newNode->isConnectedTo("Three");
  print($isCon."\n");
  $isCon = $newNode->isConnectedTo("Four");
  print($isCon."\n");

  echo "\n\n";*/

  /*$graph = new DAG();
  $graph->addNode("One", 1);
  $graph->addNode("Two", 2);
  $graph->addNode("Three", 3);

  $graph->addEdge("One", "Two");
  $graph->addEdge("Two", "Three");

  $graph->addEdge("Three", "One");

  $graph->addEdge("One","Three");

  $graph->addEdge("Three","Three");
  $graph->addEdge("Three", "Two");


  $graph->toString();*/


?>
