<?php
declare(strict_types = 1);

namespace Gear\Filtration\Filters;

use Chopper\Gear\Filtration\Filters\SvgCleanerFilter;
use PHPUnit\Framework\TestCase;

/**
 * SvgCleanerFilterTest
 */
class SvgCleanerFilterTest extends TestCase
{
    private $filter;

    private $data;

    public function testHandle()
    {
        $result = $this->filter->handle($this->data);
        static::assertEmpty($result);
    }

    protected function setUp(): void
    {
        $this->filter = new SvgCleanerFilter();
        $this->data   = file_get_contents(__DIR__.'/Templates/SvgTemplate.txt');
    }
}
