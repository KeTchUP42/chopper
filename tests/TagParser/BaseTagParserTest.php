<?php
declare(strict_types = 1);

namespace TagParser;

use Chopper\TagParser\BaseTagParser;
use PHPUnit\Framework\TestCase;

/**
 * BaseTagParserTest
 */
class BaseTagParserTest extends TestCase
{
    public function testParseDeepLvlNoCase()
    {
        $parser = new BaseTagParser('<diV', '</DiV>');
        $result = $parser->parseDeepLvlNoCase(file_get_contents(__DIR__.'/templates/page.html'), 6);
        $actual = file_get_contents(__DIR__.'/templates/DivDeepLvlNoCase_6.json');
        static::assertSame(json_encode($result), $actual);
    }

    public function testParseDeepLvl()
    {
        $parser = new BaseTagParser('<div', '</div>');
        $result = $parser->parseDeepLvl(file_get_contents(__DIR__.'/templates/page.html'), 3);
        $actual = file_get_contents(__DIR__.'/templates/DivDeepLvl_3.json');
        static::assertSame(json_encode($result), $actual);
    }
}
