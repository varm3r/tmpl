<?php

namespace Varm3r\Tmpl\Node;

/**
 * Class NodeText
 * @package Varm3r\Tmpl\Node
 */
class NodeText extends Node
{
    /**
     * @var string
     */
    private $text;

    /**
     * TextNode constructor.
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    /**
     * @param array $data
     * @return string
     */
    public function render(array $data): string
    {
        return $this->text;
    }
}
