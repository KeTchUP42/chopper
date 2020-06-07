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
    private $tagParser;

    private $divTagStruct;

    private $pageTemplate;

    public function testParseTagStruct()
    {
        $result = $this->tagParser->parseTagStruct($this->pageTemplate);
        static::assertSame(json_encode($result), $this->divTagStruct);
    }

    protected function setUp(): void
    {
        $this->tagParser    = new BaseTagParser('<div', '</div>');
        $this->pageTemplate = file_get_contents(__DIR__.'/Templates/PageTemplate.txt');
        $this->divTagStruct = file_get_contents(__DIR__.'/Templates/DivTagStruct.json');
    }
}
