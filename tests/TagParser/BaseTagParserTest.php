<?php
declare(strict_types = 1);

namespace App\Tests\TagParser;

use App\TagParser\BaseTagParser;
use PHPUnit\Framework\TestCase;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * BaseTagParserTest
 */
class BaseTagParserTest extends TestCase
{
    private $tagParser;

    private $pageTemplate;

    private $divDepthLvl3;

    private $divTagStruct;

    public function testParseTagStruct(): void
    {
        $result = $this->tagParser->parseTagStruct($this->pageTemplate);
        static::assertSame(json_encode($result), $this->divTagStruct);
    }

    public function testParseDepthLvl(): void
    {
        $result = $this->tagParser->parseDepthLvl($this->pageTemplate, 3);
        static::assertSame(json_encode($result), $this->divDepthLvl3);
    }

    protected function setUp(): void
    {
        $this->tagParser    = new BaseTagParser('<dIV', '</DiV>');
        $this->pageTemplate = file_get_contents(__DIR__.'/Templates/PageTemplate.txt');
        $this->divDepthLvl3  = file_get_contents(__DIR__.'/Templates/DivDepthLvl3.json');
        $this->divTagStruct = file_get_contents(__DIR__.'/Templates/DivTagStruct.json');
    }
}
