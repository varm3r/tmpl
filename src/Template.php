<?php

namespace Tmpl;

use Tmpl\Exception\Exception as TmplException;
use Tmpl\Node\Node;

/**
 * Class Template
 * @package Tmpl
 */
class Template
{
    /**
     * @var string
     */
    private $text;

    /**
     * @var Node
     */
    private $rootNode;

    /**
     * Template constructor.
     * @param string $text
     * @throws TmplException
     */
    public function __construct(string $text)
    {
        $this->text = $text;
        $this->rootNode = (new Parser($text))->exec();
    }

    /**
     * @param array $data
     *
     * @return string
     */
    public function render(array $data): string
    {
        return $this->rootNode->render($data);
    }
}
