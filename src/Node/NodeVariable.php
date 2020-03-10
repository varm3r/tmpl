<?php

namespace Tmpl\Node;

/**
 * Class NodeVariable
 * @package Tmpl\Node
 */
class NodeVariable implements NodeInterface
{
    /**
     * @var string
     */
    private $var;

    /**
     * VariableNode constructor.
     * @param string $var
     */
    public function __construct(string $var)
    {
        $this->var = trim($var);
    }

    /**
     * @param array $data
     * @return string
     */
    public function render(array $data): string
    {
        return $data[$this->var] ?? '';
    }
}
