<?php

namespace Varm3r\Tmpl;

use Varm3r\Tmpl\Exception\Exception as TmplException;
use Varm3r\Tmpl\Node\Node;

/**
 * Class Template
 * @package Varm3r\Tmpl
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
