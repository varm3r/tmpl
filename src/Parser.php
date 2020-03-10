<?php

namespace Varm3r\Tmpl;

use Varm3r\Tmpl\Exception\TemplateErrorException;
use Varm3r\Tmpl\Node\NodeElse;
use Varm3r\Tmpl\Node\NodeIf;
use Varm3r\Tmpl\Node\Node;
use Varm3r\Tmpl\Node\NodeText;
use Varm3r\Tmpl\Node\NodeVariable;

/**
 * Class TemplateParser
 * @package Varm3r\Tmpl
 */
class Parser
{
    /** @var string */
    private $text;

    /**
     * Template constructor.
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    /**
     * @return Node
     * @throws TemplateErrorException
     */
    public function exec(): Node
    {
        $rootNode = new Node();
        $processNodeStack = [$rootNode];

        $sectionList = preg_split('~({if \w+}|{else}|{/if}|{\w+})~siu', $this->text, -1, PREG_SPLIT_DELIM_CAPTURE) ?: [];
        foreach ($sectionList as $section) {
            // get last node from stack
            $lastNode = end($processNodeStack);
            // close last if-node
            if ($lastNode instanceof NodeIf && $section === '{/if}') {
                array_pop($processNodeStack);
                continue;
            }
            if (preg_match('~^{if\s+(?P<expr>\w+)}$~siu', $section, $matches)) {
                $node = new NodeIf($matches['expr']);
                $processNodeStack[] = $node;
            } elseif (preg_match('~^{else}$~siu', $section, $matches)) {
                $node = new NodeElse();
            } elseif (preg_match('~^{(?P<var>\w+)}$~siu', $section, $matches)) {
                $node = new NodeVariable($matches['var']);
            } else {
                $node = new NodeText($section);
            }
            $lastNode->addChild($node);
        }

        if (count($processNodeStack) > 1) {
            throw new TemplateErrorException('Incorrect template');
        }

        return $rootNode;
    }
}
