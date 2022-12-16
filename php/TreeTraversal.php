<?php
/**
 * Tree Traversal Problems
 *
 * We will assemble a tree and do a breadth first traversal
 * then we will do a depth first traversal
 *
 * @category InterviewQuestions
 * @package TreeTraversal
 * @author Michael Reeves <mike.reeves@gmail.com>
 *
 */

class Node
{
    private $_value;
    private $_leftNode;
    private $_rightNode;

    /**
     * @param $value int
     * @param Node $leftNode
     * @param Node $rightNode
     */
    public function __construct($value, Node $leftNode = null, Node $rightNode = null)
    {
        $this->_value     = $value;
        $this->_leftNode  = $leftNode;
        $this->_rightNode = $rightNode;
    }

    /**
     * @return array
     */
    public function getChildren()
    {
        return array($this->_leftNode, $this->_rightNode);
    }

    public function getValue()
    {
        return $this->_value;
    }

    public function getLeftNode()
    {
        return $this->_leftNode;
    }

    public function getRightNode()
    {
        return $this->_rightNode;
    }

    public function countChildren()
    {
        $children = $this->getChildren();
        $childCount = 0;
        foreach ($children as $child) {
            if ($child !== null) {
                $childCount++;
            }
        }
        return $childCount;
    }

    /**
     * Yes, this should be in its own class. This is just a toy example...
     *
     * @return Node
     */
    public static function getTestTree()
    {
        // Need to create child nodes first so we don't have to make a bunch of utility methods to add nodes as children
        // Level 4 nodes
        $level4Node1 = new Node(8);
        $level4Node2 = new Node(9);
        $level4Node3 = new Node(10);
        $level4Node4 = new Node(11);
        $level4Node5 = new Node(12);
        $level4Node6 = new Node(13);
        $level4Node7 = new Node(14);
        $level4Node8 = new Node(15);

        // Level 3 Nodes
        $level3Node1 = new Node(4, $level4Node1, $level4Node2);
        $level3Node2 = new Node(5, $level4Node3, $level4Node4);
        $level3Node3 = new Node(6, $level4Node5, $level4Node6);
        $level3Node4 = new Node(7, $level4Node7, $level4Node8);

        // Level 2 Nodes
        $level2Node1 = new Node(2, $level3Node1, $level3Node2);
        $level2Node2 = new Node(3, $level3Node3, $level3Node4);

        // Level 1 Root Node
        $level1Node1 = new Node(1, $level2Node1, $level2Node2);

        return $level1Node1;

    }


    /**
     * @return array $flatTree
     */
    public function traverseTreeBreadthwise()
    {
        $flatTree = array();
        $flatTree[] = $this->getValue();
        $children = $this->getChildren();
        while ($children) {
            $newChildren = array();
            foreach($children as $child) {
                if(!empty($child)) {
                    $flatTree[] = $child->getValue();
                    $newChildren = array_merge($newChildren, $child->getChildren());
                }
            }
            $children = $newChildren;
        }
        return $flatTree;
    }

    /**
     * @param array $flatTree
     * @return array
     */
    public function traverseTreeDepthwise($flatTree = array())
    {
        $flatTree[] = $this->getValue();

        $children = $this->getChildren();
        if ($this->countChildren() > 0) {
            foreach($children as $child) {
                if ($child !== null) {
                    $flatTree = $child->traverseTreeDepthwise($flatTree);
                }
            }
        }

        return $flatTree;
    }
}

$rootNode = Node::getTestTree();

echo '<h2>Tree Structure</h2>';
echo '<pre>'.var_export($rootNode, true).'</pre>';

echo '<h2>Tree Structure Traversed Breadthwise</h2>';
echo '<pre>'.var_export($rootNode->traverseTreeBreadthwise(), true).'</pre>';

echo '<h2>Tree Structure Traversed Depthwise</h2>';
echo '<pre>'.var_export($rootNode->traverseTreeDepthwise(), true).'</pre>';