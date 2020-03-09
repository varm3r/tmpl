<?php

namespace Varm3r\Tmpl\Node;

/**
 * Interface NodeInterface
 * @package Varm3r\Tmpl\Node
 */
interface NodeInterface
{
    /**
     * @param array $data
     * @return string
     */
    public function render(array $data): string;
}
