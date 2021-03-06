<?php

namespace Tmpl;

use Tmpl\Exception\Exception as TmplException;
use Tmpl\Exception\FileNotFoundException;

/**
 * Class Factory
 * @package Tmpl
 */
final class Factory
{
    /**
     * Create template by filepath
     *
     * @param string $path filepath
     *
     * @return Template
     *
     * @throws FileNotFoundException
     * @throws TmplException
     */
    public static function create(string $path): Template
    {
        if (!is_file($path) || !is_readable($path)) {
            throw new FileNotFoundException(sprintf('File %s not found', $path));
        }
        $text = file_get_contents($path);

        return self::createByText($text);
    }

    /**
     * Create template by text
     *
     * @param string $text template text
     *
     * @return Template
     * @throws TmplException
     */
    public static function createByText(string $text): Template
    {
        return new Template($text);
    }
}
