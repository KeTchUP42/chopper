<?php
declare(strict_types = 1);

namespace TagParser;

use Chopper\TagParser\BaseTagParser;
use PHPUnit\Framework\TestCase;

/**
 * TagParserTest
 */
class TagParserTest extends TestCase
{
    public function testParseTagStruct()
    {
        $parser = new BaseTagParser('<div', '</div>');
        $result = $parser->parseTagStruct(file_get_contents(__DIR__.'/templates/page.html'));
        $actual = file_get_contents(__DIR__.'/templates/DivTagStruct.json');
        static::assertSame(json_encode($result), $actual);
    }
}
