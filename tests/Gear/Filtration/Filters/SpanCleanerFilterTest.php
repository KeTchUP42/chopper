<?php
declare(strict_types = 1);

namespace Gear\Filtration\Filters;

use Chopper\Gear\Filtration\Filters\SpanCleanerFilter;
use PHPUnit\Framework\TestCase;

/**
 * SpanCleanerFilterTest
 */
class SpanCleanerFilterTest extends TestCase
{
    private $filter;

    private $data;

    public function testHandle(): void
    {
        $result = $this->filter->handle($this->data);
        static::assertEmpty($result);
    }

    protected function setUp(): void
    {
        $this->filter = new SpanCleanerFilter();
        $this->data   = file_get_contents(__DIR__.'/Templates/SpanTemplate.txt');
    }
}
