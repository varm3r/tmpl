<?php

namespace Varm3r\Tmpl\Node;

/**
 * Class NodeVariable
 * @package Varm3r\Tmpl\Node
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
