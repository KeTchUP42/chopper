<?php
declare(strict_types = 1);

namespace Gear\Filtration\Filters;

use Chopper\Gear\Filtration\Filters\FastDivStructFilter;
use PHPUnit\Framework\TestCase;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * FastDivStructFilterTest
 */
class FastDivStructFilterTest extends TestCase
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
        $this->filter   = new FastDivStructFilter();
        $this->data     = file_get_contents(__DIR__.'/Templates/DivStructPageTemplate.txt');
        $this->expected = file_get_contents(__DIR__.'/Templates/DivStructTemplate.txt');
    }
}
