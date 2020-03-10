<?php

namespace Tmpl\Node;

/**
 * Interface NodeInterface
 * @package Tmpl\Node
 */
interface NodeInterface
{
    /**
     * @param array $data
     * @return string
     */
    public function render(array $data): string;
}
