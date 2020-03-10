<?php

namespace Tmpl\Test;

use Tmpl\Exception\FileNotFoundException;

/**
 * Class TmplFactoryTest
 * @package Tmpl\Test
 */
class TmplFactoryTest extends \Codeception\Test\Unit
{
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testCreateByText()
    {
        $text = '<h1>{title}</h1>';
        $tmpl = \Tmpl\Factory::createByText($text);

        $result = $tmpl->render(['title' => 'WOW!']);
        $this->assertSame('<h1>WOW!</h1>', $result);
    }

    public function testCreateByWrongFilepath()
    {
        try {
            $filepath = 'path/to/file';
            $tmpl = \Tmpl\Factory::create($filepath);

            $result = $tmpl->render(['title' => 'WOW!']);
            $this->assertTrue(false);
        } catch (FileNotFoundException $e) {
            $this->assertTrue(true);
        }
    }

    public function testCreateByRealFilepath()
    {
        $filepath = __DIR__.'/_data/example.tpl';
        $tmpl = \Tmpl\Factory::create($filepath);

        $result = $tmpl->render(['header' => 'WOW!', 'test' => true]);
        $expected =<<<TEXT
<h1>WOW!</h1>

bla-bla-bla

TEXT;

        $this->assertSame($expected, $result);
    }
}
