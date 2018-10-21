<?php
use PHPUnit\Framework\TestCase;
include("BST.php");
include("DAG.php");

class LCA_Test extends TestCase
{
    public function testNodeClass()
    {
        $testNode = new Node(4);
        $this->assertEquals(4, $testNode->value); //Testing Node constructor.

        $tempLeftNode = new Node(5);
        $testNode->left = $tempLeftNode;
        $tempRightNode = new Node(10);
        $testNode->right = $tempRightNode;
        $this->assertEquals($tempLeftNode, $testNode->left);
        $this->assertEquals($tempRightNode, $testNode->right);
        $this->assertEquals(5, $testNode->left->value);
        $this->assertEquals(10, $testNode->right->value); //Testing creation of child nodes.

        $newLeftNode = new Node(15);
        $testNode->left = $newLeftNode;
        $this->assertEquals(15, $testNode->left->value);
        $this->assertEquals($newLeftNode, $testNode->left); //Testing overwrite of child node.
    }

    public function testBstClass() //Tests correct creation/addition of nodes to tree using inOrder traversal.
    {
      $Tree = new BST();
      $Tree->insert(50);
      $Tree->insert(30);
      $Tree->insert("Invalid type"); //Testing insertion of invalid types - must be int.
      $Tree->insert(20);
      $Tree->insert(40);
      $Tree->insert(70);
      $Tree->insert(60);
      $Tree->insert(80);
      $this->assertEquals("20\n30\n40\n50\n60\n70\n80", implode("\n", $Tree->arrayInOrder())); //Tests generic, balanced tree.

      $Tree = new BST();
      $Tree->insert(10);
      $Tree->insert(20);
      $Tree->insert(30);
      $Tree->insert(40);
      $Tree->insert('c'); //Testing insertion of invalid types - must be int.
      $Tree->insert(50);
      $Tree->insert(60);
      $this->assertEquals("10\n20\n30\n40\n50\n60", implode("\n", $Tree->arrayInOrder())); //Tests tree with all nodes going to the right.

      $Tree = new BST();
      $Tree->insert(-5);
      $Tree->insert(10);
      $Tree->insert(-10);
      $Tree->insert(56.789); //Testing insertion of invalid types - must be int.
      $Tree->insert(-5);
      $this->assertEquals("-10\n-5\n10", implode("\n", $Tree->arrayInOrder())); //Tests tree with negative nodes and addition of already present nodes.
    }

    public function testBstSearch() //Tests the search method to return the node that matches the value the caller provides.
    {                               //If not found returns NULL.
      $Tree = new BST();
      $Tree->insert(50);
      $Tree->insert(30);
      $Tree->insert(20);
      $Tree->insert(40);
      $Tree->insert(70);
      $Tree->insert(60);
      $Tree->insert(80);
      $this->assertEquals(20, ($Tree->search(20))->value);

      $this->assertEquals(NULL, $Tree->search("Invalid type")); //Testing search for invalid types - must be int.

      $this->assertEquals(NULL, $Tree->search(87.456)); //Testing search for invalid types - must be int.

      $this->assertEquals(30, ($Tree->search(30))->value);

      $this->assertEquals(80, ($Tree->search(80))->value);

      $this->assertEquals(NULL, $Tree->search(-10));

      $this->assertEquals(NULL, $Tree->search(90));
    }

    public function testBstLCA()  //Tests the LCA (lowest common ancestor) function in the BST class.
    {                             //LCA = The deepest node that has X and Y as descendants (a node can be a descendant of itself).
      $Tree = new BST();
      $Tree->insert(50);
      $Tree->insert(30);
      $Tree->insert(20);
      $Tree->insert(40);
      $Tree->insert(70);
      $Tree->insert(60);
      $Tree->insert(80);

      $this->assertEquals(NULL, $Tree->getLCA(-10, 30));

      $this->assertEquals(NULL, $Tree->getLCA(20, 35));

      $this->assertEquals(NULL, $Tree->getLCA("Invalid", 35));  //Test LCA with invalid type.

      $this->assertEquals(NULL, $Tree->getLCA(20, "Invalid")); //Test LCA with invalid type.

      $this->assertEquals(NULL, $Tree->getLCA(89.456, 35)); //Test LCA with invalid type.

      $this->assertEquals(30, ($Tree->getLCA(20, 40))->value);

      $this->assertEquals(50, ($Tree->getLCA(20, 70))->value);

      $this->assertEquals(70, ($Tree->getLCA(60, 80))->value);

      $this->assertEquals(50, ($Tree->getLCA(70, 20))->value);

      $this->assertEquals(30, ($Tree->getLCA(20, 30))->value);

      $this->assertEquals(70, ($Tree->getLCA(70, 80))->value);
    }

    public function testEmptyTree()   //Tests functions that would otherwise encounter an error for an empty tree.
    {
      $Tree = new BST();
      $this->assertEquals(NULL, $Tree->getLCA(-10, 30));

      $this->assertEquals(NULL, $Tree->search(10));
    }

