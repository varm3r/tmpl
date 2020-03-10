<?php

namespace Tmpl\Node;

/**
 * Class Node
 * @package Tmpl\Node
 */
class Node implements NodeInterface
{
    /**
     * @var NodeInterface[]
     */
    private $children = [];

    /**
     * @param NodeInterface $node
     */
    public function addChild(NodeInterface $node)
    {
        $this->children[] = $node;
    }

    /**
     * @return NodeInterface[]
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @param array $data
     *
     * @return string
     */
    public function render(array $data): string
    {
        return array_reduce($this->children, function(string $carry, NodeInterface $item) use ($data) {
            return $carry . $item->render($data);
        }, '');
    }
}
