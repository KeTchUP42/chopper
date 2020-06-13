<?php
declare(strict_types = 1);

namespace TagParser;

use Chopper\TagParser\FastTagParser;
use PHPUnit\Framework\TestCase;

/**
 * FastTagParserTest
 */
class FastTagParserTest extends TestCase
{
    private $tagParser;

    private $pageTemplate;

    private $divDeepLvl3;

    private $divTagStruct;

    public function testParseTagStruct(): void
    {
        $result = $this->tagParser->parseTagStruct($this->pageTemplate);
        static::assertSame(json_encode($result), $this->divTagStruct);
    }

    public function testParseDeepLvl(): void
    {
        $result = $this->tagParser->parseDeepLvl($this->pageTemplate, 3);
        static::assertSame(json_encode($result), $this->divDeepLvl3);
    }

    protected function setUp(): void
    {
        $this->tagParser    = new FastTagParser('<div', '</div>');
        $this->pageTemplate = file_get_contents(__DIR__.'/Templates/PageTemplate.txt');
        $this->divDeepLvl3  = file_get_contents(__DIR__.'/Templates/DivDeepLvl_3.json');
        $this->divTagStruct = file_get_contents(__DIR__.'/Templates/DivTagStruct.json');
    }
}
