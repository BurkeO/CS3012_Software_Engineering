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

    function getLCA($keyOne, $keyTwo)
    {
      for($i = 0; $i < sizeof($this->nodeList); $i++)
      {
        if($this->nodeList[$i]->isConnectedTo($keyOne) && $this->nodeList[$i]->isConnectedTo($keyTwo))
        {
            return $this->getLCA_Recurs($this->nodeList[$i], $keyOne, $keyTwo);
        }
      }
    }

    private function getLCA_Recurs($node, $keyOne, $keyTwo)
    {
      for ($i = 0; $i < sizeof($node->adjNodes); $i++)
      {
        if($node->adjNodes[$i]->isConnectedTo($keyOne) && $node->adjNodes[$i]->isConnectedTo($keyTwo))
        {
          return $this->getLCA_Recurs($node->adjNodes[$i], $keyOne, $keyTwo);
        }
      }
      return $node;
    }

  }

  /*$graph = new DAG();
  $graph->addNode("One", 1);
  $graph->addNode("Two", 2);
  $graph->addNode("Three", 3);
  $graph->addNode("Four", 4);
  $graph->addNode("Five", 5);
  $graph->addNode("Six", 6);
  $graph->addNode("Seven", 7);

  $graph->addEdge("One", "Two");
  $graph->addEdge("One", "Three");

  $graph->addEdge("Two","Four");
  $graph->addEdge("Two","Five");

  $graph->addEdge("Three","Six");
  $graph->addEdge("Three","Seven");

  $result = $graph->getLCA("Four", "Five");
  echo $result->key."\n";

  $result = $graph->getLCA("Four", "Six");
  echo $result->key."\n";

  $result = $graph->getLCA("Three", "Four");
  echo $result->key."\n";

  $result = $graph->getLCA("Two", "Four");
  echo $result->key."\n";*/

?>
