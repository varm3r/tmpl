<?php

namespace Tmpl\Node;

/**
 * Class NodeIf
 * @package Tmpl\Node
 */
class NodeIf extends Node
{
    /**
     * @var string
     */
    private $expr;

    /**
     * IfElseNode constructor.
     * @param string $expr
     */
    public function __construct(string $expr)
    {
        $this->expr = trim($expr);
    }

    /**
     * @param array $data
     * @return string
     */
    public function render(array $data): string
    {
        $nodeListIf = $nodeListElse = [];
        $nodeList = &$nodeListIf;
        foreach ($this->getChildren() as $node) {
            if ($node instanceof NodeElse) {
                $nodeList = &$nodeListElse;
            }
            $nodeList[] = $node;
        }

        // todo: create expression processor
        $expr = $data[$this->expr] ?? null;
        $nodeList = $expr ? $nodeListIf : $nodeListElse;

        return array_reduce($nodeList, function(string $carry, NodeInterface $item) use ($data) {
            return $carry . $item->render($data);
        }, '');
    }
}