    /***************************************TESTS FOR DIRECTED ACYCLIC GRAPH****************************/

    public function testDAGNodeClass() //tests DagNode construction and its functions.
    {
      $newNode = new DagNode("One", 1);

      $this->assertEquals("One", $newNode->key);  //tests key and value fields.
      $this->assertEquals(1, $newNode->value);

      $tempNode1 = new DagNode("Two", 2);
      $tempNode2 = new DagNode("Three", 3);
      $newNode->pointTo($tempNode1);
      $tempNode1->pointTo($tempNode2);

      $testArray = array($tempNode1);
      $this->assertEquals($testArray, $newNode->adjNodes);  //tests the adding of adjacent nodes to a given node.

      $newNode->setValue(100);
      $this->assertEquals(100, $newNode->value);  //tests the setValue function.

      $this->assertEquals(TRUE, $newNode->isConnectedTo("Two"));  //tests the recursive function to check if nodes are connected.
      $this->assertEquals(TRUE, $newNode->isConnectedTo("Three"));  //this function is needed later in order to prevent the creation
      $this->assertEquals(FALSE, $tempNode2->isConnectedTo("One")); //of cycles.
      $this->assertEquals(TRUE, $newNode->isConnectedTo("One"));

    }

    public function testDAG_addNode() //tests the addition of nodes into the graph.
    {
      $graph = new DAG();
      $graph->addNode("One", 1);
      $graph->addNode("Two", 2);
      $graph->addNode("Three", 3);
      $this->assertEquals("One", $graph->nodeList[0]->key);
      $this->assertEquals("Two", $graph->nodeList[1]->key);
      $this->assertEquals("Three", $graph->nodeList[2]->key);

      $this->assertEquals(2, $graph->nodeList[1]->value);
      $graph->addNode("Two", 100);
      $this->assertEquals(100, $graph->nodeList[1]->value); //tests that the value for the already existing node is overwritten.
    }

    public function testDAG_addEdge() //tests the creation of edges between nodes and that no cycles are created.
    {
      $graph = new DAG();
      $graph->addNode("One", 1);
      $graph->addNode("Two", 2);
      $graph->addNode("Three", 3);

      $graph->addEdge("One", "Two");
      $graph->addEdge("Two", "Three");

      $graph->addEdge("Three", "One"); //won't be added - will create cycle

      $graph->addEdge("One","Three");

      $graph->addEdge("Three","Three"); //won't be added - will create cycle
      $graph->addEdge("Three", "Two"); //won't be added - will create cycle

      $this->assertEquals(2,sizeof($graph->nodeList[0]->adjNodes));
      $this->assertEquals("Two",$graph->nodeList[0]->adjNodes[0]->key);
      $this->assertEquals("Three",$graph->nodeList[0]->adjNodes[1]->key);

      $this->assertEquals(1,sizeof($graph->nodeList[1]->adjNodes));
      $this->assertEquals("Three",$graph->nodeList[1]->adjNodes[0]->key);

      $this->assertEquals(0,sizeof($graph->nodeList[2]->adjNodes));

    }

    public function testDAG_LCA() //Tests the LCA (lowest common ancestor) function in the DAG class.
    {                             //LCA = The deepest node that has X and Y as descendants (a node can be a descendant of itself).
      $graph = new DAG();
      $graph->addNode("G", 1);
      $graph->addNode("D", 2);
      $graph->addNode("F", 3);
      $graph->addNode("C", 4);
      $graph->addNode("E", 5);
      $graph->addNode("B", 6);
      $graph->addNode("A", 7);

      $graph->addEdge("G", "D");
      $graph->addEdge("G", "F");

      $graph->addEdge("D","C");
      $graph->addEdge("F","E");

      $graph->addEdge("C","B");
      $graph->addEdge("E","B");

      $graph->addEdge("B","A");

      $result = $graph->getLCA("D", "F");
      $this->assertEquals("G", $result->key);

      $result = $graph->getLCA("E", "G");
      $this->assertEquals("G", $result->key);

      $result = $graph->getLCA("B", "F");
      $this->assertEquals("F", $result->key);

      $result = $graph->getLCA("C", "E");
      $this->assertEquals("G", $result->key);

      $graph = new DAG();  //The following tests represent a DAG in the form of a binary tree.
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
      $this->assertEquals("Two", $result->key);

      $result = $graph->getLCA("Four", "Six");
      $this->assertEquals("One", $result->key);

      $result = $graph->getLCA("Three", "Four");
      $this->assertEquals("One", $result->key);

      $result = $graph->getLCA("Two", "Four");
      $this->assertEquals("Two", $result->key);

      $result = $graph->getLCA("Six", "Seven");
      $this->assertEquals("Three", $result->key);
    }

    public function testEmptyGraph()   //Tests functions that would otherwise encounter an error for an empty graph.
    {
      $graph = new DAG();
      $this->assertEquals(NULL, $graph->getLCA("X","Y"));
    }

}
?>
