<?php
declare(strict_types = 1);

namespace Gear\Filtration\Filters;

use Chopper\Gear\Filtration\Filters\StyleSiftFilter;
use PHPUnit\Framework\TestCase;

/**
 * StyleSiftFilterTest
 */
class StyleSiftFilterTest extends TestCase
{
    private $filter;

    private $data;

    private $expected;

    public function testHandle(): void
    {
        $result = $this->filter->handle($this->data);
        static::assertSame($this->expected, $result);
    }

    protected function setUp(): void
    {
        $this->filter   = new StyleSiftFilter();
        $this->data     = file_get_contents(__DIR__.'/Templates/StyleTemplate.txt');
        $this->expected = file_get_contents(__DIR__.'/Templates/StyleSiftTemplate.txt');
    }
}
