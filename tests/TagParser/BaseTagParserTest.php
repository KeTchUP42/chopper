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
    private $baseTagParserStandard;

    private $baseTagParserNotStandard;

    private $pageTemplate;

    private $divDeepLvlNoCase6;

    private $divDeepLvl3;

    public function testParseDeepLvlNoCase()
    {
        $result = $this->baseTagParserNotStandard->parseDeepLvlNoCase($this->pageTemplate, 6);
        static::assertSame(json_encode($result), $this->divDeepLvlNoCase6);
    }

    public function testParseDeepLvl()
    {
        $result = $this->baseTagParserStandard->parseDeepLvl($this->pageTemplate, 3);
        static::assertSame(json_encode($result), $this->divDeepLvl3);
    }

    protected function setUp(): void
    {
        $this->baseTagParserStandard    = new BaseTagParser('<div', '</div>');
        $this->baseTagParserNotStandard = new BaseTagParser('<diV', '</DiV>');
        $this->pageTemplate             = file_get_contents(__DIR__.'/Templates/PageTemplate.txt');
        $this->divDeepLvlNoCase6        = file_get_contents(__DIR__.'/Templates/DivDeepLvlNoCase_6.json');
        $this->divDeepLvl3              = file_get_contents(__DIR__.'/Templates/DivDeepLvl_3.json');
    }
}
