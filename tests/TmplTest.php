<?php

namespace Tmpl\Test;

use Tmpl\Exception\TemplateErrorException;

/**
 * Class TmplTest
 * @package Test
 */
class TmplTest extends \Codeception\Test\Unit
{
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testVariable()
    {
        $text = '<h1>{title}</h1>';
        $tmpl = \Tmpl\Factory::createByText($text);

        $result = $tmpl->render(['title' => 'news']);
        $this->assertSame('<h1>news</h1>', $result);

        $result = $tmpl->render([]);
        $this->assertSame('<h1></h1>', $result);
    }

    public function testIfCondition()
    {
        $text = '{if userName}Hello {userName}!{/if}';
        $tmpl = \Tmpl\Factory::createByText($text);

        $result = $tmpl->render(['userName' => 'Adam']);
        $this->assertSame('Hello Adam!', $result);

        $result = $tmpl->render(['userName' => false]);
        $this->assertSame('', $result);
    }

    public function testIfElseCondition()
    {
        $text = 'result: {if bool}true{else}false{/if}';
        $tmpl = \Tmpl\Factory::createByText($text);

        $result = $tmpl->render([]);
        $this->assertSame('result: false', $result);

        $result = $tmpl->render(['bool' => false]);
        $this->assertSame('result: false', $result);

        $result = $tmpl->render(['bool' => true]);
        $this->assertSame('result: true', $result);
    }

    public function testIfElseNestedCondition()
    {
        $text =<<<TEXT
{if test1}
    {color1} {if test2}dog{else}cat{/if}
{else}
    {color2} {if test2}wolf{else}bird{/if}
{/if}
TEXT;
        $tmpl = \Tmpl\Factory::createByText($text);

        $result = $tmpl->render([
            'test1' => true,
            'test2' => false,
            'color1' => 'gray',
            'color2' => 'white',
        ]);
        $this->assertSame('
    gray cat
', $result);

        $result = $tmpl->render([
            'test1' => false,
            'test2' => true,
            'color1' => 'gray',
            'color2' => 'white',
        ]);
        $this->assertSame('
    white wolf
', $result);
    }

    public function testUnexpectedTemplateEnd()
    {
        $text =<<<TEXT
{if test1}
    {color1} {if test2}dog{else}cat{/if}
TEXT;
        try {
            $tmpl = \Tmpl\Factory::createByText($text);
            $tmpl->render([]);
            $this->assertTrue(false);
        } catch (TemplateErrorException $e) {
            $this->assertTrue(true);
        }
    }
}
