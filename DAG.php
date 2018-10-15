<?php

  include("DagNode.php");


  class Dag
  {

    $NodeList;

    function __construct()
    {
      $NodeList = array();
    }

    function toString()
    {
      for ($i = 0; $i < sizeof($this->NodeList); $i++)
      {
        $this->NodeList[$i]->printNode();
      }
    }


  }


?>
